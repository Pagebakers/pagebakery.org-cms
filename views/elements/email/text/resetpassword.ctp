<?php echo sprintf(__d('pb', 'Dear %s,', true), $user['User']['name']); ?>


<?php __d('pb', 'Your password was reset.'); ?>
<?php __d('pb', 'Username: '); echo $user['User']['username']; ?>
<?php __d('pb', 'New password: '); echo $new_pass; ?>