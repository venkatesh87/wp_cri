<?php

/**
 *
 * This file is part of project 
 *
 * File name : functions.php
 * Project   : wp_cridon
 *
 * @author Etech
 * @contributor Fabrice MILA
 *
 */

/**
 * Global function to find posts in table associate 
 * 
 * @global object $cri_container
 * @param array $options See options of query builder in models/query_builder.php 
 * @param string $primaryKey The primary for ordering result
 * @return array or object
 */
function criQueryPosts( $options = array(),$primaryKey = 'p.ID' ){
    global $cri_container;
    $table = 'posts';
    $defaultOptions = array(
        'synonym' => 'p',
        'limit'   => false,
        'join'    => array(
            'veille' => array(
                'table'  => 'veille v',
                'column' => 'v.post_id = p.ID',
                'type'   => 'left'
            )
        )
    );
    $options = array_merge( $defaultOptions, $options );
    $query_builder = $cri_container->get( 'query_builder' );
    if( $options['limit'] ){
        return $query_builder->findOne( $table, $options,$primaryKey );
    }else{
        if ( $options['limit'] === false ) {
            unset( $options['limit'] );
        }
        return $query_builder->findAll( $table, $options,$primaryKey );
    }    
}
/**
 * Find a latest post by model
 * 
 * @param string $model Model name <b>without prefix, e.g: cri_veille</b>
 * @return null or object
 */
function criGetLatestPost( $model ){
    if( !is_string( $model ) || empty( $model ) ){
        return null;
    }
    if( $model === 'veille' ){
        return criQueryPostVeille( 1,'DESC' );
    }
    global $cri_container;
    $tools = $cri_container->get( 'tools' );
    $options = array(
        'fields' => $tools->getFieldPost().$model[0].'.id as join_id',
        'limit' => 1,
        'join'  => array(
            $model => array(
                'table' => $model.' '.$model[0],
                'column' => $model[0].'.post_id = p.ID'
            )
        ),
        'conditions' => 'p.post_status = "publish"',
        'order' => 'DESC'
    );
    $result = criQueryPosts( $options );
    if( $result ){
        $latest = new stdClass();
        $latest->title   = $result->post_title;
        $latest->content = $result->post_content;
        $latest->link = CridonPostUrl::generatePostUrl( $model, $result->join_id );
        $latest->post = $tools->createPost( $result ); // Create Object WP_Post
        return $latest;
    }
    return null;
}

/**
 * Filter post per date by model
 * 
 * 
 * @global object $cri_container
 * @param string $model Model name <b>without prefix, e.g: cri_veille</b>
 * @param integer $nb_date How many date must contain array of result?
 * @param integer $nb_per_date How many object must contain date?
 * @param string $index Index of array who contain object per date
 * @param string $format_date Format of date, default is french format
 * @return null or array of objects
 */
function criFilterByDate( $model,$nb_date,$nb_per_date,$index, $format_date = 'd/m/Y' ){
    if( !is_string( $model ) || empty( $model ) ){
        return null;
    }
    global $cri_container;
    $nestedOptions = array(
        'synonym' => 'p',
        'fields' => 'CAST(p.post_date AS DATE) AS date',
        'join'  => array(
            $model => array(
                'table' => $model.' '.$model[0],
                'column' => $model[0].'.post_id = p.ID'
            )
        ),
        'conditions' => 'p.post_status = "publish"',
        'group' => 'date',
        'limit' => $nb_date,
        'order' => 'DESC'
    );
    $query_builder = $cri_container->get( 'query_builder' );
    $nested = $query_builder->buildQuery( 'posts',$nestedOptions,'p.ID' );// Nested query ( simple string )
    $tools = $cri_container->get( 'tools' );
    $options = array(
        'fields' => $tools->getFieldPost().'CAST(p.post_date AS DATE) AS date,p.post_title,'.$model[0].'.id as join_id',
        'join'  => array(
            $model => array(
                'table' => $model.' '.$model[0],
                'column' => $model[0].'.post_id = p.ID'
            ),
            'nested' => array(
                'table' => '('.$nested.') AS nested',
                'column' => 'CAST(p.post_date AS DATE) = nested.date',
                'nested' => true
            )
        ),
        'conditions' => 'p.post_status = "publish"',
        'order' => 'DESC'
    );
    if( $model === 'veille' ){
        $fields = array('id','code','label','short_label','displayed','picto');
        $mFields = '';// fields of model Matiere
        foreach ( $fields as $v ){
            $mFields .= ',m.'.$v;
        }
        $options['fields'] = $options['fields'].$mFields;
        $options['join']['matiere'] = array(
                'table' => 'matiere m',
                'column' => 'm.id = '.$model[0].'.id_matiere'
            );
    }
    $results = criQueryPosts( $options,'CAST(p.post_date AS DATE)' );
    //To have others attributes in array result. Default is object WP_Post
    //$res = $tools->buildSubArray( $model,$results, 'date',$nb_per_date,$index,$format_date, array('post_title','post_date','post_excerpt','post_content','join_id'), array('title','datetime','excerpt','content','join_id') );
    if( $model === 'veille' ){// If model Veille, so associate model Matiere in result
        $res = $tools->buildSubArray( $model,$results, 'date', $nb_per_date,$index,$format_date,null,null,$fields );        
    }else{
        $res = $tools->buildSubArray( $model,$results, 'date', $nb_per_date,$index,$format_date );        
    }
    return $res;
}

