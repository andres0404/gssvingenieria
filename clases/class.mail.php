<?php


/**
 * Enviar un correo
 */
class MailYa{
    
    
    public function __construct() {
        
    }
    
    private $_para = 'proyectos@gssvingenieria.com';
    private $_de;
    private $_responderA;
    private $_titulo = '';
    private $_mensaje;
    private $_cabeceras;
    
    
    function get_de() {
        return $this->_de;
    }

    function set_de($_de) {
        $this->_de = $_de;
        return $this;
    }
    function get_responderA() {
        return $this->_responderA;
    }

    function set_responderA($_responderA) {
        $this->_responderA = $_responderA;
        return $this;
    }

    
        
    function get_para() {
        return $this->_para;
    }

    function get_titulo() {
        return $this->_titulo;
    }

    function get_mensaje() {
        return $this->_mensaje;
    }

    function get_cabeceras() {
        return $this->_cabeceras;
    }

    function set_para($_para) {
        $this->_para = $_para;
        return $this;
    }

    function set_titulo($_titulo) {
        $this->_titulo = $_titulo;
        return $this;
    }

    function set_mensaje($_mensaje) {
        $this->_mensaje = $_mensaje;
        return $this;
    }

    function set_cabeceras($_cabeceras) {
        $this->_cabeceras = $_cabeceras;
        return $this;
    }

    public function enviar(){
        $this->_cabeceras = 'From: '.$this->_de . "<$this->_responderA>\r\n" .
    'Reply-To: '.$this->_responderA . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
        mail($this->_para, $this->_titulo, $this->_mensaje, $this->_cabeceras);
    }
            
}