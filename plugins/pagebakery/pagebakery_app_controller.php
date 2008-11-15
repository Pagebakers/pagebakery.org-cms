<?php
class PagebakeryAppController extends AppController {

    var $components = array('RequestHandler', 'Cookie');
    
    var $helpers = array('Form', 'Html', 'Javascript');
    
    function beforeFilter() {
        //if there is a core error, just show it
        if( $this->action == null ) {
            return false;
        }
        
        App::import('Core', 'Sanitize');
            
        $this->Cookie->path = '/';

        // set json contenttype
        $this->RequestHandler->setContent('json', 'text/x-json');
        
        if( ( isset($this->params['admin']) && $this->params['admin'] === 1 ) || (isset($this->params['prefix']) && $this->params['prefix'] == 'pb') ) {
            $this->layout = 'admin_default';
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