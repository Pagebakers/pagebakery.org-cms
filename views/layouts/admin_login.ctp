<?php echo $html->docType('html4-strict'); ?>
<html>
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?> - 
		<?php __('Pagebakery'); ?>
	</title>
	<?php
		echo $html->meta('icon');
        
        echo $html->css(array(
            'pagebakery.ui'
        ));
	?>
</head>
<body id="<?php echo $this->params['action']; ?>">
	<div id="container">
        <?php $session->flash(); ?>
		<?php $session->flash('auth'); ?>
		<?php echo $content_for_layout; ?>
	</div>
	
	<?php
    if( $javascript ) {
        echo $javascript->link(array(
            'jquery.ui-1.6rc2/jquery-1.2.6'
        ));
    }
    
	echo $scripts_for_layout;
	?>
	<?php echo $cakeDebug; ?>
</body>
</html>