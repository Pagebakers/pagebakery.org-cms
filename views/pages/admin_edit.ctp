<?php $session->flash(); ?>
<?php echo $form->create('Page', array('url' => $html->url(array('admin' => true, $this->data['Page']['id'])))); ?>
<?php echo $form->input('Page.id'); ?>
<?php echo $form->input('Page.parent_id', array('type' => 'select', 'value' => $this->data['Page']['parent_id'], 'options' => $pages, 'empty' => '', 'label' => __( 'Under page', true))); ?>
<?php echo $form->input('Page.title', array('label' => __( 'Title', true))); ?>
<?php echo $form->input('Page.content', array('label' => __( 'Content', true))); ?>
<?php echo $form->input('Page.meta_keywords', array('label' => __( 'Meta Keywords', true))); ?>
<?php echo $form->input('Page.meta_description', array('label' => __( 'Meta Description', true))); ?>
<?php echo $form->input('Page.slug', array('id' => 'slug', 'label' => __( 'Slug', true), 'size' => 50));?>
<?php echo $form->end(__( 'Save', true)); ?>
<?php echo $html->link(__( 'Go back', true), array('action' => 'index', 'admin' => true)); ?>
<?php echo $html->link(__( 'Add subpage', true), array('action' => 'add', 'admin' => true, $this->data['Page']['id'])); ?>