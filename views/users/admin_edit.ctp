<div class="block">
    <h3><span><?php __('Edit user'); ?></span></h3>
    <div class="inner-block">
    <?php echo $form->create('User', array('url' => $html->url(array('pb' => true, $this->data['User']['id'])))); ?>
    
    <?php echo $form->input('User.id'); ?>
    <?php echo $form->input('User.username'); ?>
    <?php echo $form->input('User.email'); ?>
    
    <h4><?php __('Change password'); ?></h4>
    <?php echo $form->input('User.passwd', array('label' => __('New password', true), 'after' => sprintf('<span>%s</span>', __('Leave this field empty if you don\'t want to change your password', true)))); ?>
    <?php echo $form->input('User.passwd2', array('label' => __('Confirm password', true), 'type' => 'password')); ?>
    
    <?php echo $form->end(__('Save', true)); ?>
    </div>
</div>