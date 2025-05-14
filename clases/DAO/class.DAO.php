<?php

//include_once SERVIDOR.'/clases/class.conexion.php';
// include_once '/agencia/ruta.php';cd da   
include_once __DIR__ . '/../class.conexion.php';

class DAOGeneral {
    
    /**
     * si la consulta arroja un resultado devuelve resultado, true: en array (como si hubiera mas de un resultado), false[default]: misma clase que consulta
     * @var type 
     */
    private $_1resultadoEnArray = false;
    /**
     * Limit de la consulta (int 1, int 2)
     * @var array
     */
    private $_limit = false; 
    protected $_custom_where = '';

    public function __construct() {
       
    }
    /**
     * Establecer limiites para la consulta
     * @param type $val1
     * @param type $val2
     */
    public function setLimit($val1, $val2 = null){
        $this->_limit[0] = $val1;
        if(!empty($val2)){
            $this->_limit[1] = $val2;
        }
    }
    public function setCustomWhere($custom_where){
        $this->_custom_where = $custom_where;
    }
    
    /**
     * 
     */
    public function habilita1ResultadoEnArray(){
        $this->_1resultadoEnArray = true;
    }
    /**
     * 
     */
    public function deshabilita1ResultadoEnArray(){
        $this->_1resultadoEnArray = false;
    }
    
    
    /**
     * Obtner el mapa de las clases DAO
     * @return array
     */
    public function getMapa(){
        return $this->_mapa;
    }
    /**
     * Nombre de la tabla en base de datos
     * @return string
     */
    public function getTabla(){
        return $this->_tabla;
    }
    /**
     * Obtener primario
     * @return string
     */
    public function getPrimario(){
        return $this->_primario;
    }

    /**
     * 
     * @return boolean
     */
    public function guardar(){
        $con = ConexionSQL::getInstance();
        $set = array();
        //for ($i = 0; $i < count($this->_mapa); $i++) {
        foreach($this->_mapa as $nom_campo => $arrAtributos){    
            if ($this->{'_' . $nom_campo} !== null AND $nom_campo != $this->_primario && !isset($arrAtributos['sql'])) {
                switch($arrAtributos['tipodato']){
                    case 'lista-multiple-imagen':
                        $set[] = $nom_campo . " = json_array('" . implode("','",$this->{'_' . $nom_campo} ) . "')";
                        break;
                    default:
                        $set[] = $nom_campo . " = '" . addslashes($this->{'_' . $nom_campo} ). "'";
                }
            }
        }
        $where = "";
        if(!empty($this->{'_'.$this->_primario})){
            $where = " WHERE $this->_primario = ". $this->{'_'.$this->_primario} ;
            $query = "update ".$this->_tabla." set ".implode(",", $set) . $where;
        }else{
            $query = "insert into ".$this->_tabla." set ".  implode(",", $set) ;
        }
        $query;
        if($id = $con->consultar($query)){
            if(empty($this->{'_'.$this->_primario})){
                $this->{'_'.$this->_primario} = mysql_insert_id();
            }
            return true;
        }
        return false;
    }
    /**
     * 
     * @return boolean|\clases_llamada
     */
    public function consultar() {
        $where = array();
        $select = array();
        //for ($i = 0; $i < count($this->_mapa); $i++) {
        foreach($this->_mapa as $nom_campo => $arrAtributos){
            if ($this->{'_' . $nom_campo} !== null) {
                $where[] = $nom_campo . " = '" . $this->{'_' . $nom_campo} . "'";
            }
            if(isset($arrAtributos['sql']) && !empty($arrAtributos['sql'])){
                $select[] = $arrAtributos['sql'] . " as " . $nom_campo;
            }else{
                $select[] = $nom_campo;
            }
        }
        if($this->_custom_where != ''){
            $where[] = $this->_custom_where;
        }
        if (count($where) == 0) {
            $query = "select ".implode(",",$select)." from " . $this->_tabla . " where 1 ";
        } else {
            $query = "select ".implode(",",$select)." from " . $this->_tabla . " where " . implode(" AND ", $where)." ";
        }
        // orden 
        if(isset($this->_ordenar) && is_array($this->_ordenar) && count($this->_ordenar) > 0){
            $query .= ( " ORDER BY ".implode(",",  $this->_ordenar));
        }
        // limites
        if(!empty($this->_limit)){
            $query .= (" LIMIT " . implode(",", $this->_limit));
        }
        $con = ConexionSQL::getInstance();
        $id = $con->consultar($query);
        
        if($res = $con->obenerFila($id)){
            $R = [];
            $this->_fillRow($this, $res);
            do{
                $clases_llamada = get_called_class();
                $obj = new $clases_llamada()  ;
                //foreach($this->_mapa as $nom_campo => $arrAtributos){
                //    $obj->{'set_'.$nom_campo}($res[$nom_campo]);
                //}
                $R[] = $this->_fillRow($obj, $res);
            } while($res = $con->obenerFila($id));
            return $R;
            
        }
        return false;
    }
    private function _fillRow($obj, $res){
        foreach($this->_mapa as $nom_campo => $arrAtributos){
            switch($arrAtributos['tipodato']){
                case 'lista-multiple-imagen':
                    $obj->{'set_'.$nom_campo}(json_decode($res[$nom_campo]));
                    break;
                default:
                    $obj->{'set_'.$nom_campo}($res[$nom_campo]);
            }
        }
        return $obj;
    }
    
    public function get_obj_seccion(){
       return NULL; 
    }

}
