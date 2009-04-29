<?php

/**
 * Pages Controller
 * 
 * contains all page related actions
 *
 */

class PagesController extends AppController {

    public $helpers = array('Elements');

    public $view = 'Page';
    
    public $theme = 'default';

    public $uses = array('Page', 'Element');
	/**
	 * display Page using slug
	 *
	 * @param $slug string, contains slug of page
	 */
    function view( $slug = '' ){
        $this->view = 'Page';
        $this->layout = 'default';
        
        if( empty($slug) ) { // render the homepage
            $page = $this->Page->find( 'first', array( 'order' => 'Page.lft ASC', 'contain' => array() ));
        } else {
            $page = $this->Page->find( 'first', array( 'conditions' => array( 'Page.slug' => $slug ), 'contain' => array() ) );
        }
        
        $this->Page->id = $page['Page']['id']; // Need to set the current ID in order to automatically load all elements

        $this->set(compact('page'));
    }

	/**
	 * get titles of all pages
	 */
	function getPageTitles() {
		$pages = $this->Page->generatetreelist(null, null, null, '--');
		$this->set('pages', $pages);
	}

	/**
	 * savePage action
	 */
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

	function admin_index() {

	}

	/**
	 * Add Page
	 *
	 * @param $parent_id int, contains integer if has parent_id, null otherwise
	 */
	function admin_add($parent_id = null) {
		$this->set('parent_id', $parent_id);

		// Get pagetitles for parent_id
		$this->getPageTitles();

		$this->savePage();
	}

	/**
	 * Edit Page
	 *
	 * @param $id int, contains id of page to edit 
	 */
	function admin_edit($slug = '') {
        $this->view($slug);

        $elements = $this->Element->find('all');

        $this->set(compact('elements'));

        $this->render('view');
	}

	/**
	 * bind Element to Page
	 */
	function admin_bindElement() {

	}

}

?>
