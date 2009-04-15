<?php 
/**
* 
*/
App::import('Controller', 'Elements');
class HtmlElementsController extends ElementsController {    
    
    public function load() {
        $this->autoRender = false;
        echo 'wazaa';
    }
    
}
?>