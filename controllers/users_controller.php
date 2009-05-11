<?php

/**
 * Users controller
 */

class UsersController extends AppController {

    public $helpers    = array('Time');
    public $components = array('Email');

    public function beforeFilter() {
        parent::beforeFilter();

        $this->addBreadcrumb(array(__('Users', true), array('controller' => 'users', 'action' => 'index')));
    }

    public function admin_lostpassword() {
        $this->pageTitle = __('Lost your password?', true);
        if( !empty($this->data['User']['email']) ) {
            if( $user = $this->User->findByEmail($this->data['User']['email'], array('id', 'email', 'name')) ) {
                if( !empty($user['User']['lost_string']) ) {
                    $this->Session->setFlash(__('There already has been sent a request to reset your password, please check your mailbox.', true));
                    $this->redirect('/');
                }

                App::import('String');
                $user['User']['lost_string'] = String::uuid();

                if($this->User->save($user)) {
                    $this->Email->to = $user['User']['email'];
                    $this->Email->subject = __('Reset your password', true);
                    $this->Email->from = Configure::read('Pagebakery.noreply');
                    $this->Email->template = 'lost_password';
                    $this->Email->sendAs = 'text';
                    $this->set(compact('user'));
                    $this->Email->send();

                    $this->Session->setFlash(__('An email with instructions to reset your password has been sent.', true));
                } else {
                    $this->Session->setFlash(__('Oops, something went wrong, please try again later.', true));
                }

                $this->redirect('/');
            } else {
                $this->User->invalidate('email');
            }
        }
    }

    public function admin_resetpassword($lost_string = null) {
        $this->pageTitle = __('Reset your password', true);
        if($lost_string) {
            $this->set('lost_string', $lost_string);
            $user = $this->User->findByLostString($lost_string);
            if( !$user ) {
                $this->redirect('/');
            }
            if( !empty($this->data) ) {
                $this->data['User']['id'] = $user['User']['id'];
                $this->data['User']['lost_string'] = null;
                if($this->User->save($this->data)) {
                    $this->Session->setFlash(__('Your password has been reset, your can now login with your new password.', true));
                    $this->redirect('/');
                }
            }
        } else {
            $this->redirect('/');
        }
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
            else{
                $this->Session->setFlash( __('Username and/or password don\'t match', true) );
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
