<?php
/* Installer extends Controller not AppController! Don't change that */
class InstallerController extends Controller {

        var $uses = null;

        var $layout = 'admin_clean';

        function beforeFilter() {
			if(isset($this->Auth)){
	            if($this->Auth) {
    	            $this->Auth->allow();
        	    }
			}
            //if PB is already installed - redirect to homepage
            if( ( file_exists( CONFIGS . 'database.php' ) && count( file( CONFIGS . 'database.php', FILE_SKIP_EMPTY_LINES ) ) > 3 ) ){
                $this->redirect( '/' );
            }
        }

        function index(){
            $this->set( 'tmpFolderPermissions', $this->_checkTmpFolder() );
            $this->set( 'databaseFilePermissions', $this->_checkDatabaseFile() );
        }

        function setup(){
           if( !empty( $this->data ) ){
                $data = $this->data;

                $install_files_path = CONFIGS . 'install' . DS;

                $connection = array();
                foreach( array( 'driver', 'host', 'login', 'password', 'database', 'prefix' ) as $k ){
                    $connection[$k] = $data[$k];
                }
                $this->_writeDBConfig( $connection );
                uses('model' . DS . 'connection_manager');
                $db = ConnectionManager::getInstance();
                $connection = $db->getDataSource('default');
                if( $connection->isConnected() ){
                    App::import('vendor', 'migrations');
                    $oMigrations = new Migrations();
                    $oMigrations->load( $install_files_path. 'schema.yml' );
                    $dbRes = $oMigrations->up();
                    if( is_array( $dbRes ) ){
                        $error_string = '';
                        foreach( $dbRes as $error ){
                            $error_string .= $error['error'].'<br />';
                        }
                        $this->Session->setFlash( __('There were some errors during the creation of your db tables', true ).':<br />'.$error_string );
                    }
                    elseif( $dbRes == true ){
                        //add admin to the users table
                        App::import( 'model', array( 'User', 'Site' ) );
                        $User = new User();
                        $User->save( array(
                                     'username' => $data['admin_username'],
                                     'name' => $data['admin_name'],
                                     'email' => $data['admin_email'],
                                     'password' => sha1(Configure::read('Security.salt').$data['admin_password']),
                                     'group_id' => 1 ) );
                        /*$Site = new Site();
                        $Site->save( array( 'user_id' => $User->getInsertID(), 'domain' => Configure::read( 'CMS.Site.Domain' ) ) );*/

                        App::import('vendor', 'fixtures');
                        $oFixtures = new Fixtures();
                        if( $oFixtures->import( $install_files_path. 'fixtures.yml' ) === true ){
                            $this->flash( 'Congratulations, you have successfully installed Pagebakery!', '/' );
                        }
                        else{
                             $this->Session->setFlash( __('Sorry, there was an error adding initial data', true ) );
                        }
                    }
                }
                else{
                    $this->Session->setFlash( 'I could not connect to the DataBase. Please check the setup details again.' );
                }
            }
            $this->set('DBDrivers', $this->_getDBDrivers());
        }

        function _checkTmpFolder(){
           $oTMPFile = new File( TMP . 'empty', true, 0777 );
           if( !$oTMPFile->writable() )
               return false;
           return true;
        }

        function _checkDatabaseFile(){
            $oDBConfig = new File( CONFIGS . 'database.php', true, 0777 );
            if( !$oDBConfig->writable() ){
                return false;
            }
            return $oDBConfig;
        }

        function _getDBDrivers(){
            $DBDrivers = array();
            if( function_exists( 'mysql_connect' ) )
                $DBDrivers['mysql'] = 'MySQL';
            if( function_exists( 'mysqli_connect' ) )
                $DBDrivers['mysqli'] = 'MySQLi';
            if( function_exists( 'pg_connect' ) )
                $DBDrivers['postgres'] = 'PostgreSQL';
            /*if( class_exists( 'SQLite3' ) )
                $DBDrivers['sqlite3'] = 'SQLite3';*/
            if( function_exists( 'ibase_connect' ) )
                $DBDrivers['firebird'] = 'InterBase/Firebird';

            return $DBDrivers;
        }


        function _writeDBConfig( $connection ){
            if( !isset( $connection['name'] ) )
                $connection['name'] = '$default';

            if( !$oDBConfig = $this->_checkDatabaseFile() )
                return;


            $sData = <<<DATA
<?php
class DATABASE_CONFIG
{
    var $connection[name] =
    array('driver' => '$connection[driver]',
        'host' => '$connection[host]',
        'login' => '$connection[login]',
        'password' => '$connection[password]',
        'database' => '$connection[database]',
        'prefix' => '$connection[prefix]');
}
DATA;
            $oDBConfig->write( $sData );
        }
}
