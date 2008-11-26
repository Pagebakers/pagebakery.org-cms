<?php echo $form->create('User', array('action' => 'login', 'id' => 'login-form-panel')); ?>

<h1 class="panel-header"><?php __('Login'); ?></h1>

<div class="panel-body">
    <fieldset>
        <?php echo $form->input('User.username'); ?>
        <?php echo $form->input('User.password'); ?>
    </fieldset>
    
    <?php echo $form->submit(__('Login', true)); ?>
</div>

<?php echo $form->end(); ?>