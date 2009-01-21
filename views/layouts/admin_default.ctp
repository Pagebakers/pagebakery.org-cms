<?php echo $html->docType('html4-strict'); ?>
<html>
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $html->meta('icon');
		
		echo $html->css('pagebakery.admin.ui');
	?>
</head>
<body id="<?php echo $this->params['controller'] . '-' . str_replace('admin_', '', $this->params['action']); ?>" class="pagebakery">

    <?php echo $this->element('pagebakery'); ?>

	<div id="pb-content">
	           
		<?php $session->flash(); ?>

		<?php echo $content_for_layout; ?>

	</div>
    
	<?php echo $scripts_for_layout; ?>
	<?php echo $cakeDebug; ?>
</body>
</html>