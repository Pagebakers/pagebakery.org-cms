<?php echo $html->docType('html4-strict'); ?>
<html>
<head>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
        echo $html->charset();
	
		echo $html->meta('icon');
		
		echo $html->css('pagebakery.admin.ui');
	?>
</head>
<body id="pb-<?php echo $this->params['controller']; ?>" class="pagebakery">

    <div id="pb-controls" class="pb-layout-north">
    	<div id="pb-header">
            <?php
            echo $navigation->menu(array(
                array(__('Dashboard', true), array('controller' => 'dashboard', 'action' => 'index'), array('class' => 'dashboard')),
                array(__('Pages', true), array('controller' => 'pages', 'action' => 'index'), array('class' => 'pages')),
                array(__('Users', true), array('controller' => 'users', 'action' => 'index'), array('class' => 'users'))
            ), array('class' => 'pb-panel-tabs'));
            ?>
    	</div>
    	
        <div class="pb-toolbar">
            <?php 
                if(file_exists(APP . '/views/' . $this->params['controller'] . '/' . $this->params['action'] . '_actions.ctp')) {
                    echo $this->element('../' . $this->params['controller'] . '/' . $this->params['action'] . '_actions');
                } 
            ?>
        
            <ul class="pb-utilities">
                <li><?php echo sprintf(__( 'Currently logged in as <strong>%s</strong>', true), $session->read('Auth.User.username')); ?></li>
                <li><?php echo $html->link(__( 'Logout', true), array('controller' => 'users', 'action' => 'logout', 'admin' => true)); ?></li>
            </ul>
        </div>
    </div>
	           
    <?php $session->flash(); ?>

    <?php echo $content_for_layout; ?>


    <?php
        echo $html->css(array(
            'pagebakery.ui'
        ));
    
        echo $javascript->link(array(
            'jquery.class',
    		'jquery-1.3.2.min',
    		'jquery-ui-1.7.1.min',
    		'pagebakery'
    	));
    ?>
	<?php echo $scripts_for_layout; ?>
	<?php echo $cakeDebug; ?>
</body>
</html>