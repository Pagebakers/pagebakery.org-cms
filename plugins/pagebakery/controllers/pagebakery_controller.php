<?php
class PagebakeryController extends PagebakeryAppController {
    
    var $uses = array();
    
    public function pb_dashboard() {
        $this->pageTitle = __('Dashboard', true);
    }
    
}
?>