<?php

/**
 * Menu Model 
 */

class Menu extends AppModel {
	var $name = 'Menu'; 
	
	// validation
	public $validate = array(
			'title' => array(
				'rule' => array('minLength', 3), 
				'allowEmpty' => false, 
				'required' => true, 
				'message' => 
				'The title needs to contain at least 3 characters'
			)
		);
	
	// one model has many pages
	public $hasMany = array(
        'Page' => array(
            'className'     => 'Page',
            'foreignKey'    => 'menu_id'
			)
		);
} 

?>
