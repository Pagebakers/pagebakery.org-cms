<div class="block step2" id="installer">
    <h3><span><?php __('Database Configuration');?></span></h3>
    <div class="inner-block">
    <?php echo $form->create(null, array('action' => 'setup'));?>
    <?php echo $form->input('driver', array('options' => $DBDrivers, 'label' => __('DB Driver', true))); ?>
    <?php echo $form->input('host', array( 'value' => 'localhost' ) ); ?>
    <?php echo $form->input('database'); ?>
    <?php echo $form->input('login'); ?>
    <?php echo $form->input('password', array('type' => 'password')); ?>
    <?php echo $form->input('prefix', array( 'value' => 'pb_' )); ?>

    <h4><?php __('Administrator');?></h4>
    <?php echo $form->input('admin_username', array( 'value' => 'admin' ) ); ?>
    <?php echo $form->input('admin_password', array('type' => 'password')); ?>

    <?php echo $form->submit();?>
    </div>
</div>