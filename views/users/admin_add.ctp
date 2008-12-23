<div class="block">
    <h3><span><?php __('Edit user'); ?></span></h3>
    <div class="inner-block">
        <?php echo $form->create('User', array('url' => $html->url(array('pb' => true)))); ?>
        
        <?php echo $form->input('User.username'); ?>
        <?php echo $form->input('User.email'); ?>
        
        <?php echo $form->input('User.passwd', array('label' => __('Password', true))); ?>
        <?php echo $form->input('User.passwd2', array('label' => __('Confirm password', true), 'type' => 'password')); ?>
        
        <?php echo $form->end(__('Save', true)); ?>
    </div>
</div>