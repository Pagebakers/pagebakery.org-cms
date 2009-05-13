<?php echo $form->create('User', array('action' => 'lostpassword', 'admin' => true, 'class' => 'block', 'id' => 'lostpassword-form-panel', 'class' => 'pb-inline-panel')); ?>
<h3><span><?php __('Lost password' );?></span></h3>
<h3 class="pb-panel-header"><span><?php __('Retrieve your lost password'); ?></span></h3>

<div class="pb-panel-body">
    <?php echo $form->input('User.email'); ?>

    <?php echo $form->submit(__('Retrieve password', true)); ?>
</div>

<?php echo $form->end(); ?>