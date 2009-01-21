<?php if($session->check('Auth.User')) : ?>
<div id="pb-controls">
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
<?php
    echo $html->css(array(
        '/js/jquery.ui-1.6rc2/themes/default/ui.all',
        'pagebakery.ui'
    ));

    echo $javascript->link(array(
		'jquery.ui-1.6rc2/jquery-1.2.6',
		'jquery.ui-1.6rc2/ui/jquery.ui.all',
    	'tiny_mce/tiny_mce',
		'pagebakery'
	));
?>
<?php endif; ?>