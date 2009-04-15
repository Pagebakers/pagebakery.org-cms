<?php
/**
 * Model for the "Html" element
 */

class HtmlElement extends AppModel {

    var $name       = 'HtmlElement';

    /**
     * BelongsTo Relationship
     * @var string
     */
    public $belongsTo  = 'Element';
}


?>
