<?php
/**
 * NavigationHelper
 *
 * This helper helps you build your menu's
 *
 * PHP versions 4 and 5
 *
 * Licensed under The LGPL License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Pagebakers
 * @link			http://www.pagebakers.nl
 * @version         0.1
 * @license			http://www.gnu.org/licenses/lgpl.html GNU LESSER GENERAL PUBLIC LICENSE
 */
class NavigationHelper extends AppHelper {
    var $helpers = array('Html');
    
    /**
     * Returns a formatted <ul> with links
     * @param array $items An array containing all children for the list
     * @param array $options The html attributes for the list
     * @return string The formatted <ul> list
     */
    function menu($items, $options = array()) {
        if(!is_array($items) || empty($items)) {
            return;
        }

        $links = array();
        
        foreach($items as $item) {
            if(count($item) == 2) {
                list($text, $url) = $item;
                $itemOptions = array();
            } else {
                list($text, $url, $itemOptions) = $item;
            }
            $links[] = $this->link($text, $url, $itemOptions);
        }
        
        return $this->Html->nestedList($links, $options);
    }
    
    /**
     * Returns a link with class="active" if the url is the currently active url
     * @param string $title The content to be wrapped in <a/>
     * @param string $url The url of the link
     * @param array $options Html attributes of the link
     * @return string an <a/> element
     */
    function link($title, $url, $options = array()) {
        $currentRoute = Router::currentRoute();
        
        $url = Router::url($url);
        
        if(Router::url($currentRoute[3]) == $url) {
            $options = array('class' => 'active');
        }     
        
        $out = $this->Html->link($title, $url, $options);
        
        return $out;
    }
}
?>