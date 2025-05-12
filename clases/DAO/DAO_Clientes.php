<?php



include_once 'class.DAO.php'; 


class DAO_Clientes extends DAOGeneral {
    
    protected $_id_cli;
    protected $_raz_social;
    protected $_nit;
    protected $_img;
    protected $_url_web;
    protected $_url_facebook;
    protected $_mostrar_idx;

    protected $_tabla = 'clientes';
    protected $_mapa = array(
        'id_cli' => array('tipodato' => 'integer'),
        'raz_social' => array('tipodato' => 'varchar'),
        'nit' => array('tipodato' => 'varchar'),
        'img' => array('tipodato' => 'varchar'),
        'url_web' => array('tipodato' => 'varchar'),
        'url_facebook' => array('tipodato' => 'varchar'),
        'mostrar_idx' => array('tipodato' => 'boolean')
    );
    protected $_primario = 'id_cli';
    function get_mostrar_idx() {
        return $this->_mostrar_idx;
    }

    function set_mostrar_idx($_mostrar_idx) {
        $this->_mostrar_idx = $_mostrar_idx;
        return $this;
    }

    public function __construct() {
        
        parent::__construct();
    }
    protected $_ordenar = array();
    
    function get_id_cli() {
        return $this->_id_cli;
    }

    function get_raz_social() {
        return $this->_raz_social;
    }

    function get_nit() {
        return $this->_nit;
    }

    function get_img() {
        return $this->_img;
    }

    function get_url_web() {
        return $this->_url_web;
    }

    function get_url_facebook() {
        return $this->_url_facebook;
    }

    function set_id_cli($_id_cli) {
        $this->_id_cli = $_id_cli;
        return $this;
    }

    function set_raz_social($_raz_social) {
        $this->_raz_social = $_raz_social;
        return $this;
    }

    function set_nit($_nit) {
        $this->_nit = $_nit;
        return $this;
    }

    function set_img($_img) {
        $this->_img = $_img;
        return $this;
    }

    function set_url_web($_url_web) {
        $this->_url_web = $_url_web;
        return $this;
    }

    function set_url_facebook($_url_facebook) {
        $this->_url_facebook = $_url_facebook;
        return $this;
    }


    
    


}
