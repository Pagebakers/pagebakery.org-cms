<div class="block step1" id="installer">
    <h3><span><?php __('Hello and Welcome to Pagebakery!' );?></span></h3>
    <div class="inner-block">
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