<?php
/**
 * Content Type "Text" model
 */

class Cttext extends AppModel {

    var $name       = 'Cttext';
    var $useTable   = 'cttext';

    /**
     * BelongsTo Relationship
     * @var string
     */
    public $belongsTo  = 'Element';
}


?>