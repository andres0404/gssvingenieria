<?php


include_once 'class.DAO.php'; 

class DAO_Secciones extends DAOGeneral{
    
    
    
    protected $_id_seccion;
    protected $_nom_seccion;
    protected $_subtitulo;
    protected $_estado;
    protected $_orden;
    protected $_img_path;
    protected $_icono;
    

    protected $_tabla = 'secciones';
    protected $_mapa = array(
        'id_seccion' => array('tipodato' => 'integer','label' => 'ID'),
        'nom_seccion' => array('tipodato' => 'varchar','label' => 'NOMBRE SECCIÓN'),
        'subtitulo' => array('tipodato' => 'varchar','label' => 'SUBTITULO'),
        'orden' => array('tipodato' => 'integer','label' => 'ORDEN'),
        'img_path' => array('tipodato' => 'varchar','label' => 'CARPETA IMAGENES', 'ayuda' => 'Carpeta donde se guardaran las imagenes. Ej.: <em>img/imagenes</em> (o use <b><em>:n</em></b>, donde <em><b>n</em></b> es el numero de la tabla maestra cuyos datos llenaran el listado)'),
        'icono' => array('tipodato' => 'varchar','label' => 'ICONO', 'ayuda' => 'Icono de la secci&oacute;n', 'opciones' => array('fa-puzzle-piece'=>'fa-puzzle-piece','fa-clipboard'=>'fa-clipboard','fa-trophy'=>'fa-trophy','fa-graduation-cap'=>'fa-graduation-cap','fa-phone'=>'fa-phone','fa-comment-o'=>'fa-comment-o') ) ,
        'estado' => array('tipodato' => 'boolean','label' => 'ESTADO')
    );
    protected $_primario = 'id_seccion';
    
    public function __construct() {
        
        parent::__construct();
    }
    
    
    protected $_ordenar = array();
    
    function get_id_seccion() {
        return $this->_id_seccion;
    }

    function get_nom_seccion() {
        return $this->_nom_seccion;
    }

    function get_subtitulo() {
        return $this->_subtitulo;
    }

    function get_estado() {
        return $this->_estado;
    }

    function get_orden() {
        return $this->_orden;
    }

    function get_img_path() {
        return $this->_img_path;
    }

    function get_icono() {
        return $this->_icono;
    }

    function set_id_seccion($_id_seccion) {
        $this->_id_seccion = $_id_seccion;
        return $this;
    }

    function set_nom_seccion($_nom_seccion) {
        $this->_nom_seccion = $_nom_seccion;
        return $this;
    }

    function set_subtitulo($_subtitulo) {
        $this->_subtitulo = $_subtitulo;
        return $this;
    }

    function set_estado($_estado) {
        $this->_estado = $_estado;
        return $this;
    }

    function set_orden($_orden) {
        $this->_orden = $_orden;
        return $this;
    }

    function set_img_path($_img_path) {
        $this->_img_path = $_img_path;
        return $this;
    }

    function set_icono($_icono) {
        $this->_icono = $_icono;
        return $this;
    }


}
