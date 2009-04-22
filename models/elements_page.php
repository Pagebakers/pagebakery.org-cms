<?php
class ElementsPage extends AppModel {

    public $belongsTo = array(
        'Element',
        'Page'
    );

    public function afterFind($results) {
        foreach($results as &$result) {
            $model =& ClassRegistry::init($result['Element']['class']);
            $result = am($result, $model->find('first', array('conditions' => array($result['Element']['class'] . '.id' => $result['ElementsPage']['foreign_id']))));
        }
        
        return $results;
    }

}
?>