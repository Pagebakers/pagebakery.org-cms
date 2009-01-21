<?php
class Page extends AppModel {
	var $name = 'Page';
	var $actsAs = array(
		'Sluggable',
		'Tree'
	);

    public $validate = array(
		'title' => array('rule' => array('minLength', 4), 'allowEmpty' => false, 'required' => true, 'message' => 'The title is too short.'),
	);
	
}
?>