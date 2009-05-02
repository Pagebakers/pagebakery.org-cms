<?php
/**
 * Model for the "Text" element
 */

class TextElement extends AppModel {

    /**
     * creates dummy (empty) record
     * @return int contains last inserted id
     */
    public function create_dummy(){
        $data['TextElement'] = array('value' => '');
        $this->id = null;
        if ($this->save($data)){
            return $this->getLastInsertId();
        } else {
            $this->log('failed creating dummy');
        }
    }

}


?>
