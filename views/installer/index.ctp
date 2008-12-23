<div>
    <h4>Hello and Welcome to Pagebakery!<br /> This is the installation module which will ask you a few questions in order to help you set up your brand new CMS.</h4>
    <h5>Database Configuration</h5>
    <?php echo $form->create(null, array('action' => 'index'));?>
    Driver: <?php echo $form->select('driver', $DBDrivers, 'mysql'); ?><br />
    <?php echo $form->input('host', array( 'value' => 'localhost' ) ); ?><br />
    <?php echo $form->input('database'); ?><br />
    <?php echo $form->input('login'); ?><br />
    Password<?php echo $form->password('password'); ?><br />
    <?php echo $form->input('prefix', array( 'value' => 'pb_' )); ?><br />

    <h5>Administrator</h5>
    <?php echo $form->input('admin_username', array( 'value' => 'admin' ) ); ?><br />
    Password: <?php echo $form->password('admin_password'); ?><br />
    
    <?php echo $form->submit();?>
</div>