<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled', 'tag' => 'span'));?>
    <?php echo $paginator->first(__('first', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?> | 
    <?php echo $paginator->last(__('last', true), array(), null, array('class'=>'disabled'));?> | 
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled', 'tag' => 'span'));?>
</div>