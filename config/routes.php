<?php

// Dashboard route
Router::connect('/admin' , array('controller' => 'dashboard', 'action' => 'index', 'admin' => true));

Router::connect('/admin/:controller/:action/*' , array('admin' => true));


// Login route
Router::connect('/admin/login', array('controller' => 'users', 'action' => 'login', 'admin' => true));
Router::connect('/admin/logout', array('controller' => 'users', 'action' => 'logout', 'admin' => true));

// Pages routes
Router::connect('/', array('controller' => 'users', 'action' => 'login', 'admin' => true));
?>