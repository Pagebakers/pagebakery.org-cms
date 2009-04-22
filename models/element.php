<?php

/**
 * Element Model
 *
 * Elements are placed into containers on the site and
 * are ordered by id ascending
 */

class Element extends AppModel {

    public $hasOne = array(
        'TextElement',
        'HtmlElement'
    );

    /**
     * BelongsTo Relationship
     * @var string
     */
    public $belongsTo = array(
        'Page'
    );

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