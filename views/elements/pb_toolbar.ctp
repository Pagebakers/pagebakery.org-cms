<div class="toolbar">
    <ul class="breadcrumbs">
    
    </ul>

    <ul class="utilities">
        <li><?php echo sprintf(__d('pb', 'Currently logged in as <strong>%s</strong>', true), $session->read('Auth.User.username')); ?></li>
        <li><?php echo $html->link(__d('pb', 'Logout', true), array('controller' => 'users', 'action' => 'logout', 'pb' => true)); ?></li>
    </ul>
</div>