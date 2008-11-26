<?php
class DashboardController extends PagebakeryAppController {
    
    public $uses = array();
    
    public function pb_index() {
        $this->pageTitle = __('Dashboard', true);
    }
    
}
?>