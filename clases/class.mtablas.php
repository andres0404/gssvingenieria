<?php
include_once __DIR__.'/class.conexion.php';


class MTablas {
    
    private $_idTabla;
    private $_idDato;
    
    public function __construct() {
        ;
    }
    
    /**
     * Devuelve un array del tipo array(id_dato => valor)
     * @param type $idTabla
     * @param type $idDato
     * @param type $tipReturn modifica tipo de array devuelto 1: array(id_dato => valor) 2: array(valor => valor) 3: array(id_dato => id_dato)
     * @return Array
     */
    public static function getTablaCheckBox($idTabla, $idDato = null, $tipReturn = 1) {
        $obj = new self();
        $obj->_idTabla = $idTabla;
        $obj->_idDato = $idDato;
        if(!$R = $obj->_consultar()){
            return array();
        }
        $checkArray = array();
        for($i = 0; $i < count($R) ; $i++){
            if($tipReturn == 1){
                $checkArray[$R[$i]['id_valor']] = $R[$i]['valor'];
            }else if($tipReturn == 2){
                $checkArray[$R[$i]['valor']] = $R[$i]['valor'];
            }else{
                $checkArray[$R[$i]['id_valor']] = $R[$i]['id_valor'];
            }
        }
        return $checkArray;
    }
    /**
     * Cosultar maestro de tablas
     * @return boolean
     */
    private function _consultar(){
        $query = "SELECT  a.nom_tabla,b.* FROM 
mt_general a,
mt_tablas b
WHERE a.id_mgeneral = {$this->_idTabla}
AND a.estado = 1
AND a.id_mgeneral  = b.id_mgeneral 
AND b.estado = 1
ORDER BY id_valor desc";
        $con = ConexionSQL::getInstance();
        $id = $con->consultar($query);
        if($res = $con->obtenerFila($id)){
            $R = array();
            do{
                $aux = array();
                foreach($res as $key => $valor){
                    if(!is_numeric($key)){
                        $aux[$key] = $valor;
                    }
                }
                $R[] = $aux;
            }while($res = $con->obtenerFila($id));
            return $R;
        }
        return false;
    }
}