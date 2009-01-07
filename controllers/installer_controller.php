<?php
/* Installer extends Controller not AppController! Don't change that */
class InstallerController extends Controller {

        var $uses = null;
        
        var $layout = 'admin_clean';

        function beforeFilter() {
            if($this->Auth) {
                $this->Auth->allow();
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
           $oTMPFile = new File( TMP . 'empty', true );
           if( !$oTMPFile->writable() )
               return false;
           return true;
        }

        function _checkDatabaseFile(){
            $oDBConfig = new File( CONFIGS . 'database.php', true );
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
            if( function_exists( 'sqlite_open' ) )
                $DBDrivers['sqlite'] = 'SQLite';
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