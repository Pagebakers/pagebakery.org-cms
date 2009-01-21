<?php
echo $navigation->menu(array(
    array(__('Dashboard', true), array('controller' => 'dashboard', 'action' => 'index'), array('class' => 'dashboard')),
    array(__('Pages', true), array('controller' => 'pages', 'action' => 'index'), array('class' => 'pages')),
    array(__('Users', true), array('controller' => 'users', 'action' => 'index'), array('class' => 'users'))
), array('class' => 'pb-panel-tabs'));
?>