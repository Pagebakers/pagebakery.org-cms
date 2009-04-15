<?php

/**
 * Page Model
 */

class Page extends AppModel {
	var $name = 'Page';
	var $actsAs = array(
		'Sluggable',
		'Tree'
	);

    /**
     * hasMany Relationship
     * @var string
     */
    public $hasMany = 'Element';

    /**
     * Validation Rules
     * @var array
     */
    public $validate = array(
		'title' => array('rule' => array('minLength', 4), 'allowEmpty' => false, 'required' => true, 'message' => 'The title is too short.'),
	);
	
}
?>