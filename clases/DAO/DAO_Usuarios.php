<?php

include_once 'class.DAO.php'; 


class DAO_Usuarios extends DAOGeneral {
    
    protected $_id_usu;
    protected $_nombre;
    protected $_ident;
    protected $_permiso;
    protected $_estado;
    protected $_correo;
    protected $_clave;

    protected $_tabla = 'usuarios';
    protected $_mapa = array(
        'id_usu' => array('tipodato' => 'integer'),
        'nombre' => array('tipodato' => 'varchar'),
        'ident' => array('tipodato' => 'varchar'),
        'permiso' => array('tipodato' => 'integer'),
        'correo' => array('tipodato' => 'varchar'),
        'clave' => array('tipodato' => 'varchar', 'tipocampo' => 'password'),
        'estado' => array('tipodato' => 'boolean')
    );
    protected $_primario = 'id_usu';

    public function __construct() {
        parent::__construct();
    }
    protected $_ordenar = array();
    
    
    function get_id_usu() {
        return $this->_id_usu;
    }

    function get_nombre() {
        return $this->_nombre;
    }

    function get_ident() {
        return $this->_ident;
    }

    function get_permiso() {
        return $this->_permiso;
    }

    function get_estado() {
        return $this->_estado;
    }

    function set_id_usu($_id_usu) {
        $this->_id_usu = $_id_usu;
        return $this;
    }

    function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
        return $this;
    }

    function set_ident($_ident) {
        $this->_ident = $_ident;
        return $this;
    }

    function set_permiso($_permiso) {
        $this->_permiso = $_permiso;
        return $this;
    }

    function set_estado($_estado) {
        $this->_estado = $_estado;
        return $this;
    }

    function get_correo() {
        return $this->_correo;
    }

    function get_clave() {
        return $this->_clave;
    }

    function set_correo($_correo) {
        $this->_correo = $_correo;
        return $this;
    }

    function set_clave($_clave) {
        $this->_clave = $_clave;
        return $this;
    }


    
}