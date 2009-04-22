<?php
/**
 * ElementsHelper
 *
 * This helper dynamically loads all elements for the current page
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
class ElementsHelper extends AppHelper {

    /**
     * Returns all formatted elements for the specified container
     * @param string $name The name of the container
     * @return string The formatted container content
     */
    public function container($name) {       
        if(ClassRegistry::isKeySet('Page')) {
            $Page =& ClassRegistry::getObject('Page');
        } else return false;
        
        $conditions = array(
            'ElementsPage.page_id' => $Page->id,
            'ElementsPage.container' => $name
        );
        $elements = $Page->ElementsPage->find('all', compact('conditions'));

        $return = array();
        foreach($elements as $element) {
            $return[] = $this->element(Inflector::underscore($element['Element']['class']), $element[$element['Element']['class']]);
        }
        
        return sprintf('<div class="ct" id="%s">%s</div>', $name, implode("\n", $return));
    }

    /**
     * Returns a formatted element
     * @param string $type The element type to render
     * @param array $data Data passed to the rendered element 
     * @return string The formatted element
     */
    public function element($type = 'text_element', $data = array()) {
        $View =& ClassRegistry::getObject('view');
        $element = $View->element($type, array('data' => $data));
        
        return sprintf('<div class="pb-element-%s">%s</div>', str_replace('_element', '', $type), $element); 
    }

}
?>