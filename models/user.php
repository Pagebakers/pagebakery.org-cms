<?php
class User extends AppModel {

    public $validate = array(
        'username' => array(
			'validUsername' => array(
				'rule' => 'alphaNumeric'
			),
			'uniqueUsername' => array(
				'rule' => 'isUnique'
			)
        ),
		'email' => array(
			'validEmail' => array(
				'rule' => 'email'
			),
			'uniqueEmail' => array(
				'rule' => 'isUnique'
			)
        ),
        'passwd' => array(
            'rule' => array('minLength', 4)
        ),
        'passwd2' => array(
			'minLength' => array(            
				'rule' => array('minLength', 4)
			),
			'comparePass' => array(            
				'rule' => array('comparePassword')
			)			
        )
    );

    public function beforeValidate() {
        // if password field left empty on update (edit), remove from data array
		if (isset($this->data['User']['id'])){
			if((isset($this->data['User']['passwd']) && empty($this->data['User']['passwd'])) && (isset($this->data['User']['passwd2']) && empty($this->data['User']['passwd2']))) {
				unset($this->data['User']['passwd']);
				unset($this->data['User']['passwd2']);
			}
		}
        return true; 
    }

    public function beforeSave() {
        // Hash the password
        if (isset($this->data['User']['passwd'])) {
            $this->data['User']['password'] = Security::hash(Configure::read('Security.salt') . $this->data['User']['passwd']);
        }
        return true;
    }
	
    public function comparePassword(&$data) {
        return $data['passwd2'] == $this->data['User']['passwd'];
    }

}
?>