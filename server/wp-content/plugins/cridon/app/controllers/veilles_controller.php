<?php

/**
 *
 * This file is part of project 
 *
 * File name : veilles_controller.php
 * Project   : wp_cridon
 *
 * @author Etech
 * @contributor Fabrice MILA
 *
 */
require_once 'base_actu_controller.php';
class VeillesController extends BaseActuController {

    //unique matiere selected, default null
    protected static $currentMatiereSelected = null;

    /**
     * @var \Matiere
     */
    protected $currentMatSelectedModel;

    /**
     * @var array
     */
    protected $virtualNames = array();

    /**
     * @var mixed
     */
    protected $matieres;

    /**
     * Archive action
     */
    public function index() {
        $veille = new Veille;
        $this->matieres = Matiere::getMatieresByModelPost($veille);
        if ( isset($_GET['matieres']) && is_array($_GET['matieres']) ) {
            // apply filters after removing empty values
            $filtres = array_filter($_GET['matieres'], function($value) {
                return !empty($value);
            });
            if (!empty($filtres)) {
                $this->applyFilters($filtres);
            }
        } else {
            foreach ($this->matieres as $mat) {
                $mat->filtered = false;
            }
        }
        if ($this->currentMatSelectedModel) {
            self::$currentMatiereSelected = $this->currentMatSelectedModel;
            $this->set('h1', $this->currentMatSelectedModel->label);
        } else {
            $this->set('h1', Config::$listingVeille['h1']);
        }
        add_action('wp_head', array($this,'rssVeilles'));
        $collection = $this->model->getList($this->params);
        //selected matiere
        $this->set('matieres', $this->matieres);
        $this->set('objects', $collection['objects']);
        $this->set_pagination($collection);
        add_action('wp_head', array($this, 'addMetaHeader') );//hook WP to append in header
    }

    /**
     * Apply criteria filters
     *
     * @param array $criteria
     * @throws Exception
     */
    protected function applyFilters($criteria)
    {
        if (count($criteria) === 1) {
            $this->currentMatSelectedModel = mvc_model('matiere')->find_one_by_virtual_name(esc_sql(strip_tags($criteria[0])));
            if ($this->currentMatSelectedModel) {
                self::$currentMatiereSelected = $this->currentMatSelectedModel;
            }
        }

        foreach ($criteria as $mat){
            $this->virtualNames[] = esc_sql(strip_tags($mat));
        }
        foreach($this->matieres as $mat){
            if( in_array($mat->virtual_name, $this->virtualNames) ){
                $mat->filtered = true;
            }else{
                $mat->filtered = false;
            }
        }
        $this->params['conditions'] = array(
            'Matiere.virtual_name'=> $this->virtualNames
        );
    }

    /**
     * Hook action for wp_head
     */
    public  function addMetaHeader() {
        $meta_title = Config::$listingVeille['meta_title'];
        $meta_description = Config::$listingVeille['meta_description'];
        $canonical = mvc_public_url(array('controller' => MvcInflector::tableize($this->model->name)));
        //unique matiere
        if( self::$currentMatiereSelected !== null ){
            $matiere = self::$currentMatiereSelected;
            $meta_title = !empty($matiere->meta_title) ? $matiere->meta_title : $meta_title;
            $meta_description = !empty($matiere->meta_description) ? $matiere->meta_description : $meta_description;
            //generate url
            $canonical = mvc_public_url(array('controller' => MvcInflector::tableize($matiere->__model_name),'id' => $matiere->virtual_name));
        }
        //variable to output in view
        $options = array(
            'locals' => array(
                'meta_title'        => $meta_title,
                'meta_description'  => $meta_description,
                'canonical'         => $canonical
            )
        );
        //render view meta
        $this->render_view_with_view_vars('veilles/meta', $options);
    }

