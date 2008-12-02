<?php
/* SVN FILE: $Id: default.ctp 7690 2008-10-02 04:56:53Z nate $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.console.libs.templates.skel.views.layouts
 * @since			CakePHP(tm) v 0.10.0.1076
 * @version			$Revision: 7690 $
 * @modifiedby		$LastChangedBy: nate $
 * @lastmodified	$Date: 2008-10-02 00:56:53 -0400 (Thu, 02 Oct 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<?php echo $html->docType('xhtml-strict'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php __('Uitvaartbron - Uitvaartverzekeringen vergelijken'); ?> <?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $html->meta('icon');

		echo $html->css(array('main', 'homepage'));
		
		if($javascript):
			echo $javascript->link(array(
	            'jquery.ui-1.6rc2/jquery-1.2.6',
	            'jquery.ui-1.6rc2/jquery.ui.all'
			));
		endif;
	
		echo $scripts_for_layout;
	?>
</head>
<body>
<h1>Uitvaartbron</h1>
	<div id="top">
		<ul id="menu">
			<li class="selectedFirst"><?php echo $html->link('Home', ''); ?></li>
			<li><?php echo $html->link('Vergelijken', ''); ?></li>
			<li><?php echo $html->link('Bedrijvengids', ''); ?></li>
			<li><?php echo $html->link('Informatie', ''); ?></li>
			<li><?php echo $html->link('Nieuws', ''); ?></li>
			<li class="last"><?php echo $html->link('Forum', ''); ?></li>
			<li id="menuMijnAccountSelected"><?php echo $html->link('Mijn account', ''); ?></li>
		</ul>

		<div class="clear"></div>

		<ul id="submenu">
			<li><?php echo $html->link('Gratis aanmelden', ''); ?></li>
		</ul>

		<div class="clear"></div>

	</div>
	<div id="container">

		<div id="containerLeft">
			<div id="homepageBos">
				<h2>Uw uitvaartstartpunt!</h2>
				<p>Home</p>
				<?php echo $html->link('Uitvaartverzekeringen vergelijken? Klik hier!', ''); ?>
			</div>

			<ul id="quicklinks">
				<li><?php echo $html->link('Vergelijk hier alle uitvaartverzekeraars!', '', array('id' => 'qVergelijken')); ?></li>
				<li><?php echo $html->link('Vind bedrijven uit de uitvaartbranche dicht bij u in de buurt!', '', array('id' => 'qBedrijvengids')); ?></li>
				<li><?php echo $html->link('Alle informatie over uitvaarten vindt u hier!', '', array('id' => 'qInformatie')); ?></li>
				<li><?php echo $html->link('Al het laatste uitvaartnieuws', '', array('id' => 'qNieuws')); ?></li>
				<li><?php echo $html->link('Geef uw mening op ons uitgebreide forum', '', array('id' => 'qForum')); ?></li>
			</ul>

			<div id="actueelNieuws">
				<h2>Actueel Nieuws</h2>
				<ul>					
					<li class="selected">						
						<h3>Nabestaanden financieel achteruit door onwetendheid</h3>
						<p>
							Bijna de helft van de nabestaanden gaat er financieel op achteruit nadat de partner is overleden. Mensen hebben lang niet allemaal maatregelen genomen om dit overlijdensrisico op te vangen. Onwetendheid is hiervan een belangrijke oorzaak: onderzoek van de Sociale Verzekeringsbank onder samenwonenden toont aan dat men... 
							<?php echo $html->link('Meer lezen', ''); ?>
						</p>
					</li>
					<li class="notSelected"><a href=""><span>[18 november 2008]</span><h3>Nabestaanden financieel achteruit door onwetendheid</h3></a></li>
					<li class="notSelected"><a href=""><span>[18 november 2008]</span><h3>Nabestaanden financieel achteruit door onwetendheid</h3></a></li>
					<li class="notSelected"><a href=""><span>[18 november 2008]</span><h3>Nabestaanden financieel achteruit door onwetendheid</h3></a></li>
					<li class="notSelected"><a href=""><span>[18 november 2008]</span><h3>Nabestaanden financieel achteruit door onwetendheid</h3></a></li>
					<li class="notSelected"><a href=""><span>[18 november 2008]</span><h3>Nabestaanden financieel achteruit door onwetendheid</h3></a></li>
					<li class="notSelected"><a href=""><span>[18 november 2008]</span><h3>Nabestaanden financieel achteruit door onwetendheid</h3></a></li>
					<li class="notSelected"><a href=""><span>[18 november 2008]</span><h3>Nabestaanden financieel achteruit door onwetendheid</h3></a></li>
					<li class="notSelected"><a href=""><span>[18 november 2008]</span><h3>Nabestaanden financieel achteruit door onwetendheid</h3></a></li>
					<li class="notSelected"><a href=""><span>[18 november 2008]</span><h3>Nabestaanden financieel achteruit door onwetendheid</h3></a></li>
					<li class="notSelected"><a href=""><span>[18 november 2008]</span><h3>Nabestaanden financieel achteruit door onwetendheid</h3></a></li>
				</ul>

				<p><?php echo $html->link('Alle berichten bekijken', '', array('id' => 'alleBerichten')); ?></p>

			</div>
		
		</div>
		<div id="containerRight">

			<div id="mijnAccount">

				<h2>Mijn account</h2>
				<p>Login op je account of <?php echo $html->link('<strong>maak gratis een nieuw account aan</strong>', ''); ?>.</p>

				<form>
					<input type="text" value="E-mail adres" />
					<input type="text" value="Wachtwoord" />
					<div><input type="checkbox" id="checkbox" /><span>Onthoud mij</span></div>
					<input type="submit" value="Inloggen" id="submit" />
				</form>

				<div class="clear"></div>

				<p id="gegevensverloren" >Gegevens verloren? <?php echo $html->link('Klik hier', ''); ?>.</p>

			</div>

			<div id="vergelijkZeAllemaal">
				<div id="vergelijkZeAllemaalInner">
					<h2>Vergelijk ze allemaal</h2>
					<ul> 
						<li><?php echo $html->link($html->image('logoYarden.gif'), '', array('title' => 'Yarden'), null, null, true); ?></li>
						<li><?php echo $html->link($html->image('logoArdanta.gif'), '', array('title' => 'Ardanta'), null, null, true); ?></li>
						<li><?php echo $html->link($html->image('logoReaal.gif'), '', array('title' => 'Reaal'), null, null, true); ?></li>
						<li><?php echo $html->link($html->image('logoDela.gif'), '', array('title' => 'Dela'), null, null, true); ?></li>
						<li><?php echo $html->link($html->image('logoMonuta.gif'), '', array('title' => 'Monuta'), null, null, true); ?></li>
						<li><?php echo $html->link($html->image('logoKlaverblad.gif'), '', array('title' => 'Klaverblad'), null, null, true); ?></li>
					</ul>
					<p><?php echo $html->link('Meer informatie over vergelijken', ''); ?></p>
				</div>
			</div>
		</div>

		<div class="clear"></div>			
	</div>

	<div id="containerBottom"><hr></hr></div>
	
	<div id="sitemap">
		<ul>
			<li><strong>Vergelijken</strong></li>
			<li><?php echo $html->link('Vergelijken', ''); ?></li>
			<li><?php echo $html->link('Hoe werkt het?', ''); ?></li>
			<li><?php echo $html->link('Vergelijking e-mailen', ''); ?></li>
		</ul>
		<ul>
			<li><strong>Bedrijvengids</strong></li>
			<li><?php echo $html->link('Bedrijven zoeken', ''); ?></li>
			<li><?php echo $html->link('Uw bedrijf aanmelden', ''); ?></li>
		</ul>
		<ul>
			<li><strong>Nieuws</strong></li>
			<li><?php echo $html->link('Laatste nieuws', ''); ?></li>
			<li><?php echo $html->link('Archief', ''); ?></li>
		</ul>
		<ul>
			<li><strong>Forum</strong></li>
			<li><?php echo $html->link('Inloggen', ''); ?></li>
			<li><?php echo $html->link('Gratis aanmelden', ''); ?></li>
		</ul>
		<ul>
			<li><strong>Uitvaartbron.nl</strong></li>
			<li><?php echo $html->link('Over ons', ''); ?></li>
			<li><?php echo $html->link('Contact', ''); ?></li>
			<li><?php echo $html->link('Vacatures', ''); ?></li>
		</ul>
		<ul>
			<li><strong>Overig</strong></li>
			<li><?php echo $html->link('Sitemap', ''); ?></li>
			<li><?php echo $html->link('Disclaimer', ''); ?></li>
			<li><?php echo $html->link('Algemene voorwaarden', ''); ?></li>
		</ul>

		<div class="clear"></div>
	</div>
	
	<div id="informatieLinks">
		<ul>
			<li><?php echo $html->link('Checklist', ''); ?></li>
			<li><?php echo $html->link('Rouwcentrum', ''); ?></li>
			<li><?php echo $html->link('Uitvaartkisten', ''); ?></li>
			<li><?php echo $html->link('Rouwadvertenties', ''); ?></li>
			<li><?php echo $html->link('Kinderen', ''); ?></li>
			<li><?php echo $html->link('Uitvaartondernemer', ''); ?></li>
			<li><?php echo $html->link('Checklist', ''); ?></li>
			<li><?php echo $html->link('Rouwcentrum', ''); ?></li>
			<li><?php echo $html->link('Uitvaartkisten', ''); ?></li>
			<li><?php echo $html->link('Uitvaartondernemer', ''); ?></li>
			<li><?php echo $html->link('Verzorging overledene', ''); ?></li>
			<li><?php echo $html->link('Rouwkaarten', ''); ?></li>
			<li><?php echo $html->link('Rouwkaart gedichten', ''); ?></li>
			<li><?php echo $html->link('Verzorging overledene', ''); ?></li>
			<li><?php echo $html->link('Opbaren', ''); ?></li>
			<li><?php echo $html->link('Uitvaartondernemer', ''); ?></li>
			<li><?php echo $html->link('Verzorging overleden', ''); ?></li>
			<li><?php echo $html->link('Rouwkaarten', ''); ?></li>
			<li><?php echo $html->link('Opbaren', ''); ?></li>
			<li><?php echo $html->link('Afscheid nemen', ''); ?></li>
			<li><?php echo $html->link('Teksten rouwkaarten', ''); ?></li>
			<li><?php echo $html->link('Rouwvervoer', ''); ?></li>
			<li><?php echo $html->link('Checklist', ''); ?></li>
			<li><?php echo $html->link('Rouwcentrum', ''); ?></li>
			<li><?php echo $html->link('Opbaren', ''); ?></li>
			<li><?php echo $html->link('Afscheid nemen', ''); ?></li>
			<li><?php echo $html->link('Teksten rouwkaarten', ''); ?></li>
		</ul>
		<div class="clear"></div>
	</div>
	
	<p id="footer">
		Copyright &copy; 2008 Uitvaartbron.nl - Alle rechten voorbehouden
	</p>
	<?php echo $cakeDebug; ?>
</body>
</html>