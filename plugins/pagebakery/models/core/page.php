<?php
class Page extends PagebakeryAppModel {
	var $name = 'Page';
	var $actsAs = array(
		'Pagebakery.Sluggable',
		'Tree'
	);

    public $validate = array(
		'title' => array('rule' => array('minLength', 4), 'allowEmpty' => false, 'required' => true, 'message' => 'De naam is te kort of leeg.'),
	);
}
?>