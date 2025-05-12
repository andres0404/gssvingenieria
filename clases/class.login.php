<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/agencia/clases/DAO/DAO_Usuarios.php';

class Login{
    
    protected $_pw_concat = "1596*.";
    private $_url = "/agencia/admin/index.php";

    private $_usuario;
    private $_clave;

    public static function run(){
        $_obj = new self();
        $_obj->_establecerDatos();
        $_obj->_verificarDatosUsuario();
    }
    
    private function _establecerDatos(){
        $this->_usuario = $_POST['usuario'];
        $this->_clave = sha1($_POST['clave'].":".$this->_pw_concat);
    }
    /**
     * 
     */
    private function _verificarDatosUsuario(){
        $_objUsu = new DAO_Usuarios();
        $_objUsu->set_correo($this->_usuario);
        $_objUsu->set_clave($this->_clave);
        $_objUsu->set_estado(1);
        $_objUsu->consultar();
        $id = $_objUsu->get_id_usu();
        //print_r($_objUsu);
        if(empty($id)){
            $this->_respuesta(false);
        }else{
            session_start();
            $_SESSION['id_usu'] = $id;
            $this->_respuesta(true);
        }
    }
    /**
     * 
     * @param type $respuesta
     */
    private function _respuesta($respuesta){
        $arrRespu = array();
        if($respuesta){
            $arrRespu = array("ok" => 1, "url" => $this->_url, "mensaje" => "");
        }else{
            session_start();
            session_destroy();
            $arrRespu = array("ok" => "0", "url" => "", "mensaje" => "Error en las credenciales");
        }
        header('Content-type: application/json');
        echo json_encode($arrRespu);
    }
    
    
}

if(isset($_POST['usuario']) && isset($_POST['clave'])){
    Login::run();
}