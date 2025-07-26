<?php

include_once __DIR__ . '/DAO/class.DAO.php'; 

class Paginador {

    private $_paginadoVars = [
        'page' => 0,
        'per_page' => 30,
        'total_registros' => 0,
        'total_paginas' => 0
    ];

    public function __construct( ){}

    public function preparar(DAOGeneral $_objDao){
        $this->_paginadoVars = $_objDao->getPaginadoVars();
        $this->_calcular_paginas();
    }
    public function preparar_manual($page, $per_page, $total_registros) {
        $this->_paginadoVars['page'] = $page;
        $this->_paginadoVars['per_page'] = $per_page;
        $this->_paginadoVars['total_registros'] = $total_registros;
        $this->_calcular_paginas();
    }
    private function _calcular_paginas(){
        $this->_paginadoVars['total_paginas'] = ceil($this->_paginadoVars['total_registros'] / $this->_paginadoVars['per_page']);
    }

    public function getHtml() {
        if($this->_paginadoVars['total_paginas'] <= 1){
            return '';
        }
//        print_r($_GET);
        $get_original = $this->originalUrlGet();
        $html = '<div class="text-center"><nav aria-label="Page navigation">
  <ul class="pagination">';
    if($this->_paginadoVars['page'] == 1) {
        $html .= '<li class="disabled"><a href="javascript:void(0)" aria-label="Previous">';
    } else {
        $html .= '<li>';
        $html .= '<a href="'. ($_SERVER['PHP_SELF']).'?'.$get_original.'&page='.($this->_paginadoVars['page']-1).'&per_page='.$this->_paginadoVars['per_page'].'" aria-label="Previous">';
    }
    $html .= '<span aria-hidden="true">&laquo;</span>
      </a>
    </li>';

    for($i = 1; $i <= $this->_paginadoVars['total_paginas']; $i++){
        if($i == $this->_paginadoVars['page']) {
            $html .= ('<li class="active"><a href="javascript:void(0)">' . $i .'</a></li>');
        } else {
            $html .= ('<li ><a href="'. $_SERVER['PHP_SELF'].'?'.$get_original.'&page='.$i.'&per_page='.$this->_paginadoVars['per_page'].'" >' . $i .'</a></li>');
        }
    }
    if($this->_paginadoVars['page'] == $this->_paginadoVars['total_paginas']) {
        $html .= '<li class="disabled"><a href="javascript:void(0)" aria-label="Next">';
    } else {
        $html .= '<li>
        <a href="'. $_SERVER['PHP_SELF'].'?'.$get_original.'&page='.($this->_paginadoVars['page']+1).'&per_page='.$this->_paginadoVars['per_page'].'" aria-label="Next">';
    }
    $html .= '<span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav></div>';
    return $html;
    }
    /**
     * Ensambla las variables get entregadas
     */
    private function originalUrlGet(){
        $original_get = "";
        if(count($_GET) > 0){
            foreach($_GET as $get => $value) {
                if ($get != "page" && $get != "per_page") {
                    $original_get .= "$get=$value&";
                }
            }
            return substr($original_get, 0,-1);
        }
        return "";
    }
}