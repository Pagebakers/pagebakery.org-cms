<?php echo $form->create('User', array('url' => $html->url(array('pb' => true, $this->data['User']['id'])))); ?>

<?php echo $form->input('User.id'); ?>
<?php echo $form->input('User.username'); ?>
<?php echo $form->input('User.email'); ?>

<fieldset>
    <legend><?php __('Change password'); ?></legend>
    <?php echo $form->input('User.passwd'); ?>
    <?php echo $form->input('User.passwd2'); ?>
</fieldset>

<?php echo $form->end(__('Save', true)); ?>