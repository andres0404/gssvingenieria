<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/clases/DAO/DAO_Contactenos.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/clases/class.mail.php';

class ProcesarContactenos {
    
    public static function run(){
        $_obj = new self();
        $_obj->_procesar();
    }
    /**
     * 
     */
    private function _procesar(){
        try{
            $this->_validar();
            $this->_guardarMensaje();
        }catch(ProcesarContactenosException $e){
            echo json_encode(array("codigo" => 0 , 'mensaje' => '<strong>Alerta!</strong> '.$e->getMessage() ));
            return false;
        }
        echo json_encode(array( 'codigo' => 1, 'mensaje' => "<strong>Gracias!</strong> Tu mensaje ha sido enviado. Nos contactaremos lo antes posible"));
    }
    /**
     * 
     * @throws ProcesarContactenosException
     */
    private function _validar(){
        if(empty($_POST['con_name'])){
            throw new ProcesarContactenosException("Ingresa tu nombre");
        }
        if(empty($_POST['con_email']) ){
            throw new ProcesarContactenosException("Ingresa tu email");
        }
        if(!preg_match('^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$^' , $_POST['con_email'])){
            throw new ProcesarContactenosException("El correo no es valido");
        }
        if(empty($_POST['con_message'])){
            throw new ProcesarContactenosException("Tu mensaje esta vacio");
        }
    }
    /**
     * 
     * @return boolean
     */
    private function _guardarMensaje(){
        $objCon = new DAO_Contactenos();
        $objCon->set_email($_POST['con_email']);
        $objCon->set_fecha_envio(date("Y-m-d"));
        $objCon->set_hora_envio(date("H:i:s"));
        $objCon->set_telefono($_POST['con_phone']);
        $objCon->set_nombre($_POST['con_name']);
        $objCon->set_mensaje($_POST['con_message']);
        if($objCon->guardar()){
            $this->_enviarMail($objCon);
            return true;
        }
        throw new ProcesarContactenosException("No se guardo mensaje");
    }
    /*
     * 
     */
    private function _enviarMail(DAO_Contactenos $objCon){
        $objMail = new MailYa();
        $objMail->set_titulo("Web Contactenos: " . $objCon->get_nombre());
        $objMail->set_responderA($objCon->get_email());
        $objMail->set_de("Web GSSV - ".$objCon->get_nombre());
        $mensaje = "Fecha-Hora: ".$objCon->get_fecha_envio()." ".$objCon->get_hora_envio();
        $mensaje .= ("\nNombre: ".$objCon->get_nombre()."\nMail: ".$objCon->get_email()."\nTelefono: ".$objCon->get_telefono()."\nMensaje:\n\n".$objCon->get_mensaje());
        $objMail->set_mensaje($mensaje);
        $objMail->enviar();
    }
    
}
class ProcesarContactenosException extends Exception{}
ProcesarContactenos::run();
