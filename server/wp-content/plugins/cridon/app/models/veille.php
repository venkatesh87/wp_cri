<?php

class Veille extends \App\Override\Model\CridonMvcModel {

    use DocumentsHolderTrait;

    var $table          = "{prefix}veille";
    var $includes       = array('Post','Matiere');
    var $belongs_to     = array(
        'Post' => array('foreign_key' => 'post_id'),
        'Matiere' => array('foreign_key' => 'id_matiere')
    );
    var $display_field = 'post_id';

    public function getList($params){
        $params['per_page'] = !empty($params['per_page']) ? $params['per_page'] : DEFAULT_POST_PER_PAGE;
        //Set explicit join
        $params['joins'] = array(
            'Post','Matiere'
        );
        //Set conditions
        if (isset($params['conditions']) && is_array($params['conditions'])) {
            $params['conditions'] = array_merge($params['conditions'], array(
                'Post.post_status' => 'publish'
            ));
        } else {
            $params['conditions'] = array('Post.post_status' => 'publish');
        };
        //Order by date publish
        $params['order'] = 'Post.post_date DESC' ;

        /** @var $this->model veille  */
        return Veille::paginate($params);
    }

    /**
     * Check if user can access content of page
     *
     * @param Veille $veille
     * @param Notaire $notaire
     * @return bool
     * @throws Exception
     */
    public function userCanAccessSingle($veille,$notaire)
    {
        $roles = CriGetCollaboratorRoles($notaire);
        // subscription_level must be >= veille_level
        return (in_array(CONST_CONNAISANCE_ROLE,$roles) && ($veille->level == 1 || ($notaire->etude->subscription_level >= $veille->level && $notaire->etude->end_subscription_date >= date('Y-d-m'))));
    }
}
