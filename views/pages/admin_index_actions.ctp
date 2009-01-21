<?php
echo $navigation->menu(array(
    array('Create page', array('controller' => 'pages', 'action' => 'add'), array('class' => 'add-page'))
), array('class' => 'pb-actions'));
?>