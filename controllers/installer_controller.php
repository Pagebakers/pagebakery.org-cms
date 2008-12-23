<?php
/* Installer extends Controller not AppController! Don't change that */
class InstallerController extends Controller {

        var $name = 'Installer';
        var $uses = null;

        function beforeFilter() {
            $this->Auth->allow();
        }

        function index(){
            if( !empty( $this->data ) ){
                $data = $this->data;

                $install_files_path = ROOT . DS . APP_DIR . DS .'config' .DS. 'install' . DS;

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
                        $this->cakeError( 'error', array( 'message' => 'There were some errors during the creation of your db tables: <br />'.$error_string ) );
                    }
                    elseif( $dbRes == true ){
                        //add admin to the users table
                        App::import( 'model', array( 'User', 'Site' ) );
                        $User = new User();
                        $User->save( array( 'username' => $data['admin_username'], 'password' => sha1(Configure::read('Security.salt').$data['admin_password']) ) );
                        $Site = new Site();
                        $Site->save( array( 'user_id' => $User->getInsertID(), 'domain' => Configure::read( 'CMS.Site.Domain' ) ) );

                        App::import('vendor', 'fixtures');
                        $oFixtures = new Fixtures();
                        if( $oFixtures->import( $install_files_path. 'fixtures.yml' ) === true ){
                            $this->flash( 'Congratulations, you have successfully installed PageBakery!', '/' );
                        }
                        else{
                             $this->cakeError('error', array( 'message' => 'Sorry, there was an error adding initial data' ) );
                        }
                    }
                }
                else{
                    $this->Session->setFlash( 'I could not connect to the DataBase. Please check the setup details again.' );
                }
            }
            $this->set('DBDrivers', $this->_getDBDrivers());
        }

        function _getDBDrivers(){
            $DBDrivers = array();
            if( function_exists( 'mysql_connect' ) )
                $DBDrivers['mysql'] = 'MySQL';
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

            $oDBConfig = new File( CONFIGS . 'database.php', true );
            if( !$oDBConfig->writable() )
                $this->cakeError('error', array( 'message' => 'Your config folder is not writable - please give write permissions ( 0777 ) to '.ROOT.DS.'config so that I can write your DB configuration file') );

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