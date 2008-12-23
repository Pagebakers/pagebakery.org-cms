<?php

// Dashboard route
Router::connect('/' , array('controller' => 'dashboard', 'action' => 'index', 'admin' => true));

// Login route
Router::connect('/login', array('controller' => 'users', 'action' => 'login', 'admin' => true));
Router::connect('/logout', array('controller' => 'users', 'action' => 'logout', 'admin' => true));

// Pages routes
Router::connect('/*', array('controller' => 'pages', 'action' => 'view'));
?>