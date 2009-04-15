<?php
class PagesController extends AppController {

	var $uses = array('Page');

    var $view = 'Theme';
    var $theme = 'default';

    function index() {}

    function view( $slug ){
        $this->layout = 'default';
        $this->set('page', $this->Page->find( 'first', array( 'conditions' => array( 'slug' => $slug ) ) ) );
    }

	function admin_index() {

	}

	function admin_edit($id = null) {
		$this->savePage();

		if($id) {
			$page = $this->Page->findById($id);
			$this->data = $page;

			// Get pagetitles for parent_id
			$this->getPageTitles();
		}else{
			$this->redirect(array('action' => 'index', 'admin' => true));
		}
	}

	function admin_add($parent_id = null) {
		$this->set('parent_id', $parent_id);

		// Get pagetitles for parent_id
		$this->getPageTitles();

		$this->savePage();
	}

	function getPageTitles() {
		$pages = $this->Page->generatetreelist(null, null, null, '--');
		$this->set('pages', $pages);
	}

	function savePage() {
		if($this->data) {
			if($this->Page->save($this->data)){
				$this->Session->setFlash(__('Page saved', true));
				$this->redirect(array('action' => 'edit', 'admin' => true, $this -> Page -> id));
			}else{
				$this->Session->setFlash(__('Page not saved', true));
			}
		}
	}
}
?>