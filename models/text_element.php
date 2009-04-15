<?php
/**
 * Model for the "Text" element
 */

class TextElement extends AppModel {

    var $name       = 'TextElement';

    /**
     * BelongsTo Relationship
     * @var string
     */
    public $belongsTo  = 'Element';
}


?>
