<?php
echo $navigation->menu(array(
    array(__('Dashboard', true), array('controller' => 'dashboard', 'action' => 'index', 'pb' => true), array('class' => 'dashboard')),
    array(__('Pages', true), array('controller' => 'pages', 'action' => 'index', 'pb' => true), array('class' => 'pages')),
    array(__('Users', true), array('controller' => 'users', 'action' => 'index', 'pb' => true), array('class' => 'users'))
), array('class' => 'panel-tabs'));
?>