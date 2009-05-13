<?php echo sprintf(__d('pb', 'Dear %s,', true), $user['User']['name']); ?>


<?php __d('pb', 'By following the url below you can reset your password.'); ?>


<?php echo Router::url(array('controller' => 'users', 'action' => 'resetpassword', 'admin' => true, $user['User']['loststring'] ), true); ?>