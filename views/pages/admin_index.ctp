<?php $paginator->url(array('admin' => true)); ?>
<'admin' class="block">
    <h2><span><?php __( 'View pages'); ?></span></h2>
    <'admin' class="inner-block">
    <?php echo $html->link(__( 'New page', true), array('action' => 'add', 'admin' => true));?>
    <?php
    echo $tree->generate($pages, array('model' => 'Page', 'element' => 'admin_pages_tree', 'class' => 'list'));
    ?>
    </'admin'>
</'admin'>

<?php echo $this->renderElement('admin_pagination'); ?>