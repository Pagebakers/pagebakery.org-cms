<?php
/**
 * Model for the "Html" element
 */

class HtmlElement extends AppModel {

    /**
     * BelongsTo Relationship
     * @var string
     */
    public $belongsTo  = array(
        'ElementsPage' => array(
            'foreignKey' => 'foreign_id'
        )
    );
    
}


?>
