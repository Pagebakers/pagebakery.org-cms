<?php
/**
 * Model for the "Text" element
 */

class TextElement extends AppModel {

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
