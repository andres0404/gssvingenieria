<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/agencia/ruta.php';

class ConexionSQL{
    private static $_conData;
    private static $_obj = null;
    
    private $_link;
    /**
     *
     * @var Conexiones
     */
    private $_conexiones ;
    /**
     * Antes de generar una conexion ejecutar este metodo para establecer a que base de datos se conectara
     * @param Conexiones $_obj
     */
    public static function setConData(Conexiones $_obj){
        self::$_conData = $_obj;
    }
    /**
     * Obtener instancia de conexion (previamente debio ejecutarse el metodo setConData en caso que la conexion haya fallado)
     * @return ConexionSQL
     */
    public static function getInstance(){
        if(self::$_obj === null){
            self::$_obj = new self();
        }
        return self::$_obj;
    }
    
    public function __construct() {
        // generar conexion
        if(!(self::$_conData instanceof Conexiones)){
            self::setConData(Conexiones::getConLocal());
        }
        $this->_conectar();
    }
    /**
     * genera la conexion con la base de datos
     * @throws ConexionSQLException
     */
    private function _conectar(){
        //print_r(self::$_conData);
        if(!$this->_link = mysqli_connect(self::$_conData->getServer(), self::$_conData->getUsername(), self::$_conData->getPassword())){
            throw new ConexionSQLException("No se pudo conectar. ".  mysqli_error($this->_link));
        }
        if(!mysqli_select_db($this->_link,self::$_conData->getDatabase())){
            throw new ConexionSQLException("No se pudo seleccionar base de datos ".  mysqli_error($this->_link));
        }
        mysqli_set_charset($this->_link,'utf8');
    }
    /**
     * 
     * @param type $query
     * @return type
     */
    public function consultar($query){
        $result = mysqli_query($this->_link,$query);
        return $result;
    }
    /**
     * Obtener numero de filas de una consulta
     * @param type $id
     * @return type
     */
    public function getNumeroFilasConsultadas($id){
        return mysqli_num_rows($id);
    }
    /**
     * 
     * @param type $id
     * @return type
     */
    public function obenerFila($id) {
        
        if(!empty($id)){
            return mysqli_fetch_array($id, MYSQL_ASSOC);
        }
        return false;
    }
}
class ConexionSQLException extends Exception{}

class Conexiones{
    
    private $_server;
    private $_username;
    private $_password;
    private $_database;
    
    private static $_conexiones = array(
        'local' => array(
            'server' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'gssv_ingenieria'        
        ),
        'servidor_gratis' => array(
            'server' => 'sql206.260mb.net',
            'username' => 'n260m_17133702',
            'password' => 'batman84',
            'database' => 'n260m_17133702_gssv_ingenieria'        
        ),
        'servidor' => array(
            'server' => 'localhost',
            'username' => 'gssvinge_admin',
            'password' => 'Batman84',
            'database' => 'gssvinge_gssv_ingenieria'        
        ),
        
    );
    public function getServer(){
        return $this->_server;
    }
    public function getUsername(){
        return $this->_username;
    }
    public function getPassword(){
        return $this->_password;
    }
    public function getDatabase(){
        return $this->_database;
    }
    /**
     * 
     * @return Conexiones
     */
    public static function getConLocal(){
         return self::_getConexion('servidor');
    }
    /**
     * 
     * @param type $nomConexion
     * @return \self
     */
    private static function _getConexion($nomConexion){
        $_obj = new self();
        $_obj->_server = self::$_conexiones[$nomConexion]['server'];
        $_obj->_username = self::$_conexiones[$nomConexion]['username'];
        $_obj->_password = self::$_conexiones[$nomConexion]['password'];
        $_obj->_database = self::$_conexiones[$nomConexion]['database'];
        return $_obj;
    }
}

