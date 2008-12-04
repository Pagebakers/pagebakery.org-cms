<h1><?php __d('pb', 'Pages');?></h1>
<?php echo $html->link(__d('pb', 'New page', true), array('action' => 'add', 'pb' => true));?><br /><br />
<?php
echo $tree->generate($pages, array('model' => 'Page', 'element' => 'pb_pages_tree', 'class' => 'list'));
?>
<table class="navigation">
	<tr>
		<td><?php echo $paginator->prev('<< '.__d('pb', 'Previous', true), array(), null, array('class'=>'disabled'));?></td>
		<td>| <?php echo $paginator->numbers();?></td>
		<td><?php echo $paginator->next(__d('pb', 'Next', true).' >>', array('controller' => 'users'), null, array('class'=>'disabled'));?></td>
	</tr>
</table>

<?php echo $html->link(__d('pb', 'New page', true), array('action' => 'add', 'pb' => true));?>