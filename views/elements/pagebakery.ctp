<?php if($session->check('Auth.User')) : ?>
<div class="pb-layout-east">
    <h3 class="pb-panel-header">Elements</h3>
    <div class="pb-panel-body">       
        <ul id="pb-elements-toolbar">
            <?php foreach($this->viewVars['elements'] as $element) : ?>
                <li class="pb-element">
                   <a href="#<?php echo $element['Element']['id']; ?>" class="pb-element-<?php echo strtolower($element['Element']['name']); ?>"><?php echo $element['Element']['name']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php
    echo $html->css(array(
        'pagebakery.ui'
    ));
    
    echo $javascript->link(array(
        'jquery.class',
    	'jquery-1.3.2.min',
    	'jquery-ui-1.7.1.min',
    	'jquery-json-1.3.min',
    	'pagebakery'
    ));
    ?>
    	
    <script type="text/javascript">
        Pagebakery.config = {}
        Pagebakery.data = {}
        
        Pagebakery.config.base = '<?php echo Router::url('/'); ?>';
        Pagebakery.data.Page = <?php echo json_encode($page['Page']); ?>
    </script>
<?php endif; ?>