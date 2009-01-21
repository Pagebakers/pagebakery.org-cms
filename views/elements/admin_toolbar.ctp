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