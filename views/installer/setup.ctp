<div class="block step2" id="installer">
    <h3><span><?php __('Database Configuration');?></span></h3>
    <span class="inner-block">
    <?php echo $form->create(null, array('action' => 'setup'));?>
    <?php echo $form->input('driver', array('options' => $DBDrivers, 'label' => __('DB Driver', true))); ?>
    <?php echo $form->input('host', array( 'value' => 'localhost' ) ); ?>
    <?php echo $form->input('database'); ?>
    <!-- <span id="additional_params"> -->
    <?php echo $form->input('login'); ?>
    <?php echo $form->input('password'); ?>
    <!-- </span> -->
    <?php echo $form->input('prefix', array( 'value' => 'pb_' )); ?>

    <h4><?php __('Administrator');?></h4>
    <?php echo $form->input('admin_username', array( 'value' => 'admin' ) ); ?>
    <?php echo $form->input('admin_password', array('type' => 'password')); ?>
    <?php echo $form->input('admin_name', array( 'value' => 'Your Name' ) ); ?>
    <?php echo $form->input('admin_email', array( 'value' => 'Your e-mail' ) ); ?>


    <?php echo $form->submit();?>
    </div>
</div>
<!-- <script type="text/javascript">
    function $(el){
        return document.getElementById( el );
    }
    $('driver').onchange = function(){
        if( this.value == 'sqlite' ){
            $('additional_params').style.display = 'none';
        }
        else{
            $('additional_params').style.display = 'inline';
        }
        return true;
    }

    $('driver').onchange();
</script> -->