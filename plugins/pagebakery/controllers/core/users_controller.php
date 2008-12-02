<?php
class UsersController extends PagebakeryAppController {
    
    public function pb_index() {
    
    }
    
    public function pb_login() {
        if( !empty($this->data) ) {
            if( $this->Auth->login($this->data) ) {
                $this->redirect(array('controller' => 'dashboard', 'action' => 'index', 'pb' => true));
            }
        }
        $this->layout = 'admin_login';
    }
    
    public function pb_logout() {
        $this->autoRender = false;
        $this->Auth->logout();
    }
    
    public function pb_edit($id = null) {
        if(!$id) {
            $this->Session->setFlash(__d('pb', 'Invalid user id', true));
            $this->redirect(array('controller' => 'index', 'pb' => true));
        }
        
        if( empty($this->data) ) {
            $this->data = $this->User->read(null, $id);
        } else {
            $this->User->set($this->data);
            if( $this->User->save() ) {
                $this->Session->setFlash(__d('pb', 'User successfully saved', true));
            }
        }
    }
    
    public function pb_delete($id = null) {
        $this->autoRender = false;
        if(!$id) {
            $this->Session->setFlash(__d('pb', 'Invalid user id', true));
            $this->redirect(array('controller' => 'index', 'pb' => true));
        } elseif($id == 1) {
            $this->Session->setFlash(__d('pb', 'This user can\'t be deleted', true));
            $this->redirect(array('controller' => 'index', 'pb' => true)); 
            
            if($this->User->delete($id)) {
                $this->Session->setFlash(__d('pb', 'User deleted', true));
            } else {
                $this->Session->setFlash(__d('pb', 'Deleting failed', true));
            }
            
            $this->redirect(array('controller' => 'index', 'pb' => true)); 
        }
    }
    
}
?>