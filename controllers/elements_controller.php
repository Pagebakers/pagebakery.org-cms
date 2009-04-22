<?php
class ElementsController extends AppController {

	var $name = 'Elements';

	function index() {
		$this->Element->recursive = 0;
		$this->set('elements', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Element.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('element', $this->Element->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Element->create();
			if ($this->Element->save($this->data)) {
				$this->Session->setFlash(__('The Element has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Element could not be saved. Please, try again.', true));
			}
		}
		$pages = $this->Element->Page->find('list');
		$this->set(compact('pages'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Element', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Element->save($this->data)) {
				$this->Session->setFlash(__('The Element has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Element could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Element->read(null, $id);
		}
		$pages = $this->Element->Page->find('list');
		$this->set(compact('pages'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Element', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Element->del($id)) {
			$this->Session->setFlash(__('Element deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->Element->recursive = 0;
		$this->set('elements', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Element.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('element', $this->Element->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Element->create();
			if ($this->Element->save($this->data)) {
				$this->Session->setFlash(__('The Element has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Element could not be saved. Please, try again.', true));
			}
		}
		$pages = $this->Element->Page->find('list');
		$this->set(compact('pages'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Element', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Element->save($this->data)) {
				$this->Session->setFlash(__('The Element has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Element could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Element->read(null, $id);
		}
		$pages = $this->Element->Page->find('list');
		$this->set(compact('pages'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Element', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Element->del($id)) {
			$this->Session->setFlash(__('Element deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>