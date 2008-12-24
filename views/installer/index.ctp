<div>
    <h4>
    <?php __('Hello and Welcome to Pagebakery!', true );?>
    <br />
    <?php __('This is the installation module which will ask you a few questions in order to help you set up your brand new CMS.', true );?>
    </h4>
    <?php __('First, we need to check whether everything with your folder structure is OK');?>
    <p>
    <?php
    if( $tmpFolderPermissions )
        printf( __('Good %s is writable', true ), TMP );
    else
        printf( __('Your tmp folder is not writable - please give write permissions ( 0777 ) to %s. Othwerwise, installation will not be possible.', true), TMP );
    ?>
    </p>
    <p>
    <?php
    if( $databaseFilePermissions )
        printf( __('Good %s is writable', true ), CONFIGS . 'database.php' );
    else
        printf( __('Your database file is not writable - please give write permissions ( 0777 ) to %s. Othwerwise, installation will not be possible.', true), CONFIGS );
    ?>
    </p>
    <p>
    <?php
    if( $databaseFilePermissions && $tmpFolderPermissions )
        echo $html->link( __('Proceed', true ), array( 'controller' => 'installer', 'action' => 'setup' ) );
    else
        __('Please, fix those issues before proceeding');
    ?>
    </p>
</div>