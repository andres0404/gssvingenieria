<?php

include_once 'class.DAO.php'; 
include_once 'DAO_ElemenContacto.php';
include_once 'DAO_ComplementoElemento.php';
class DAO_Elementos extends DAOGeneral {

    protected $_id_elemen = null;
    protected $_id_seccion = null;
    protected $_img = null;
    protected $_titulo = null;
    protected $_texto = null;
    protected $_estado = null;
    protected $_orden = null;
    protected $_complemento = null;
    /**
     *
     * @var DAO_Secciones
     */
    protected $_objSeccion = null;

    protected $_tabla = 'elementos';
    protected $_mapa = array(
        'id_elemen' => array('tipodato' => 'integer','label' => 'ID E.'),
        'id_seccion' => array('tipodato' => 'integer', 'label' => 'SECCION'),
        'titulo' => array('tipodato' => 'varchar', 'label' => 'TITULO'),
        'texto' => array('tipodato' => 'text', 'label' => 'TEXTO'),
        'img' => array('tipodato' => 'lista-imagen', 'label' => 'IMAGEN'/*,'opciones' => array('fa-puzzle-piece','fa-clipboard','fa-trophy','fa-graduation-cap','fa-phone','fa-comment-o')*/),
        'orden' => array('tipodato' => 'varchar', 'label' => 'ORDEN'),
        'estado' => array('tipodato' => 'boolean', 'label' => 'ESTADO'),
        'complemento' => array('tipodato' => 'boolean', 'label' => 'TIENE COMPLEMENTO')
    );
    protected $_primario = 'id_elemen';
    /**
     *
     * @var DAO_ComplementoElemento
     */
    protected $_objComplemento;
    
    public function __construct() {
        
        parent::__construct();
    }
    protected $_ordenar = array('orden ASC');
    /**
     * Consulta la cosa
     */
    public function consultar() {
        
        $R = parent::consultar();
        if($this->_objSeccion instanceof DAO_Secciones && is_array($R)){
            foreach($R as $key => $objElem){
                $R[$key]->set_obj_seccion($this->_objSeccion);
            }
        }
        $this->_objComplemento = new DAO_ComplementoElemento();
        $this->set_id_elemen($this->_id_elemen);
        $this->_objComplemento->consultar(); 
        return $R;
    }
    
    function get_complemento() {
        return $this->_complemento;
    }

    function set_complemento($_complemento) {
        $this->_complemento = $_complemento;
        return $this;
    }

        /**
     * 
     * @return DAO_ComplementoElemento
     */
    function get_objComplemento(){
        return $this->_objComplemento;
    }
    function get_id_elemen() {
        return $this->_id_elemen;
    }

    function get_id_seccion() {
        return $this->_id_seccion;
    }

    function get_img() {
        return $this->_img;
    }

    function get_titulo() {
        return $this->_titulo;
    }

    function get_texto() {
        return $this->_texto;
    }

    function get_estado() {
        return $this->_estado;
    }

    function get_orden() {
        return $this->_orden;
    }

    function get_tabla() {
        return $this->_tabla;
    }

    function get_mapa() {
        return $this->_mapa;
    }

    function set_id_elemen($_id_elemen) {
        $this->_id_elemen = $_id_elemen;
        return $this;
    }

    function set_id_seccion($_id_seccion) {
        $this->_id_seccion = $_id_seccion;
        return $this;
    }
    function set_obj_seccion(DAO_Secciones $obj){
        $this->_objSeccion = $obj;
        $this->set_id_seccion($this->_objSeccion->get_id_seccion());
    }
    /**
     * 
     * @return DAO_Secciones
     */
    function get_obj_seccion(){
       return $this->_objSeccion; 
    }
    function set_img($_img) {
        $this->_img = $_img;
        return $this;
    }

    function set_titulo($_titulo) {
        $this->_titulo = $_titulo;
        return $this;
    }

    function set_texto($_texto) {
        $this->_texto = $_texto;
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

  



}
