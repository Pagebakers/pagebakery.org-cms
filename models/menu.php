<?php

/**
 * Menu Model 
 */

class Menu extends AppModel {
	var $name = 'Menu'; 
	
	/**
     * Validation Rules
     * @var array
     */
	public $validate = array(
			'title' => array(
				'rule' => array('minLength', 3), 
				'allowEmpty' => false, 
				'required' => true, 
				'message' => 
				'The title needs to contain at least 3 characters'
			)
		);
	
	/**
     * hasMany Relationship
     * @var array
     */
	public $hasMany = array(
        'Page' => array(
            'className'     => 'Page',
            'foreignKey'    => 'menu_id'
			)
		);
} 

?>
