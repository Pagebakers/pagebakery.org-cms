<?php
echo $navigation->menu(array(
    array('Create user', array('controller' => 'users', 'action' => 'add'), array('class' => 'add'))
), array('class' => 'pb-actions'));
?>