<?php echo $form->create('User', array('action' => 'lostpassword', 'class' => 'block', 'id' => 'lostpassword-form-panel', 'class' => 'pb-inline-panel')); ?>

<h3><span><?php __('Password Recovery' );?></span></h3>
<h3 class="pb-panel-header"><span><?php __('Enter your e-mailaddress'); ?></span></h3>

<div class="pb-panel-body">
    <?php echo $form->input('User.email'); ?>

    <?php echo $form->submit(__('Send', true)); ?>
</div>

<?php echo $form->end(); ?>