    /**
     * Single action
     */
    public function show() {
        if ( !CriIsNotaire() ) {
            CriRefuseAccess();
        } else {
            // check if user can access this level
            $notaire = mvc_model('Notaire')->getUserConnectedData();
            if (isset($this->params['id']) && $this->model->userCanAccessSingle($this->model->associatePostWithDocumentByPostName($this->params['id']),$notaire)) {
                $download_url = '';
                if (isset($_GET['id_doc']) && $_GET['id_doc']) {
                    $download_url = mvc_public_url(array('controller' => 'documents', 'action' => 'download', 'id' => $_GET['id_doc']));
                }
                $this->set('download_url', $download_url);

                parent::show();
            } else {
                if (CriCanAccessSensitiveInfo(CONST_CRIDONLINESUBSCRIPTION_ROLE)) {
                    $redirect = 'cridonline';
                    $error = 'NIVEAU_VEILLE_INSUFFISANT';
                } else {
                    $redirect = 'show';
                    $error = 'FONCTION_NON_AUTORISE';
                }
                // redirect to information page
                $options = array(
                    'controller' => 'notaires',
                    'action'     => $redirect
                );
                $publicUrl  = MvcRouter::public_url($options);
                $publicUrl.='?error='.$error;
                wp_redirect( $publicUrl, 302 );
            }
        }
    }

    /**
     * Set pagination
     *
     * @param mixed $collection
     * @override
     */
    public function set_pagination($collection) {
        parent::set_pagination($collection);
        if( isset( $this->pagination['add_args'] ) ){
            if( isset( $this->pagination['add_args']['controller'] ) ){
                unset( $this->pagination['add_args']['controller'] );
            }
            if( isset( $this->pagination['add_args']['action'] ) ){
                unset( $this->pagination['add_args']['action'] );
            }
        }
    }

    /**
     * RSS feed action
     */
    public function rssVeilles(){
        if (!empty(self::$currentMatiereSelected)) {
            $title = sprintf(Config::$rss['title_mat'],self::$currentMatiereSelected->label);
            $feed = mvc_public_url(array('controller' => 'veilles','action' =>'feedFilter', 'id' =>self::$currentMatiereSelected->id));
        } else {
            $title = Config::$rss['title'];
            $feed = mvc_public_url(array('controller' => 'veilles','action' =>'feed'));
        }

        $options = array(
            'locals' => array(
                'title'         => $title,
                'feed'          => $feed
            )
        );
        $this->render_view_with_view_vars('layouts/rssLink', $options);
    }

    /**
     * RSS feed action
     */
    public function feed(){
        $options = array();
        $options['joins'] = array(
            'Post','Matiere'
        );
        //Set conditions
        $options['conditions'] = array(
            'Post.post_status'=>'publish'
        );
        //Order by date publish
        $options['order'] = 'Post.post_date DESC' ;
        $title = Config::$rss['title'];//Title of RSS
        $objects = $this->model->find($options);
        $this->set('title',$title);
        $this->set('objects',$objects);
        $this->set('description',Config::$rss['description']);
        $this->render_view('feed', array('layout' => 'feed'));
    }

    /**
     * RSS feed action
     *
     * @throws Exception
     */
    public function feedFilter(){
        $matiere = mvc_model('Matiere')->find_one_by_id($this->params['id']);
        if(!$matiere){//no matiere found
            redirectTo404();
        }
        $options = array();
        $options['joins'] = array(
            'Post','Matiere'
        );
        //Set conditions
        $options['conditions'] = array(
            'Post.post_status'=>'publish',
            'Matiere.id'=> $this->params['id']
        );
        //Order by date publish
        $options['order'] = 'Post.post_date ASC' ;
        $objects = $this->model->find($options);
        $title = sprintf(Config::$rss['title_mat'], $matiere->label );//Title of RSS
        $this->set('title',$title);
        $this->set('objects',$objects);
        $this->set('description',Config::$rss['description']);
        $this->render_view('feed', array('layout' => 'feed'));
    }

}
