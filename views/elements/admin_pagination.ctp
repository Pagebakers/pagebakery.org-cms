<ul class="pagination">
    <li><?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled', 'tag' => 'span'));?></li>
    <li><?php echo $paginator->first(__('first', true), array(), null, array('class'=>'disabled', 'tag' => 'span'));?></li>
    <li><?php echo $paginator->numbers(array('separator' => '</li><li>'));?></li>
    <li><?php echo $paginator->last(__('last', true), array(), null, array('class'=>'disabled', 'tag' => 'span'));?></li>
    <li class="last"><?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled', 'tag' => 'span'));?></li>
</ul>