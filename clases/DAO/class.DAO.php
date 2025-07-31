<?php

//include_once SERVIDOR.'/clases/class.conexion.php';
// include_once '/ruta.php';cd da   
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
    private $_limit = null; 
    protected $_custom_where = '';
    private $_es_paginado = false;
    protected $_paginado_vars;
    protected $_joins_result_collection = [];

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
    public function pushJoinsResultCollection($value){
        $this->_joins_result_collection[] = $value;
    }
    /**
     * Obtener array de resultados de un join 
     */
    public function getJoinsResultCollection(){
        return $this->_joins_result_collection;
    }
    /**
     * Establece los parametros para enviar una consulta con limit y order para paginacion
     * Use la funcion antes del metodo consultar pues esta hara un count antes de la consulta sin paginar para establecer el total de registros
     */
    public function setPaginacion(){
        $this->_paginado_vars = [
            'page' => isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : false,
            'per_page' => (isset($_GET['per_page']) && is_numeric($_GET['per_page']) ? $_GET['per_page'] : 30),
            'total_registros' => 0
        ];
        if($this->_paginado_vars['page']){
            $this->setLimit(($this->_paginado_vars['page']-1)*$this->_paginado_vars['per_page'], $this->_paginado_vars['per_page']);
        }
        if(isset($_GET['sort'])){
            $this->_ordenar = [$_GET['sort'] . " " . (isset($_GET['order']) && in_array($_GET['order'],['asc','desc']) ? $_GET['order'] : "asc")];
        }
        $this->_es_paginado = true;
    }
    /**
     * Solo disponible si se habilitpo el paginador con la funcion setPaginacion
     */
    public function getPaginadoVars(){
        return $this->_paginado_vars;
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
     * Obtener nombre llave primaria
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
        if($id = $con->ejecutar($query)){
            if(empty($this->{'_'.$this->_primario})){
                $this->{'_'.$this->_primario} = $con->getInsertId();
            }
            return true;
        }
        return false;
    }
    /**
     * 
     * @return boolean|array
     * @opciones array Agregar opciones para hacer un join
     */
    public function consultar($opciones = []) {
        $where = array();
        $select = array();
        $joins = [];
        //for ($i = 0; $i < count($this->_mapa); $i++) {
        foreach($this->_mapa as $nom_campo => $arrAtributos){
            if ($this->{'_' . $nom_campo} !== null) {
                $where[] = "{$this->_tabla}.$nom_campo  = '" . $this->{'_' . $nom_campo} . "'";
            }
            if(isset($arrAtributos['sql']) && !empty($arrAtributos['sql'])){
                $select[] = "{$arrAtributos['sql']} as {$this->_tabla}_$nom_campo";
            }else{
                $select[] = "{$this->_tabla}.$nom_campo AS {$this->_tabla}_$nom_campo";
            }
        }
        if(isset($opciones['joins'])) {
            foreach($opciones['joins'] as $_joins) {
                $select[] = $_joins['tabla']->getTabla(). ".*";
                $joins[] = $_joins['tipo'] . " JOIN " . $_joins['tabla']->getTabla() . " on {$_joins['on']}";
            }
        }
        if($this->_custom_where != ''){
            $where[] = $this->_custom_where;
        }
        if (count($where) == 0) {
            $query = "select ".implode(",",$select)." from {$this->_tabla} " . implode("", $joins) . " where 1 ";
            $queryTotalRegistros = "select count(*) total from {$this->_tabla} " . implode("", $joins) . " where 1 "; // consulta para paginador
        } else {
            $query = "select ".implode(",",$select)." from {$this->_tabla} ". implode("", $joins) . " where " . implode(" AND ", $where)." ";
            $queryTotalRegistros = "select count(*) total from {$this->_tabla} " . implode("", $joins) . " where " . implode(" AND ", $where); // consulta para paginador
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
        
        if($res = $con->obtenerFila($id)){
            //print_r($res);
            $R = [];
            $id_anterior = -1;
            $this->_fillRow($this, $res);
            do{
                if($id_anterior !== $res[$this->getTabla() ."_" . $this->_primario]){
                    $clases_llamada = get_called_class();
                    $obj = new $clases_llamada()  ;
                    $R[] = $this->_fillRow($obj, $res);
                    $id_anterior = $res[$this->getTabla() ."_" . $this->_primario];
                } 
                if(isset($opciones['joins'])) {
                    foreach($opciones['joins'] as $_joins) {
                        if($res[$_joins['tabla']->getPrimario()] === null) {
                            continue;
                        }
                        $clase_join = get_class($_joins['tabla']);
                        $clase_aux = new $clase_join();
                        $obj->pushJoinsResultCollection($this->_fillRow($clase_aux, $res, false));
                    }
                }
            } while($res = $con->obtenerFila($id));
            if($this->_es_paginado){
                $id = $con->consultar($queryTotalRegistros);
                $res = $con->obtenerFila($id);
                $this->_paginado_vars['total_registros'] = $res['total'];
            }
            return $R;
            
        }
        return false;
    }
    /**
     * 
     */
    private function _fillRow($obj, $res, $usaAs = true){
        foreach($obj->getMapa() as $nom_campo => $arrAtributos){
            switch($arrAtributos['tipodato']){
                case 'lista-multiple-imagen':
                    if($usaAs){
                        $obj->{'set_'.$nom_campo}(json_decode($res[$obj->getTabla()."_$nom_campo"] === null ?? ""));
                    } else {
                        $obj->{'set_'.$nom_campo}(json_decode($res["$nom_campo"] === null ?? ""));
                    }
                    break;
                default:
                if($usaAs){
                    $obj->{'set_'.$nom_campo}($res[$obj->getTabla() . "_" .$nom_campo]);
                } else {
                    $obj->{'set_'.$nom_campo}($res[$nom_campo]);
                }
            }
        }
        return $obj;
    }
    
    public function get_obj_seccion(){
       return NULL; 
    }
    

}
