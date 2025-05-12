<?php


include_once 'class.DAO.php'; 
        
class DAO_Contactenos extends DAOGeneral {
    
    protected $_id_contact;
    protected $_nombre;
    protected $_email;
    protected $_telefono;
    protected $_mensaje;
    protected $_hora_envio;
    protected $_fecha_envio;
    protected $_fecha_env;
    protected $_eviado;
    protected $_visto;

    protected $_tabla = 'contactenos';
    protected $_mapa = array(
        'id_contact' => array('tipodato' => 'integer'),
        'nombre' => array('tipodato' => 'varchar'),
        'email' => array('tipodato' => 'varchar'),
        'telefono' => array('tipodato' => 'varchar'),
        'mensaje' => array('tipodato' => 'text'),
        'hora_envio' => array('tipodato' => 'time'),
        'fecha_envio' => array('tipodato' => 'date'),
        'eviado' => array('tipodato' => 'boolean'),
        'visto' => array('tipodato' => 'boolean'),
        'fecha_env' => array('tipodato' => 'varchar', 'sql' => '(IF(fecha_envio = DATE_SUB(CURDATE(),INTERVAL 1 DAY), "Ayer", IF(fecha_envio = CURDATE(),"Hoy",fecha_envio)) )')
    );
    protected $_primario = 'id_contact';
    
    public function __construct() {
        
        parent::__construct();
    }
    protected $_ordenar = array(' fecha_envio DESC', ' hora_envio DESC ');
    
    
    function get_fecha_env() {
        return $this->_fecha_env;
    }

    function set_fecha_env($_fecha_env) {
        $this->_fecha_env = $_fecha_env;
        return $this;
    }

        
    function get_visto() {
        return $this->_visto;
    }

    function set_visto($_visto) {
        $this->_visto = $_visto;
        return $this;
    }

        
    function get_id_contact() {
        return $this->_id_contact;
    }

    function get_nombre() {
        return $this->_nombre;
    }

    function get_email() {
        return $this->_email;
    }

    function get_telefono() {
        return $this->_telefono;
    }

    function get_mensaje() {
        return $this->_mensaje;
    }

    function get_hora_envio() {
        return $this->_hora_envio;
    }

    function get_fecha_envio() {
        return $this->_fecha_envio;
    }

    function get_eviado() {
        return $this->_eviado;
    }

    function set_id_contact($_id_contact) {
        $this->_id_contact = $_id_contact;
        return $this;
    }

    function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
        return $this;
    }

    function set_email($_email) {
        $this->_email = $_email;
        return $this;
    }

    function set_telefono($_telefono) {
        $this->_telefono = $_telefono;
        return $this;
    }

    function set_mensaje($_mensaje) {
        $this->_mensaje = $_mensaje;
        return $this;
    }

    function set_hora_envio($_hora_envio) {
        $this->_hora_envio = $_hora_envio;
        return $this;
    }

    function set_fecha_envio($_fecha_envio) {
        $this->_fecha_envio = $_fecha_envio;
        return $this;
    }

    function set_eviado($_eviado) {
        $this->_eviado = $_eviado;
        return $this;
    }


}