<?php
class PagebakeryAppController extends AppController {

    var $components = array('RequestHandler', 'Cookie', 'Auth');
    
    var $helpers = array('Form', 'Html', 'Javascript');
    
    function beforeFilter() {
        //if there is a core error, just show it
        if( $this->action == null ) {
            return false;
        }
            
        $this->Cookie->path = '/';

        // set json contenttype
        $this->RequestHandler->setContent('json', 'text/x-json');
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