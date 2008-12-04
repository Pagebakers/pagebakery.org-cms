<div class="block">
    <h2><span><?php __d('pb', 'View users'); ?></span></h2>
    <div class="inner-block">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th><?php echo $paginator->sort(__d('pb', 'Username', true), 'username'); ?></th>
                    <th><?php echo $paginator->sort(__d('pb', 'Display name', true), 'name'); ?></th>
                    <th><?php echo $paginator->sort(__d('pb', 'Email', true), 'email'); ?></th>
                    <th><?php echo $paginator->sort(__d('pb', 'Created on', true), 'created'); ?></th>
                </tr>
            </thead>
            
            <tbody>
                <?php foreach($users as $user) : ?>
                <tr>
                    <td></td>
                    <td><?php echo $html->link($user['User']['username'], array('action' => 'edit', 'pb' => true, $user['User']['id'])); ?></td>
                    <td><?php echo $user['User']['name']; ?></td>
                    <td><?php echo $user['User']['email']; ?></td>
                    <td><?php echo $time->niceShort($user['User']['created']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>  
        </table>
    </div>
</div>