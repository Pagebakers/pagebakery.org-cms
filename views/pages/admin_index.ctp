<?php $paginator->url(array('admin' => true)); ?>
<div class="block">
    <h2><span><?php __( 'View pages'); ?></span></h2>
    <div class="inner-block">
    <?php echo $html->link(__( 'New page', true), array('action' => 'add', 'admin' => true));?>
    <?php
    echo $tree->generate($pages, array('model' => 'Page', 'element' => 'admin_pages_tree', 'class' => 'list'));
    ?>
    </div>
</div>

<?php echo $this->renderElement('admin_pagination'); ?>