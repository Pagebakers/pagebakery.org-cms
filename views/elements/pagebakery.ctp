<?php if($session->check('Auth.User')) : ?>
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
<div class="pb-layout-east">
    <div class="pb-toolbar">
        <button class="pb-save">Save</button> or <a href="#" class="pb-cancel">cancel</a> changes
    </div>
    <h3 class="pb-panel-header">Elements</h3>
    <div class="pb-panel-body">       
        <ul id="pb-elements-toolbar">
            <li class="pb-element"><a href="#" class="pb-element-html">HTML</a></li>
            <li class="pb-element"><a href="#" class="pb-element-text">Text</a></li>
            <li class="pb-element"><a href="#" class="pb-element-image">Image</a></li>
            <li class="pb-element-group">
                <h4 class="pb-element-group-video">Video</h4>
                <ul>
                    <li class="pb-element"><a href="#" class="pb-element-youtube">Youtube</a></li>
                    <li class="pb-element"><a href="#" class="pb-element-vimeo">Vimeo</a></li>
                    <li class="pb-element"><a href="#" class="pb-element-metacafe">Metacafe</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<?php
    echo $html->css(array(
        'pagebakery.ui'
    ));

    echo $javascript->link(array(
        'jquery.class',
		'jquery-1.3.1',
		'jquery.ui/jquery.ui.all',
		'pagebakery'
	));
?>
<?php endif; ?>