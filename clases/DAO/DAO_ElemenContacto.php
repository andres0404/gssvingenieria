<?php


class DAO_ElemenContacto extends DAOGeneral {
    
    protected $_id_elem = null;
    protected $_url_facebook = null;
    protected $_url_twitter = null;
    protected $_url_linkedin = null;

    protected $_tabla = 'elem_contacto';
    protected $_mapa = array(
        'id_elem' => array('tipodato' => 'integer'),
        'url_facebook' => array('tipodato' => 'varchar'),
        'url_twitter' => array('tipodato' => 'varchar'),
        'url_linkedin' => array('tipodato' => 'varchar')
    );
    protected $_primario = 'id_elem';
    
    public function __construct() {
        
        parent::__construct();
    }
    protected $_ordenar = array();
    
    
    function get_id_elem() {
        return $this->_id_elem;
    }

    function get_url_facebook() {
        return $this->_url_facebook;
    }

    function get_url_twitter() {
        return $this->_url_twitter;
    }

    function get_url_linkedin() {
        return $this->_url_linkedin;
    }

    function set_id_elem($_id_elem) {
        $this->_id_elem = $_id_elem;
        return $this;
    }

    function set_url_facebook($_url_facebook) {
        $this->_url_facebook = $_url_facebook;
        return $this;
    }

    function set_url_twitter($_url_twitter) {
        $this->_url_twitter = $_url_twitter;
        return $this;
    }

    function set_url_linkedin($_url_linkedin) {
        $this->_url_linkedin = $_url_linkedin;
        return $this;
    }


    
}