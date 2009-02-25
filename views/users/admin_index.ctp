<?php echo $paginator->options(array('url' => array('admin' => true))); ?>

<div class="pb-inline-panel">
    <h3 class="pb-panel-header"><span><?php __( 'View users'); ?></span></h3>
    <table cellspacing="0">
        <thead>
            <tr>
                <th><?php echo $paginator->sort(__( 'Username', true), 'username'); ?></th>
                <th><?php echo $paginator->sort(__( 'Display name', true), 'name'); ?></th>
                <th><?php echo $paginator->sort(__( 'Email', true), 'email'); ?></th>
                <th><?php echo $paginator->sort(__( 'Created on', true), 'created'); ?></th>
	    <th><?php echo $paginator->sort(__( 'Modified on', true), 'modified'); ?></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 0; foreach($users as $user) : ?>
            <tr<?php echo is_int($i / 2) ? ' class="alt"' : ''; ?>>
                <td><?php echo $html->link($user['User']['username'], array('action' => 'edit', 'admin' => true, $user['User']['id'])); ?></td>
                <td><?php echo $user['User']['name']; ?></td>
                <td><?php echo $user['User']['email']; ?></td>
                <td><?php echo $time->niceShort($user['User']['created']); ?></td>
	    <td><?php echo $time->niceShort($user['User']['modified']); ?></td>
                <td><?php if($user['User']['id'] != 1) { echo $html->link(__( 'Delete', true), array('action' => 'delete', 'admin' => true, $user['User']['id'])); } ?></td>
            </tr>
            <?php $i++; endforeach; ?>
        </tbody>
    </table>
</div>

<?php echo $this->renderElement('admin_pagination'); ?>