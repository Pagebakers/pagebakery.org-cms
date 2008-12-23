<ul class="actions">
<?php foreach($actions as $text => $url) : ?>
    <li><?php echo $html->link(__( $text, true), $url, array('class' => 'button')); ?></li>
<?php endforeach; ?>
</ul>