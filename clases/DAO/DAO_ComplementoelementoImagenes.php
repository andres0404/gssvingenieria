<?php


include_once 'class.DAO.php'; 
        
class DAO_ComplementoElementoImagenes extends DAOGeneral {

    protected $_id_comp_elem_img;
    protected $_id_comp_e;
    protected $_img;

    protected $_tabla = 'comp_elem_imgs';
    protected $_mapa = array(
        'id_comp_elem_img' => array('tipodato' => 'integer','label' => ''),
        'id_comp_e' => array('tipodato' => 'integer','label' => ''),
        'img' => array('tipodato' => 'text','label' => '')
    );
    protected $_primario = 'id_comp_elem_img'; 
    
    public function __construct() {
        
        parent::__construct();
    }
    protected $_ordenar = array();

    public function get_id_comp_elem_img(){return $this->_id_comp_elem_img;}
    public function get_id_comp_e(){return $this->_id_comp_e;}
    public function get_img(){return $this->_img;}

    public function set_id_comp_elem_img($value){$this->_id_comp_elem_img = $value;}
    public function set_id_comp_e($value){$this->_id_comp_e = $value;}
    public function set_img($value){$this->_img = $value;}
}