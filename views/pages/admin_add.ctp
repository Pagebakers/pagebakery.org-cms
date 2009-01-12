<?php echo $form->create('Page', array('url' => array( 'admin' => true ) ) ); ?>
<?php echo $form->input('Page.title', array('label' => __( 'Title', true))); ?>
<?php echo $form->input('Page.parent_id', array('type' => 'select', 'value' => $parent_id, 'options' => $pages, 'empty' => '', 'label' => __( 'Under page', true))); ?>
<?php echo $form->input('Page.content', array('label' => __( 'Content', true))); ?>
<?php echo $form->input('Page.meta_keywords', array('label' => __( 'Meta Keywords', true))); ?>
<?php echo $form->input('Page.meta_description', array('label' => __( 'Meta Description', true))); ?>
<?php echo $form->input('Page.slug', array('id' => 'slug', 'label' => __( 'Slug', true), 'size' => 50));?>
<?php echo $form->end(__( 'Save', true)); ?>