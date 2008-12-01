<?php
// Default index route
Router::connect('/', array('controller' => 'pages', 'action' => 'view', 'plugin' => 'pagebakery'));
 
// Dashboard route
Router::connect('/' . Configure::read('Routes.pagebakery'), array('controller' => 'dashboard', 'action' => 'index', 'prefix' => 'pb', 'pb' => true, 'plugin' => 'pagebakery'));

// Login route
Router::connect('/' . Configure::read('Routes.pagebakery') . '/login', array('controller' => 'users', 'action' => 'login', 'prefix' => 'pb', 'plugin' => 'pagebakery'));
Router::connect('/' . Configure::read('Routes.pagebakery') . '/logout', array('controller' => 'users', 'action' => 'logout', 'prefix' => 'pb', 'plugin' => 'pagebakery'));

// Admin routes
$controllers = Configure::listObjects('controller', PAGEBAKERY . 'controllers');
foreach($controllers as &$controller) {
    $controller = low($controller);
    Router::connect('/' . Configure::read('Routes.pagebakery') . '/' . $controller, array('controller' => $controller, 'action' => 'index', 'prefix' => 'pb', 'pb' => true, 'plugin' => 'pagebakery')); 
    Router::connect('/' . Configure::read('Routes.pagebakery') . '/' . $controller . '/:action/*', array('controller' => $controller, 'prefix' => 'pb', 'pb' => true, 'plugin' => 'pagebakery'));    
}
unset($controllers);
?>