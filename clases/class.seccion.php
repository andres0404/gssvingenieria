<?php
include_once 'class.conexion.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/agencia/clases/DAO/class.DAO.php';
/* 
 * Clase que arma el menu de acuerdo con la tabla secciones
 */

class Secciones extends DAOGeneral{
    
    private $_tabla = "secciones";


    private $_idSeccion = null;
    private $_nomSeccion = null;
    private $_anclaSeccion = null;
    private $_subtitulo = null;
    private $_orden = null;
    private $_img_path = null;
    private $_icono = null;
            
    function get_idSeccion() {
        return $this->_idSeccion;
    }
    function get_anclaSeccion(){
        return $this->_anclaSeccion;
    }

    function get_nomSeccion() {
        return $this->_nomSeccion;
    }

    function get_subtitulo() {
        return $this->_subtitulo;
    }

    function get_orden() {
        return $this->_orden;
    }

    function set_idSeccion($_idSeccion) {
        $this->_idSeccion = $_idSeccion;
        return $this;
    }

    function set_nomSeccion($_nomSeccion) {
        $this->_nomSeccion = $_nomSeccion;
        return $this;
    }

    function set_subtitulo($_subtitulo) {
        $this->_subtitulo = $_subtitulo;
        return $this;
    }

    function set_orden($_orden) {
        $this->_orden = $_orden;
        return $this;
    }
    function set_anclaSeccion($_orden) {
        $this->_anclaSeccion = $_orden;
        return $this;
    }
    function get_img_path() {
        return $this->_img_path;
    }

    function set_img_path($_img_path) {
        $this->_img_path = $_img_path;
        return $this;
    }

    function get_icono() {
        return $this->_icono;
    }

    function set_icono($_icono) {
        $this->_icono = $_icono;
        return $this;
    }

            
    public function __construct() {
        ;
    }
    /**
     * obtener un array con los elementos del menu
     * @return  array 
     */
    public function getSecciones(){
        return $this->_consultarSecciones();
    }
    /**
     * hace una consulta con los parametros establecidos en la clase
     */
    public function consultar(){
        $query = "select * from secciones WHERE ";
        $where = array();
        if($this->_idSeccion != null){
            $where[] = "id_seccion = '$this->_idSeccion'";
        }
        if($this->_nomSeccion != null){
            $where[] = "nom_seccion = '$this->_nomSeccion' ";
        }
        if($this->_subtitulo !== null){
            $where[] = "subtitulo = '$this->_subtitulo'";
        }
        if($this->_orden != null){
            $where[] = "orden = '$this->_orden' ";
        }
        if($this->_img_path != null){
            $where[] = "img_path = '$this->_img_path'";
        }
        if($this->_icono != null){
            $where[] = "icono = '$this->_icono'";
        }
        $query .= implode(" AND ", $where);
        $con = ConexionSQL::getInstance();
        $id = $con->consultar($query);
        if($res = $con->obenerFila($id)){
            $R = array();
            do{
                $R[] = $this->_establecerSeccion($res);
            }while($res = $con->obenerFila($id));
            return $R;
        }
    }
    
    /**
     * Hace la consulta
     * @return Secciones
     */
    private function _consultarSecciones(){
        $query = "SELECT * FROM secciones WHERE estado = 1 ORDER BY orden";
        $con = ConexionSQL::getInstance();
        $id = $con->consultar($query);
        if($res = $con->obenerFila($id)){
            $R = array();
            do{
                $R[] = $this->_establecerSeccion($res);
            }while($res = $con->obenerFila($id));
            return $R;
        }
        return false;
    }
    /**
     * Establece los datos consultados de la base de datos
     * @param type $res
     * @return \self
     */
    private function _establecerSeccion($res){
        $objSeccion = new self();
        $objSeccion->set_idSeccion($res['id_seccion']);
                $objSeccion->set_nomSeccion($res['nom_seccion']);
                $objSeccion->set_subtitulo($res['subtitulo']);
                $objSeccion->set_orden($res['orden']);
                $objSeccion->set_anclaSeccion(str_replace(" ", "_", $res['nom_seccion']));
                $objSeccion->set_img_path($res['img_path']);
                $objSeccion->set_icono($res['icono']);
                return $objSeccion;
    }
    
}
