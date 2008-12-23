<?php

// Dashboard route
Router::connect('/' , array('controller' => 'dashboard', 'action' => 'index', 'prefix' => 'pb', 'admin' => true));

// Login route
Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));

// Pages routes
Router::connect('/*', array('controller' => 'pages', 'action' => 'view'));
?>