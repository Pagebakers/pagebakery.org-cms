<?php echo $html->docType('html4-strict'); ?>
<html>
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $html->meta('icon');
		
		echo $html->css('default');
	?>
</head>
<body>
    <div id="container">
        <div id="heading">
            <h1>Pagebakery CMS, piece of cake!</h1>
        </div>
    
        <ul id="menu">
            <li><?php echo $html->link( 'Home', '/', array( 'class' => 'activeHome' ) );?></li>
            <li><?php echo $html->link( 'More Information', '/pages/more-info' );?></li>
            <li><?php echo $html->link( 'Support', '/pages/support' );?></li>
            <li><?php echo $html->link( 'Customize', '/pages/customize' );?></li>
        </ul>
        
        <?php echo $content_for_layout; ?>
        
        <div id="footer">
            <span>Copyright &copy; Pagebakery 2006-2008. For more information and support please visit <a href="http://www.pagebakery.org">www.pagebakery.org</a></span>
        </div>
    </div>
    <?php echo $this->element('pagebakery'); ?>
	<?php echo $scripts_for_layout; ?>
	<?php echo $cakeDebug; ?>
</body>
</html>