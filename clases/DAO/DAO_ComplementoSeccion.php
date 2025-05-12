<?php
include_once 'class.DAO.php'; 
class DAO_ComplementoSeccion extends DAOGeneral {
    
    protected $_id_compl_s = null;
    protected $_id_seccion = null;
    protected $_txt_head = null;
    protected $_txt_foot = null;

    protected $_tabla = 'comp_seccion';
    protected $_mapa = array(
        'id_compl_s' => array('tipodato' => 'integer'),
        'id_seccion' => array('tipodato' => 'integer'),
        'txt_head' => array('tipodato' => 'text'),
        'txt_foot' => array('tipodato' => 'text')
    );
    protected $_primario = 'id_compl_s'; 
    
    public function __construct() {
        
        parent::__construct();
    }
    protected $_ordenar = array();
    
    
    function get_id_compl_s() {
        return $this->_id_compl_s;
    }

    function get_id_seccion() {
        return $this->_id_seccion;
    }

    function get_txt_head() {
        return $this->_txt_head;
    }

    function get_txt_foot() {
        return $this->_txt_foot;
    }

    function set_id_compl_s($_id_compl_s) {
        $this->_id_compl_s = $_id_compl_s;
        return $this;
    }

    function set_id_seccion($_id_seccion) {
        $this->_id_seccion = $_id_seccion;
        return $this;
    }

    function set_txt_head($_txt_head) {
        $this->_txt_head = $_txt_head;
        return $this;
    }

    function set_txt_foot($_txt_foot) {
        $this->_txt_foot = $_txt_foot;
        return $this;
    }


    
}