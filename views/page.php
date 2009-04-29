<?php
/**
 * PageView
 *
 * View class used to render pages
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
App::import('View', 'Theme');
class PageView extends ThemeView {
    
    public $theme = 'default';
    
    public $helpers = array(
        'Html',
        'Elements'
    );
    
    /**
     * Enter description here...
     *
     * @param unknown_type $controller
     */
	public function __construct (&$controller) {
		parent::__construct($controller);
	}
    
}
?>