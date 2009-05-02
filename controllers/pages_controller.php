<?php

/**
 * Pages Controller
 * 
 * contains all page related actions
 *
 */

class PagesController extends AppController {

    public $uses = array('Page', 'Element', 'TextElement');

    public $helpers = array('Elements');
    
    public $theme = 'default';
    
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
	 * bind Element to a Page
     *
     * saves relation between page and element
     *
     * @TODO:   missing container, element_id data in POST request
	 */
	function admin_bindElement() {
        // save relationship
        $this->Page->ElementsPage->save($this->params['form']);
	}

	/**
	 * unbind Element from a Page
     *
     * delete the relationship between page and element
	 */
	function admin_unbindElement($id = null) {
        // delete relationship
        $this->Page->ElementsPage->delete($id);
	}

}

?>
