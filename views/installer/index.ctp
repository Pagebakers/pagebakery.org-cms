<div class="pb-inline-panel" id="installer">
    <h3><span><?php __('Pagebakery.org installation - Step 1' );?></span></h3>
    <h3 class="pb-panel-header"><span><?php __('Requirements');?></span></h3>
    <div class="pb-panel-body">
        <p><?php __('This is the installation module which will ask you a few questions in order to help you set up your brand new CMS.' );?></p>
        <p><?php __('First, we need to check whether everything with your folder structure is OK');?></p>
        <hr>
        <p>
        <?php
        if( $tmpFolderPermissions )
            echo '<strong class="ok">' . sprintf( __('OK, "%s" is writable', true ), TMP ) . '</strong>';
        else
            // recursive permissions are needed in some cases
            echo '<strong class="error">' . sprintf( __('Your tmp folder is not writable - please give (recursive) write permissions ( 0777 ) to "%s".', true), TMP ) . '</strong>';
        ?>
        </p>
        <p>
        <?php
        if( $databaseFilePermissions )
            echo '<strong class="ok">' . sprintf( __('OK, "%s" is writable', true ), CONFIGS . 'database.php' ) . '</strong>';
        else
            echo '<strong class="error">' . sprintf( __('Your database file is not writable - please give write permissions ( 0777 ) to "%s".', true), CONFIGS ) . '</strong>';
        ?>
        </p>
        <hr>
        <p>
        <?php
        if( $databaseFilePermissions && $tmpFolderPermissions ) {
            echo __('Everything seems OK, you can now proceed to the final step.', true) . '<br><br>';
            echo $html->link( __('Proceed', true ), array( 'controller' => 'installer', 'action' => 'setup' ) );
        } else {
            __('Please, fix the issues above before proceeding');
        }
        ?>
        </p>
    </div>
</div>