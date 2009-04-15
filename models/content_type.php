<?php
/**
 * Content Type model
 */

class ContentType extends AppModel {

    /**
     * Name of the model
     * @var string
     */
    var $name = 'ContentType';

    /**
     * Validation Rules
     * @var array
     */
    public $validate = array(
        'name'  => array(
            'rule'      => array('minLength', 2),
            'allowEmpty'=> false,
            'required'  => true,
            'message'   => 'The name is too short.'
        ),
        'model' => array(
            'rule'      => array('minLength', 2),
            'allowEmpty'=> false,
            'message'   => 'Model name is too short!'
        )
    );

}


?>