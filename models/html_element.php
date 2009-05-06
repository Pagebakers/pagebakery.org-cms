<?php
/**
 * Model for the "Html" element
 */

class HtmlElement extends AppModel {

    /**
     * creates dummy (empty) record
     * @return int contains last inserted id
     */
    public function create_dummy(){
        $data['HtmlElement'] = array('value' => '');
        $this->id = null;
        if ($this->save($data)){
            return $this->getLastInsertId();
        }
        return false;
    }
}


?>
