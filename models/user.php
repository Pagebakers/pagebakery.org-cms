<?php
class User extends AppModel {

    public $validate = array(
        'username' => array(
			'allowedChars' => array(
				'rule' => 'alphaNumeric',
				'message' => 'only letters and digits are allowed', 
				'required' => true
				),
			'unique'	=> array(
				'rule' => array('userExist'),
				'message' => 'a user with this username already exists',
				)
        ),
		'email' => array(
			'allowedChars' => array(
				'rule' => 'email',
				'message' => 'this is not a valid e-mail address',
				'required' => true
				),
			'unique'	=> array(
				'rule' => array('emailExist'),
				'message' => 'a user with this email address already exists',
				)
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
        // if password field left empty, remove from data array
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

	/**
	 * check if username already exists
	 * @return bool, true if username exist, false otherwise
	 */
	public function userExist(){
		$params = array(
			'conditions' => array('User.username' => $this->data['User']['username']),
			'recursive' => -1
			);
		if(isset($this->data['User']['username'])){
			$results = $this->find('count',$params);
		}
		return ($results > 0) ? false : true;
	}
	
	/**
	 * check if email already exists
	 * @return bool, true if email exist, false otherwise
	 */
	public function emailExist(){
		$params = array(
			'conditions' => array('User.email' => $this->data['User']['email']),
			'recursive' => -1
			);
		if(isset($this->data['User']['email'])){
			$results = $this->find('count',$params);
		}
		return ($results > 0) ? false : true;
	}	

    public function comparePassword(&$data) {
        return $data['passwd2'] == $this->data['User']['passwd'];
    }

}
?>