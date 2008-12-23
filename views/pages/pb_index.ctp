<?php $paginator->url(array('pb' => true)); ?>
<div class="block">
    <h2><span><?php __d('pb', 'View pages'); ?></span></h2>
    <div class="inner-block">
    <?php echo $html->link(__d('pb', 'New page', true), array('action' => 'add', 'pb' => true));?>
    <?php
    echo $tree->generate($pages, array('model' => 'Page', 'element' => 'pb_pages_tree', 'class' => 'list'));
    ?>
    </div>
</div>

<?php echo $this->renderElement('pb_pagination'); ?>