<?php
class User extends AppModel {

    public $validate = array(
        'username' => array(
            'rule' => 'alphaNumeric'
        ),
        'passwd' => array(
            'rule' => array('minLength', 4)
        ),
        'passwd2' => array(
            'rule' => array('comparePassword'),
            'required' => false
        )
    );

    public function beforeValidate() {
        // if left empty, remove from data array
        if((isset($this->data['User']['passwd']) && empty($this->data['User']['passwd'])) && (isset($this->data['User']['passwd2']) && empty($this->data['User']['passwd2']))) {
            unset($this->data['User']['passwd']);
            unset($this->data['User']['passwd2']);
        }

        return true;
    }

    public function beforeSave() {
        // Hash the password
        if(isset($this->data['User']['passwd'])) {
            $this->data['User']['password'] = Security::hash(Configure::read('Security.salt') . $this->data['User']['passwd']);
        }
        return true;
    }


    public function comparePassword(&$data) {
        return $data['passwd2'] == $this->data['User']['passwd'];
    }

}
?>