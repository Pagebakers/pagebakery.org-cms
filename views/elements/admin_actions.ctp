<ul class="actions">
<?php foreach($actions as $text => $url) : ?>
    <li><?php echo $html->link(__($text, true), $url, array('class' => 'button add')); ?></li>
<?php endforeach; ?>
</ul>