/**
 * If you want use all functions in WP for Post.
 * Init this function whith post data contain an instance of WP_Post
 * 
 * @global object $cri_container
 * @param array|object $data It's an object WP_Post or array of WP_Post
 */
function criWpPost( $data ){
    global $cri_container;
    $oPostQuery = $cri_container->get( 'post_query' );
    $oPostQuery->init( $data );
}

/**
 * Get the link of the current post ( link of model in WP_MVC ).
 * It's equivalent of the_permalink in WP
 * 
 * @global object $post WP_Post
 * @return string|null
 */
function criGetPostLink(){
    global $post;
    return ( ( $post ) && ( $post instanceof WP_Post ) ) ? CridonPostStorage::get( $post->ID ) : null;
}

/**
 * Function to fetch data in table cri_veille with Matiere
 * 
 * @global object $cri_container
 * @param integer $limit Limit result
 * @param string $order Order result ( ASC or DESC ) 
 * @return array
 */
function criQueryPostVeille( $limit = false,$order = 'ASC' ){
    $model = 'veille';
    global $cri_container;
    $tools = $cri_container->get( 'tools' );
    $fields = array('id','code','label','short_label','displayed','picto');
    $mFields = '';// fields of model Matiere
    foreach ( $fields as $v ){
        $mFields .= ',m.'.$v;
    }
    $options = array(
        'fields' => $tools->getFieldPost().$model[0].'.id as join_id'.$mFields,
        'join'  => array(
            $model => array(
                'table' => $model.' '.$model[0],
                'column' => $model[0].'.post_id = p.ID'
            ),
            'matiere' => array(
                'table' => 'matiere m',
                'column' => 'm.id = '.$model[0].'.id_matiere'
            )
        ),
        'conditions' => 'p.post_status = "publish"',
        'order' => $order
    );
    if( $limit ){
        $options['limit'] = $limit;
    }
    $results = criQueryPosts( $options ); 
    if( !is_array( $results ) ){
        $std = new stdClass();
        $std->matiere = CridonObjectFactory::create( $results, 'matiere', $fields);
        $std->link = CridonPostUrl::generatePostUrl( $model, $results->join_id );
        $std->post = $tools->createPost( $results ); // Create Object WP_Post
        return $std;
    }
    $aFinal = array();
    foreach( $results as $value ){
        $std = new stdClass();
        $std->matiere = CridonObjectFactory::create( $value, 'matiere', $fields);
        $std->link = CridonPostUrl::generatePostUrl( $model, $value->join_id );
        $std->post = $tools->createPost( $value ); // Create Object WP_Post
        $aFinal[] = $std;
    }
    return $aFinal;
}

// Hook of the_permalink() and get_permalink()
function append_custom_link( $url, $post ) {
    if ( $post->post_type === 'post' ) {
        $newUrl = criGetPostLink();
        if( $newUrl ){
            $url = $newUrl;
        }
    }
    return $url;
}
add_filter( 'post_link', 'append_custom_link', 10, 2 );

//End hook

/**
 * Restore current data in loop while of WP ( object with their all attributes ( post, link, ... )
 * 
 * @global WP_Post $post
 * @return object
 */
function criRestoreData(){
    global $post; 
    return ( ( $post ) && ( $post instanceof WP_Post ) ) ? CridonPostStorage::get( $post->ID,'all' ) : null;
}