<?php
class ElementsHelper extends AppHelper {

    public function container($name) {
        $elements = $this->element('text', array('content' => 'HOI!!'));
        
        return sprintf('<div class="ct" id="%s">%s</div>', $name, $elements);
    }
    
    public function element($type = 'text', $data = array()) {
        $View =& ClassRegistry::getObject('view');
        $element = $View->element($type, array('data' => $data));
        
        return sprintf('<div class="pb-element-%s">%s</div>', $type, $element); 
    }

}
?>