<div id="installer">
<h3><span><?php __('Pagebakery.org installation - Step 2' );?></span></h3>
<?php echo $form->create(null, array('action' => 'setup', 'id' => 'installer-form-panel', 'class' => 'pb-inline-panel'));?>

    <h3 class="pb-panel-header"><span><?php __('Database Configuration');?></span></h3>
    <div class="pb-panel-body">
    <?php echo $form->input('driver', array('options' => $DBDrivers, 'label' => __('DB Driver', true))); ?>
    <?php echo $form->input('host', array( 'value' => 'localhost' ) ); ?>
    <?php echo $form->input('database'); ?>
    <?php echo $form->input('login'); ?>
    <?php echo $form->input('password'); ?>
    <?php echo $form->input('prefix', array( 'value' => 'pb_' )); ?>
    </div>

    <h3 class="pb-panel-header"><span><?php __('Administrator');?></span></h3>
    <div class="pb-panel-body">
    <?php echo $form->input('admin_username', array( 'value' => 'admin' ) ); ?>
    <?php echo $form->input('admin_password', array('type' => 'password')); ?>
    <?php echo $form->input('admin_name', array( 'value' => 'Your Name' ) ); ?>
    <?php echo $form->input('admin_email', array( 'value' => 'Your e-mail' ) ); ?>
    </div>

<?php echo $form->submit();?>
</div>