<?php
class ElementsPage extends AppModel {

    public $hasOne = array(
        'Element',
        'Page'
    );

}
?>