<?php echo $paginator->options(array('url' => array('pb' => true))); ?>

<?php 
echo $this->renderElement('pb_actions', array('actions' => array(
    'Add user' => array('action' => 'add', 'pb' => true)
)));
?>

<div class="block">
    <h2><span><?php __d('pb', 'View users'); ?></span></h2>
    <div class="inner-block no-border">
        <table>
            <thead>
                <tr>
                    <th><?php echo $paginator->sort(__d('pb', 'Username', true), 'username'); ?></th>
                    <th><?php echo $paginator->sort(__d('pb', 'Display name', true), 'name'); ?></th>
                    <th><?php echo $paginator->sort(__d('pb', 'Email', true), 'email'); ?></th>
                    <th><?php echo $paginator->sort(__d('pb', 'Created on', true), 'created'); ?></th>
                    <th></th>
                </tr>
            </thead>
            
            <tbody>
                <?php foreach($users as $user) : ?>
                <tr>
                    <td><?php echo $html->link($user['User']['username'], array('action' => 'edit', 'pb' => true, $user['User']['id'])); ?></td>
                    <td><?php echo $user['User']['name']; ?></td>
                    <td><?php echo $user['User']['email']; ?></td>
                    <td><?php echo $time->niceShort($user['User']['created']); ?></td>
                    <td><?php if($user['User']['id'] != 1) { echo $html->link(__d('pb', 'Delete', true), array('action' => 'delete', 'pb' => true, $user['User']['id'])); } ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>  
        </table>
    </div>
</div>

<?php echo $this->renderElement('pb_pagination'); ?>