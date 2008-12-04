<div class="block">
    <h2><span><?php __d('pb', 'View pages'); ?></span></h2>
    <div class="inner-block">
    <?php echo $html->link(__d('pb', 'New page', true), array('action' => 'add', 'pb' => true));?>
    <?php
    echo $tree->generate($pages, array('model' => 'Page', 'element' => 'pb_pages_tree', 'class' => 'list'));
    ?>
    </div>
</div>

<table class="navigation">
	<tr>
		<td><?php echo $paginator->prev('<< '.__d('pb', 'Previous', true), array(), null, array('class'=>'disabled'));?></td>
		<td>| <?php echo $paginator->numbers();?></td>
		<td><?php echo $paginator->next(__d('pb', 'Next', true).' >>', array('controller' => 'users'), null, array('class'=>'disabled'));?></td>
	</tr>
</table>