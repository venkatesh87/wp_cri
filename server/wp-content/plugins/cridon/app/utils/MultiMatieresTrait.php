<?php
/*
 * This file is part of the JETPULP wp_cridon project.
 *
 * Copyright (C) JETPULP
 */

trait MultiMatieresTrait
{
    /**
     * Retrieve related Matieres
     * @param MvcModelObject $model
     *
     * @return \MvcModelObject[]
     */
    public function getMatieres($model = null) {
        global $wpdb;
        $modelNames = assocToKeyVal(Config::$modelTable, 'model', 'name');
        $name = $modelNames[$model->__model_name];
        // get list of existing matiere
        $matieres = mvc_model('Matiere')->find(array(
            'joins' => array() //dummy condition to avoid join
        ));
        $matieres = assocToKeyVal($matieres, 'id');
        $select  = "SELECT l.".$name."_id ,l.matiere_id";
        $query = $select."
            FROM cri_".$name." m
            LEFT JOIN cri_".$name."_matiere l ON m.id = l.".$name."_id ";
        if (!empty($model)) {
            $query .= "WHERE m.id = ".$model->__id;
        }
        $query .= ";";
        $results = $wpdb->get_results($query);
        $r = array();
        if (empty($model)) {
            foreach ($results as $v) {
                if (!empty($matieres[$v->matiere_id])) {
                    $r[$v->{$name."_id"}][] = $matieres[$v->matiere_id];
                }
            }
        } else {
            foreach ($results as $v) {
                if (!empty($matieres[$v->matiere_id])) {
                    $r[] = $matieres[$v->matiere_id];
                }
            }
        }
        $objects = $r;
        return (!empty($objects)) ? $objects : null;
    }
}