<?php echo $form->create('User', array('action' => 'login', 'class' => 'block', 'id' => 'login-form-panel')); ?>

<h3 class="panel-header"><span><?php __('Login'); ?></span></h3>

<div class="inner-block">
    <?php echo $form->input('User.username'); ?>
    <?php echo $form->input('User.password'); ?>
    
    <?php echo $form->submit(__('Login', true)); ?>
</div>

<?php echo $form->end(); ?>