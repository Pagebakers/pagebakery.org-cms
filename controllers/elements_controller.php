<?php

/**
 * Elements Controller
 */

class ElementsController extends AppController {

    /**
     * update content of current element type
     */
    public function update(){
        if ($this->$class->update()){
            // dikke wojo! tis gelukt
        }
    }

}
?>