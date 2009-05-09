<?php
/**
 * ElementsPage
 *
 *
 * PHP version 5
 *
 * Licensed under The LGPL License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2006-2009, Pagebakery
 * @link			http://www.pagebakery.org
 * @license			http://www.gnu.org/licenses/lgpl.html GNU LESSER GENERAL PUBLIC LICENSE
 */
class ElementsPage extends AppModel {

    public $belongsTo = array(
        'Element',
        'Page'
    );

    public $actsAs = array('Tree');
    
    /**
     * Dynamically adds the corrosponding element type record to the find results
     * @param array $results Results
     * @return array The modified results
     */
    public function afterFind($results) {
        foreach($results as &$result) {
            if(isset($result['Element'])) {
                $model =& ClassRegistry::init($result['Element']['class']);
                if(is_object($model)) {
                    $result = am($result, $model->find('first', array('conditions' => array($result['Element']['class'] . '.id' => $result['ElementsPage']['foreign_id']))));
                }
            }
        }
        
        return $results;
    }

}
?>