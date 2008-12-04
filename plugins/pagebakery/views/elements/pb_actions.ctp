<ul class="actions">
<?php foreach($actions as $text => $url) : ?>
    <li><?php echo $html->link(__d('pb', $text, true), $url); ?></li>
<?php endforeach; ?>    
</ul>