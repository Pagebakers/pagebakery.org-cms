<?php if($session->check('Auth.User')) : ?>
<div class="pb-layout-east">
    <?php

    pr($this->viewVars);

    ?>

    <h3 class="pb-panel-header">Elements</h3>
    <div class="pb-panel-body">       
        <ul id="pb-elements-toolbar">
            <li class="pb-element"><a href="#" class="pb-element-html">HTML</a></li>
            <li class="pb-element"><a href="#" class="pb-element-text">Text</a></li>
            <li class="pb-element"><a href="#" class="pb-element-image">Image</a></li>
            <li class="pb-element-group">
                <h4 class="pb-element-group-video">Video</h4>
                <ul>
                    <li class="pb-element"><a href="#" class="pb-element-youtube">Youtube</a></li>
                    <li class="pb-element"><a href="#" class="pb-element-vimeo">Vimeo</a></li>
                    <li class="pb-element"><a href="#" class="pb-element-metacafe">Metacafe</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <?php
    echo $html->css(array(
        'pagebakery.ui'
    ));
    
    echo $javascript->link(array(
        'jquery.class',
    	'jquery-1.3.1',
    	'jquery.ui/jquery.ui.all',
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