<?php


include_once 'class.DAO.php'; 
        
class DAO_CaracteristicasElemento extends DAOGeneral {
    
    protected $_id_carac_e;
    protected $_id_elemen;
    protected $_tipo_estructura;
    protected $_material_estructural;
    protected $_uso_estructura;
    protected $_tipo_estudio;
    protected $_sistema_estructural;
    protected $_estado;

    protected $_tabla = 'caracteristicas_elemento';
    protected $_mapa = [
        'id_carac_e' => ['tipodato' => 'integer', 'label' => 'ID'],
        'id_elemen' => ['tipodato' => 'integer', 'label' => 'ID elemento'],
        'tipo_estructura' => ['tipodato' => 'lista_mt','label' => 'Tipo Estructura', 'maestro_tablas' => 2],
        'material_estructural' => ['tipodato' => 'lista_mt','label' => 'Material Estructural', 'maestro_tablas' => 3],
        'uso_estructura' => ['tipodato' => 'lista_mt','label' => 'Uso Estructural', 'maestro_tablas' => 4],
        'tipo_estudio' => ['tipodato' => 'lista_mt','label' => 'Tipo de Estructura', 'maestro_tablas' =>5 ],
        'sistema_estructural' => ['tipodato' => 'lista_mt','label' => 'Sistema Estructural', 'maestro_tablas' => 6],
        'estado' => ['tipodato' => 'boolean','label' => 'Estado'],
    ];
    protected $_primario = 'id_carac_e';
    
    public function __construct() {
        
        parent::__construct();
    }
    
    function get_id_carac_e() {
        return $this->_id_carac_e;
    }

    function set_id_carac_e($_id_carac_e) {
        $this->_id_carac_e = $_id_carac_e;
        return $this;
    }
    
    function get_id_elemen() {
        return $this->_id_elemen;
    }

    function set_id_elemen($_id_elemen) {
        $this->_id_elemen = $_id_elemen;
        return $this;
    }

        
    function get_tipo_estructura() {
        return $this->_tipo_estructura;
    }

    function set_tipo_estructura($_tipo_estructura) {
        $this->_tipo_estructura = $_tipo_estructura == '' ? null : $_tipo_estructura;
        return $this;
    }

        
    function get_material_estructural() {
        return $this->_material_estructural;
    }

    function set_material_estructural($_material_estructural) {
        $this->_material_estructural = $_material_estructural == '' ? null : $_material_estructural;
        return $this;
    }

        
    function get_uso_estructura() {
        return $this->_uso_estructura;
    }

    function set_uso_estructura($_uso_estructura) {
        $this->_uso_estructura = $_uso_estructura == '' ? null : $_uso_estructura;
        return $this;
    }

        
    function get_tipo_estudio() {
        return $this->_tipo_estudio;
    }

    function set_tipo_estudio($_tipo_estudio) {
        $this->_tipo_estudio = $_tipo_estudio == '' ? null : $_tipo_estudio;
        return $this;
    }

        
    function get_sistema_estructural() {
        return $this->_sistema_estructural;
    }

    function set_sistema_estructural($_sistema_estructural) {
        $this->_sistema_estructural = $_sistema_estructural == '' ? null : $_sistema_estructural;
        return $this;
    }
    function get_estado() {
        return $this->_estado;
    }
    function set_estado($_estado) {
        $this->_estado = $_estado;
        return $this;
    }


} 