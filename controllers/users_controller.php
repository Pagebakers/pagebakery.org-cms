<?php
class UsersController extends AppController {

    var $helpers = array('Time');

    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->addBreadcrumb(array(__('Users', true), array('controller' => 'users', 'action' => 'index')));
    }

    public function admin_index() {
        $this->paginate = array(
            'limit' => 25,
            'order' => 'User.id ASC'
        );
        $users = $this->paginate('User');

        $this->set(compact('users'));
    }

    public function admin_login() {
        if( !empty($this->data) ) {
            if( $this->Auth->login($this->data) ) {
                $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
            }
        }
        $this->layout = 'admin_clean';
    }

    public function admin_logout() {
        $this->Auth->logout();
        $this->redirect('/');
    }

    public function admin_add() {
        if(!empty($this->data)) {
            $this->User->set($this->data);
            if($this->User->save()) {
                $this->Session->setFlash(__('User successfully added', true));
                $this->redirect(array('action' => 'index'));
            }
        }
        $this->addBreadcrumb(array(__('Add', true), array('controller' => 'users', 'action' => 'add')));
    }

    public function admin_edit($id = null) {
        if(!$id) {
            $this->Session->setFlash(__('Invalid user id', true));
            $this->redirect(array('action' => 'index'));
        }
        
        if( empty($this->data) ) {
            $this->data = $this->User->read(null, $id);
        } else {
            $this->User->set($this->data);
            if( $this->User->save() ) {
                $this->Session->setFlash(__('User successfully saved', true));
            }
        }
        
        $this->addBreadcrumb(array($this->data['User']['username'], array('controller' => 'users', 'action' => 'index', $this->data['User']['id'])));
    }

    public function admin_delete($id = null) {
        $this->autoRender = false;
        if(!$id) {
            $this->Session->setFlash(__('Invalid user id', true));
            $this->redirect(array('action' => 'index'));
        } elseif($id == 1) {
            $this->Session->setFlash(__('This user can\'t be deleted', true));
            $this->redirect(array('action' => 'index'));

            if($this->User->delete($id)) {
                $this->Session->setFlash(__('User deleted', true));
            } else {
                $this->Session->setFlash(__('Deleting failed', true));
            }

            $this->redirect(array('action' => 'index'));
        }
    }

}
?>