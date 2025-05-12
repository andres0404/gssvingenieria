<?php

//include_once SERVIDOR.'/clases/class.conexion.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/agencia/ruta.php';
include_once SERVIDOR.'/clases/class.conexion.php';

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
                $set[] = $nom_campo . " = '" . addslashes($this->{'_' . $nom_campo} ). "'";
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
        //echo $query;
        $con = ConexionSQL::getInstance();
        $id = $con->consultar($query);
        $nummm = $con->getNumeroFilasConsultadas($id);
        //echo "consultado: $nummm -- ";
        //echo $con->getNumeroFilasConsultadas($id);
        if($res = $con->obenerFila($id)){
            if ($con->getNumeroFilasConsultadas($id) == 1 && !$this->_1resultadoEnArray) {// si viene mas de un resultado debe clonarse la clase y retornar en un arreglo de clases
                //$res = $con->obenerFila($id);
                //for ($i = 0; $i < count($this->_mapa); $i++) {
                foreach($this->_mapa as $nom_campo => $arrAtributos){
                    $this->{'_' . $nom_campo} = $res[$nom_campo];
                }
                return true;
            } else {
                $R = array();
                do{
                    $clases_llamada = get_called_class();
                    $obj = new $clases_llamada()  ;
                    //print_r($this->_mapa);
                    foreach($this->_mapa as $nom_campo => $arrAtributos){
                        //print_r($arrAtributos);
                        //echo "$nom_campo : $res[$nom_campo] ";
                        //$obj->{'_' . $this->_mapa[$i]} = $res[$this->_mapa[$i]];
                        $obj->{'set_'.$nom_campo}($res[$nom_campo]);
                    }
                    //print_r($obj);
                    $R[] = $obj;
                }while($res = $con->obenerFila($id));
                return $R;
            }
        }
        return false;
    }
    
    public function get_obj_seccion(){
       return NULL; 
    }

}
