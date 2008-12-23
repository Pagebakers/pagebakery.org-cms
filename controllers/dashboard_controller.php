<?php
class DashboardController extends AppController {

    public $uses = array();

    public function admin_index() {
        $this->pageTitle = __('Dashboard', true);
    }

}
?>