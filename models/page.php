<?php

/**
 * Page Model
 */

class Page extends AppModel {

	public $actsAs = array(
		'Sluggable',
		'Tree'
	);

    /**
     * hasMany Relationship
     * @var string
     */
    public $hasMany = array(
        'Element'
    );
	
}
?>