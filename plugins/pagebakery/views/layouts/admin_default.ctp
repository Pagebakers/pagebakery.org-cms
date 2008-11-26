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
            '/js/jquery.ui-1.6rc2/themes/default/ui.all',
            'pagebakery.ui'
        ));
	?>
</head>
<body>
	<div id="container">
		<div id="header" class="panel-header">

		</div>
		<div id="content">

			<?php $session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
		</div>
	</div>
	
	<?php
    if( $javascript ) {
        echo $javascript->link(array(
            'jquery.ui-1.6rc2/jquery-1.2.6',
            'jquery.ui-1.6rc2/jquery.ui.all'
        ));
    }
    
	echo $scripts_for_layout;
	?>
	<?php echo $cakeDebug; ?>
</body>
</html>