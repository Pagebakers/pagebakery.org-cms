<?php
/* SVN FILE: $Id: json.php 307 2008-06-17 15:19:13Z eelco $ */
/**
 * JsonView
 * View for displaying json objects
 * 
 * @licence L-GPL
 *
 * @filesource   $HeadURL$
 * @copyright    Copyright (c) 2007, Pagebakery
 * @link         http://www.pagebakery.org Pagebakery
 * @version      $Revision: 307 $
 * @author       Eelco Wiersma
 * @modifiedby   $LastChangedBy: eelco $
 * @lastmodified $Date: 2008-06-17 17:19:13 +0200 (Tue, 17 Jun 2008) $
 */
class JsonView extends View {
    
    function __construct(&$controller, $register = true) {
        parent::__construct($controller, $register);
        
        $this->controller = $controller;
    }
    
    function render($action = null, $layout = 'ajax') {
        header("Pragma: no-cache");
        header("Cache-Control: no-store, no-cache, max-age=0, must-revalidate");
        header('Content-Type: text/x-json');
        if(isset($this->viewVars['result'])) {
            // Set Bad Request header if success is false
            if(isset($this->viewVars['result']['success']) && $this->viewVars['result']['success'] == false) {
                header('HTTP/1.1 400 Bad Request');
            }
            if(isset($this->viewVars['result']['SessionState']) && $this->viewVars['result']['SessionState'] == 'Expired') {
                header('SessionState: Expired');
                header('HTTP/1.1 403 Forbidden');
                $this->viewVars['result']['success'] = false;
            }

            if(isset($this->controller->json) && is_object($this->controller->json)) {
                $out = $this->controller->json->encode($this->viewVars['result']);
            } else {
                $out = json_encode($this->viewVars['result']);
            }

            echo $out;
        }
    }
}
?>