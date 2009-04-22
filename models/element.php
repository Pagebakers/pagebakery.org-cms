<?php
/**
 * Element
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
class Element extends AppModel {

    /**
     * BelongsTo Relationship
     * @var string
     */
    public $hasAndBelongsToMany = array(
        'Page'
    );

    /**
     * Validation Rules
     * @var array
     */
    public $validate = array(
        'name'  => array(
            'rule'      => array('minLength', 2),
            'allowEmpty'=> false,
            'required'  => true,
            'message' => 'The name is too short.'
        ),
        'container' => array(
            'rule'      => array('minLength', 2),
            'allowEmpty'=> false,
            'message'   => 'Container name is too short!'
        )
    );

}
?>