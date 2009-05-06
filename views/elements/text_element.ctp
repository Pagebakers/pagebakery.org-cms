<?php

/**
 * using cakephp built in sanitize function to filterout html
 * and convert newlines to br
 */
echo nl2br( Sanitize::html($data['TextElement']['value']) );

?>