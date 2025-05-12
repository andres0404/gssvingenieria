<?php
/// Pago electrónico PAGOSONLINE - 724259221 realizado con éxito, con número de autorización 52526313.
include_once 'class.DAO.php'; 

class DAO_ComplementoElemento extends DAOGeneral {
    
    protected $_id_comp_e;
    protected $_id_elemen;
    protected $_comp_subtitulo;
    protected $_comp_img;
    protected $_comp_texto;
    protected $_img_path;

    protected $_tabla = 'comp_elemento';
    protected $_mapa = array(
        'id_comp_e' => array('tipodato' => 'integer', 'label' => 'ID'),
        'id_elemen' => array('tipodato' => 'integer', 'label' => 'ID ELEMENTO'),
        'comp_subtitulo' => array('tipodato' => 'varchar', 'label' => 'SUBTITULOP'),
        'comp_img' => array('tipodato' => 'lista-imagen', 'label' => 'IMAGEN ART&Iacute;CULO'),
        'comp_texto' => array('tipodato' => 'text', 'label' => 'TEXTO'),
        'img_path' => array('tipodato' => 'varchar', 'label' => '', 'sql' => '(select img_path from secciones a, elementos b where comp_elemento.id_elemen = b.id_elemen and b.id_seccion = a.id_seccion limit 1)')
    );
    protected $_primario = 'id_comp_e';
    public function __construct() {
        
        parent::__construct();
    }
    protected $_ordenar = array();
    
    function get_img_path() {
        return $this->_img_path;
    }

    function set_img_path($_img_path) {
        $this->_img_path = $_img_path;
    }

    function get_id_comp_e() {
        return $this->_id_comp_e;
    }

    function get_id_elemen() {
        return $this->_id_elemen;
    }

    function get_comp_subtitulo() {
        return $this->_comp_subtitulo;
    }

    function get_comp_img() {
        return $this->_comp_img;
    }

    function get_comp_texto() {
        return $this->_comp_texto;
    }

    function get_tabla() {
        return $this->_tabla;
    }

    function set_id_comp_e($_id_comp_e) {
        $this->_id_comp_e = $_id_comp_e;
        return $this;
    }

    function set_id_elemen($_id_elemen) {
        $this->_id_elemen = $_id_elemen;
        return $this;
    }

    function set_comp_subtitulo($_comp_subtitulo) {
        $this->_comp_subtitulo = $_comp_subtitulo;
        return $this;
    }

    function set_comp_img($_comp_img) {
        $this->_comp_img = $_comp_img;
        return $this;
    }

    function set_comp_texto($_comp_texto) {
        $this->_comp_texto = $_comp_texto;
        return $this;
    }

    function set_tabla($_tabla) {
        $this->_tabla = $_tabla;
        return $this;
    }


}