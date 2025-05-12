<?php
include_once 'class.conexion.php';
/* 
 * Datos generales de la pagoina
 */

class General{
    
    private $_titulo;
    private $_nom_empresa;
    private $_lema;
    private $_logo;
    private $_fondoIndex;
    private $_email;
    
    public function __construct() {
        $this->_consultarGeneral();
    }
    
    
    function get_titulo() {
        return $this->_titulo;
    }

    function get_lema($parte = 0) {
        return $this->_lema[$parte];
    }

    function get_logo() {
        return $this->_logo;
    }

    function get_fondoIndex() {
        return $this->_fondoIndex;
    }
    function get_email(){
        return $this->_email;
    }
    function get_nomEmpresa(){
        return $this->_nom_empresa;
    }

    private function _consultarGeneral(){
        $query = "SELECT * FROM general";
        $con = ConexionSQL::getInstance();
        $id = $con->consultar($query);
        $res = $con->obenerFila($id);
        $this->_titulo = $res['tit_pagina'];
        $this->_lema = explode("|",$res['lema']);
        $this->_logo = $res['logo'];
        $this->_fondoIndex = $res['img_index'];
        $this->_nom_empresa = $res['nom_empresa'];
        
    }
    
    
    
}
