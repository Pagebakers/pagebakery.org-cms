<div class="toolbar">
    <ul class="breadcrumbs">
        <?php echo $navigation->breadcrumbs($this->params['breadcrumbs']); ?>
    </ul>

    <ul class="utilities">
        <li><?php echo sprintf(__( 'Currently logged in as <strong>%s</strong>', true), $session->read('Auth.User.username')); ?></li>
        <li><?php echo $html->link(__( 'Logout', true), array('controller' => 'users', 'action' => 'logout', 'admin' => true)); ?></li>
    </ul>
</div>