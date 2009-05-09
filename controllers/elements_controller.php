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

    /**
     * Move element up or down
     * @param int $id 
     */
    public function admin_move(){
        $result = array('success' => false);

        $scope = array(
            'ElementsPage.container' => $this->params['form']['container']
        );

        $this->Element->ElementsPage->Behaviors->attach(
            'Tree',
            array('scope' => $scope)
        );

        // get id of element
        $id     = (int)$this->params['form']['id'];

        // get delta
        $delta  = (int)$this->params['form']['delta'];

        if ($id < 0):
            if ($this->Element->ElementsPage->moveup($id, abs($delta))) :
                $result = array('success' => true);
            endif;
        else:
            if ($this->Element->ElementsPage->movedown($id, abs($delta))) :
                $result = array('success' => true);
            endif;
        endif;

        $this->set(compact('result'));
    }

}
?>