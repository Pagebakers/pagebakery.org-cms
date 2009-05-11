<?php echo $form->create('User', array('action' => 'login', 'class' => 'block', 'id' => 'login-form-panel', 'class' => 'pb-inline-panel')); ?>

<h3><span><?php __('Login' );?></span></h3>
<h3 class="pb-panel-header"><span><?php __('Login'); ?></span></h3>

<div class="pb-panel-body">
    <?php echo $html->link( __('Lost your password?', true ) , array( 'controller' => 'users', 'action' => 'lostpassword' ) ); ?>
    <?php echo $form->input('User.username'); ?>
    <?php echo $form->input('User.password'); ?>

    <?php echo $form->submit(__('Login', true)); ?>
</div>

<?php echo $form->end(); ?>