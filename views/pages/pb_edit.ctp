<?php $session->flash(); ?>
<?php echo $form->create('Page', array('url' => $html->url(array('pb' => true, $this->data['Page']['id'])))); ?>
<?php echo $form->input('Page.id'); ?>
<?php echo $form->input('Page.parent_id', array('type' => 'select', 'value' => $this->data['Page']['parent_id'], 'options' => $pages, 'empty' => '', 'label' => __d('pb', 'Under page', true))); ?>
<?php echo $form->input('Page.title', array('label' => __d('pb', 'Title', true))); ?>
<?php echo $form->input('Page.content', array('label' => __d('pb', 'Content', true))); ?>
<?php echo $form->input('Page.meta_keywords', array('label' => __d('pb', 'Meta Keywords', true))); ?>
<?php echo $form->input('Page.meta_description', array('label' => __d('pb', 'Meta Description', true))); ?>
<?php echo $form->input('Page.slug', array('id' => 'slug', 'label' => __d('pb', 'Slug', true), 'size' => 50));?>
<?php echo $form->end(__d('pb', 'Save', true)); ?>
<?php echo $html->link(__d('pb', 'Go back', true), array('action' => 'index', 'pb' => true)); ?>
<?php echo $html->link(__d('pb', 'Add subpage', true), array('action' => 'add', 'pb' => true, $this->data['Page']['id'])); ?>