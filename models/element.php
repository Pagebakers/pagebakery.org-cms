<?php

/**
 * Element Model
 *
 * Elements are placed into containers on the site and
 * are ordered by id ascending
 */

class Element extends AppModel {

    /**
     * Name of the model
     * @var string
     */
    var $name = 'Element';

    /**
     * BelongsTo Relationship
     * @var string
     */
    var $belongsTo = 'Page';

    /**
     * HasOne Relationship
     * @var string
     */
    var $hasOne = 'ContentType';

    /**
     * Validation Rules
     * @var array
     */
    public $validate = array(
        'name'  => array(
            'rule'      => array('minLength', 2),
            'allowEmpty'=> false,
            'required'  => true,
            'message' => 'The name is too short.'
        ),
        'container' => array(
            'rule'      => array('minLength', 2),
            'allowEmpty'=> false,
            'message'   => 'Container name is too short!'
        )
    );
}

?>