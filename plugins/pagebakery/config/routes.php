<?php
// Default index route
Router::connect('/', array('controller' => 'pages', 'action' => 'view', 'plugin' => 'pagebakery'));
 
// Dashboard route
Router::connect('/' . Configure::read('Routes.pagebakery'), array('controller' => 'pagebakery', 'action' => 'dashboard', 'prefix' => 'pb', 'plugin' => 'pagebakery'));

?>