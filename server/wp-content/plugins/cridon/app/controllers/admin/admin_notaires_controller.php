<?php

/**
 * Class AdminNotairesController
 * @author Etech
 * @contributor Joelio
 *
 */
// base admin ctrl
require_once 'base_admin_controller.php';

class AdminNotairesController extends BaseAdminController
{
    var $default_search_joins = array('Etude');
    /**
     *
     * @var array
     */
    var $default_searchable_fields = array(
        'last_name', 
        'first_name',
        'client_number',
        'crpcen',
        'email_adress',
        'Etude.office_name',
        'tel'
    );
    /**
     * @var array
     */
    public $default_columns = array(
        'last_name'  => array( 'label' => 'Nom' ),
        'first_name' => array( 'label' => 'Prénom' ),
        'client_number' => array( 'label' => 'Numéro client' ),
        'crpcen' => array( 'label' => 'CRPCEN' ),
        'email_adress' => array( 'label' => 'Email' ),
        'office_name' => array( 'label' => 'Nom de l\'office','value_method' => 'displayOfficeName' ),
        'tel' => array( 'label' => 'Téléphone' ),
    );
    
    /**
     * 
     * @param object $object Current object
     * @return string|null
     */
    public function displayOfficeName($object)
    {    
        return empty( $object->etude ) ? null : $object->etude->__name;
    }
    
    public function index() {
        $this->init_default_columns();
        $this->process_params_for_search();
        $collection = $this->model->paginate($this->params);
        $this->set('objects', $collection['objects']);
        $this->set_pagination($collection);
        //Load custom helper
        $this->load_helper('AdminView');
    }
    
    public function edit() {
        $this->verify_id_param();
        $this->create_or_save();
        $this->set_object();
    }
}