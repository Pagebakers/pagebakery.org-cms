<?php
/**
 * Content Type "Html" model
 */

class Cthtml extends AppModel {

    var $name       = 'Cthtml';
    var $useTable   = 'cthtml';

    /**
     * BelongsTo Relationship
     * @var string
     */
    public $belongsTo  = 'Element';
}


?>