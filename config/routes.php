<?php

// Dashboard route
Router::connect('/admin' , array('controller' => 'dashboard', 'action' => 'index', 'admin' => true));

// Login routes
Router::connect('/admin/login', array('controller' => 'users', 'action' => 'login', 'admin' => true));
Router::connect('/admin/logout', array('controller' => 'users', 'action' => 'logout', 'admin' => true));

// Pages routes
Router::connect('/', array('controller' => 'pages', 'action' => 'index'));
?>