<?php

/**
 * Elements Controller
 */

class ElementsController extends AppController {

    /**
     * update content of current element type
     */
    public function update(){
        $result = array('success' => false);

        // get element id from POST
        $element_id = (int) $this->params['form']['element_id'];

        /**
         * Load element to see what class/model is used
         */
        $this->Element->recursive = 0;
        $element = $this->Element->read(array('id','class'), $element_id);

        // init model of element type
        $Element =& ClassRegistry::init($element['Element']['class']);
        if (is_object($Element)) {
            if ($Element->save($this->data)){
                $result = array('success' => true);
            }
        }

        $this->set(compact('result'));
    }

}
?>