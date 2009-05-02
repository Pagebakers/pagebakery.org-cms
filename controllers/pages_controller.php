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

        /**
         * Simulate input shit of @TODO
         */
        $this->params['form']['element_id'] = 1;
        $this->params['form']['container']  = 'content';

        /**
         * Load element to see what class/model is used
         */
        $this->Element->recursive = 0;
        $element = $this->Element->read(array('id','class'),$this->params['form']['element_id']);

        /**
         * Create dummy record in table
         */
        $foreign_id = $this->$element['Element']['class']->create_dummy();

        /**
         * Collect data
         */
        $this->data['ElementsPage'] = array(
            'container'     => 'content',
            'element_id'    => $element['Element']['id'],
            'page_id'       => $this->params['form']['page_id'],
            'foreign_id'    => $this->params['form']['container']
        );

        /**
         * Save relationship
         */
        $this->Page->ElementsPage->save($this->data);
	}

	/**
	 * unbind Element from a Page
     *
     * delete the relationship between page and element
	 */
	function admin_unbindElement($id = null) {

        // load elements_page
        $relation = $this->ElementsPage->read(null,$id);

        // get class of foreign id
        $class = $relation['Element']['class'];

        if ($this->$class->del($relation['ElementsPage']['foreign_id']) &&
            $this->Page->ElementsPage->delete($id)){
            return true;
        }
        return false;
	}

}

?>
