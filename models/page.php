<?php

/**
 * Page Model
 */

class Page extends AppModel {

	public $actsAs = array(
		'Sluggable',
		'Tree'
	);

    public $hasMany = array(
        'ElementsPage'
    );
	
}
?>