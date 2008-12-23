<?php
class AppController extends Controller {

    var $components = array('Auth', 'RequestHandler', 'Cookie');

    var $helpers = array('Form', 'Html', 'Javascript', 'Pagebakery.Navigation');

    function beforeFilter() {
        //if there is a core error, just show it
        if( $this->action == null ) {
            return false;
        }

        App::import('Core', 'Sanitize');

        $this->Cookie->path = '/';

        // set json contenttype
        $this->RequestHandler->setContent('json', 'text/x-json');

        if(isset($this->Auth)) {
            $this->Auth->loginAction = Configure::read('Routes.pagebakery') . '/login';
            $this->Auth->logoutAction = Configure::read('Routes.pagebakery') . '/logout';
            $this->Auth->autoRedirect = false;
        }

        if( ( isset($this->params['admin']) && $this->params['admin'] === 1 ) || (isset($this->params['prefix']) && $this->params['prefix'] == 'pb') ) {
            $this->layout = 'pb_default';
        }

    }

    function beforeRender() {
        // render the error layout if an error occurs
        if ($this->viewPath == 'errors') {
            $this->layout = 'error';
        }
        // automatically use json view if the request expects json
        if($this->RequestHandler->responseType() == 'json') {
            $this->view = 'json';
        }
    }

}
?>