<h5><?php __('Database Configuration');?></h5>
    <?php echo $form->create(null, array('action' => 'setup'));?>
    <?php __('DB Driver');?>: <?php echo $form->select('driver', $DBDrivers, 'mysql'); ?><br />
    <?php echo $form->input('host', array( 'value' => 'localhost' ) ); ?><br />
    <?php echo $form->input('database'); ?><br />
    <?php echo $form->input('login'); ?><br />
    <?php __('Password');?><?php echo $form->password('password'); ?><br />
    <?php echo $form->input('prefix', array( 'value' => 'pb_' )); ?><br />

    <h5><?php __('Administrator');?></h5>
    <?php echo $form->input('admin_username', array( 'value' => 'admin' ) ); ?><br />
    <?php __('Password');?><?php echo $form->password('admin_password'); ?><br />

    <?php echo $form->submit();?>