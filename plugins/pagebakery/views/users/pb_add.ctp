<?php echo $form->create('User', array('url' => $html->url(array('pb' => true)))); ?>

<?php echo $form->input('User.username'); ?>
<?php echo $form->input('User.email'); ?>

<?php echo $form->input('User.passwd'); ?>
<?php echo $form->input('User.passwd2'); ?>

<?php echo $form->end(__('Save', true)); ?>