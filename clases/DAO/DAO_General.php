<?php
include_once __DIR__ .'/class.DAO.php';


class DAO_General extends DAOGeneral {
    
    protected $_id;
    protected $_tit_pagina;
    protected $_logo;
    protected $_desc_pagina;
    protected $_nom_empresa;
    protected $_lema;
    protected $_img_index;
    protected $_email;
    protected $_telefono;
    protected $_celular;
    protected $_direccion;
    protected $_latitud;
    protected $_longitud;
    protected $_ciudad;
    protected $_url_web;
    protected $_url_facebook;
    protected $_url_twitter;
    protected $_url_linkedin;
    protected $_img_path;


    protected $_tabla = 'general';
    protected $_mapa = array(
        'id' => array('tipodato' => 'integer', 'label' => 'ID'),
        'tit_pagina' => array('tipodato' => 'varchar', 'label' => 'TÍTULO PÁGINA'),
        'logo' => array('tipodato' => 'lista-imagen', 'label' => 'LOGO'),
        'desc_pagina' => array('tipodato' => 'varchar', 'label' => 'DESCRICION DE LA PAGINA', 'ayuda' => 'Descripcion que aparecera cuando la pagina se encuentre en buscadores'),
        'nom_empresa' => array('tipodato' => 'varchar', 'label' => 'NOMBRE EMPRESA'),
        'lema' => array('tipodato' => 'varchar', 'label' => 'LEMA'),
        'img_index' => array('tipodato' => 'varchar', 'label' => 'IMÁGEN PRINCIPAL'),
        'email' => array('tipodato' => 'varchar', 'label' => 'E-MAIL'),
        'telefono' => array('tipodato' => 'varchar', 'label' => 'TELEFONO'),
        'celular' => array('tipodato' => 'varchar', 'label' => 'MÓVIL'),
        'direccion' => array('tipodato' => 'varchar', 'label' => 'DIRECCIÓN'),
        'latitud' => array('tipodato' => 'varchar', 'label' => 'LATITUD'),
        'longitud' => array('tipodato' => 'varchar', 'label' => 'LONGITUD'),
        'ciudad' => array('tipodato' => 'varchar', 'label' => 'CIUDAD'),
        'url_web' => array('tipodato' => 'varchar', 'label' => 'URL WEB'),
        'url_facebook' => array('tipodato' => 'varchar', 'label' => 'URL FACEBOOK'),
        'url_twitter' => array('tipodato' => 'varchar', 'label' => 'URL TWITER'),
        'url_linkedin' => array('tipodato' => 'varchar', 'label' => 'URL LINKED-IN'),
        'img_path' => array('tipodato' => 'varchar', 'label' => 'PATH IMAGENES', /*'sql' => '(SELECT "img/logos")'*/)
    );
    protected $_primario = 'id';
    
    
    
    function get_desc_pagina() {
        return $this->_desc_pagina;
    }

    function set_desc_pagina($_desc_pagina) {
        $this->_desc_pagina = $_desc_pagina;
        return $this;
    }

        
    function get_img_path() {
        return $this->_img_path;
    }

    function set_img_path($_img_path) {
        $this->_img_path = $_img_path;
    }

        function get_url_web() {
        return $this->_url_web;
    }

    function get_url_facebook() {
        return $this->_url_facebook;
    }

    function get_url_twitter() {
        return $this->_url_twitter;
    }

    function get_url_linkedin() {
        return $this->_url_linkedin;
    }

    function set_url_web($_url_web) {
        $this->_url_web = $_url_web;
        return $this;
    }

    function set_url_facebook($_url_facebook) {
        $this->_url_facebook = $_url_facebook;
        return $this;
    }

    function set_url_twitter($_url_twitter) {
        $this->_url_twitter = $_url_twitter;
        return $this;
    }

    function set_url_linkedin($_url_linkedin) {
        $this->_url_linkedin = $_url_linkedin;
        return $this;
    }

    function get_mostrar_idx() {
        return $this->_mostrar_idx;
    }
    
    public function __construct() {
        parent::__construct();
    }
    
    function get_id() {
        return $this->_id;
    }

    function set_id($_id) {
        $this->_id = $_id;
        return $this;
    }

    function get_tit_pagina() {
        return $this->_tit_pagina;
    }

    function get_logo() {
        return $this->_logo;
    }

    function get_nom_empresa() {
        return $this->_nom_empresa;
    }

    function get_lema() {
        return $this->_lema;
    }

    function get_img_index() {
        return $this->_img_index;
    }

    function get_email() {
        return $this->_email;
    }

    function get_telefono() {
        return $this->_telefono;
    }

    function get_celular() {
        return $this->_celular;
    }

    function get_direccion() {
        return $this->_direccion;
    }

    function get_latitud() {
        return $this->_latitud;
    }

    function get_longitud() {
        return $this->_longitud;
    }

    function set_tit_pagina($_tit_pagina) {
        $this->_tit_pagina = $_tit_pagina;
        return $this;
    }

    function set_logo($_logo) {
        $this->_logo = $_logo;
        return $this;
    }

    function set_nom_empresa($_nom_empresa) {
        $this->_nom_empresa = $_nom_empresa;
        return $this;
    }

    function set_lema($_lema) {
        $this->_lema = $_lema;
        return $this;
    }

    function set_img_index($_img_index) {
        $this->_img_index = $_img_index;
        return $this;
    }

    function set_email($_email) {
        $this->_email = $_email;
        return $this;
    }

    function set_telefono($_telefono) {
        $this->_telefono = $_telefono;
        return $this;
    }

    function set_celular($_celular) {
        $this->_celular = $_celular;
        return $this;
    }

    function set_direccion($_direccion) {
        $this->_direccion = $_direccion;
        return $this;
    }

    function set_latitud($_latitud) {
        $this->_latitud = $_latitud;
        return $this;
    }

    function set_longitud($_longitud) {
        $this->_longitud = $_longitud;
        return $this;
    }

    function get_ciudad() {
        return $this->_ciudad;
    }

    function set_ciudad($_ciudad) {
        $this->_ciudad = $_ciudad;
        return $this;
    }



}