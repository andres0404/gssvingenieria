<?php
include_once __DIR__.'/class.conexion.php';


class MTablas {
    
    private $_idTabla;
    private $_idDato;
    private static $_mTablaData = [];
    
    public function __construct() {}
    
    /**
     * Devuelve un array del tipo array(id_dato => valor)
     * @param type $idTabla
     * @param type $idDato
     * @param type $tipReturn modifica tipo de array devuelto 1: array(id_dato => valor) 2: array(valor => valor) 3: array(id_dato => id_dato)
     * @return Array
     */
    public static function getTablaCheckBox($idTabla, $idDato = null, $tipReturn = 1) {
        if(!self::estaEnCache($idTabla)){
            self::_getTablaFromDB($idTabla, $idDato);
        } 
        if($tipReturn == 1){
            return self::$_mTablaData[$idTabla];
        }
        $checkArray = [];
        foreach(self::$_mTablaData[$idTabla] as $id_valor => $valor){
            if($tipReturn == 2){
                $checkArray[$valor] = $valor;
            }else{
                $checkArray[$id_valor] = $id_valor;
            }
        }
        return $checkArray;
    }

    private static function _getTablaFromDB($idTabla, $idDato = null) {
        $obj = new self();
        $obj->_idTabla = $idTabla;
        $obj->_idDato = $idDato;
        if(!$R = $obj->_consultar()){
            return null;
        }
        foreach ($R as $result){
            self::$_mTablaData[$idTabla][$result['id_valor']] = $result['valor'];
        }
        //print_r(self::$_mTablaData[$idTabla]);
    }
    
    /**
     * Obtiene el valor de un código específico (método optimizado)
     * @param int $idTabla
     * @param int $codigo
     * @return string|null
     */
    public static function getValor($idTabla, $codigo) {
        // Asegura que los datos estén en cache
        if(!self::estaEnCache($idTabla)){
            if(!self::_getTablaFromDB($idTabla)){
                return null;
            }
        }
        // Busca el valor en el cache
        return self::$_mTablaData[$idTabla][$codigo] ?? null;
    }
    
    /**
     * Obtiene el código de un valor específico (método optimizado)
     * @param int $idTabla
     * @param string $valor
     * @return int|null
     */
    public static function getCodigo($idTabla, $valor) {
        // Asegura que los datos estén en cache
        if(!self::estaEnCache($idTabla)){
            if(!self::_getTablaFromDB($idTabla)){
                return null;
            }
        }
        
        // Busca el código en el cache
        foreach(self::$_mTablaData[$idTabla] as $id_valor => $item){
            if($valor == $item){
                return $id_valor;
            }
        }
        return null;
    }
    
    /**
     * Limpia el cache de una tabla específica (útil para actualizaciones)
     * @param int $idTabla
     */
    public static function limpiarCache($idTabla = null) {
        if($idTabla === null){
            self::$_mTablaData = [];
        } else {
            unset(self::$_mTablaData[$idTabla]);
        }
    }
    
    /**
     * Verifica si una tabla está en cache
     * @param int $idTabla
     * @return bool
     */
    public static function estaEnCache($idTabla) {
        return isset(self::$_mTablaData[$idTabla]);
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