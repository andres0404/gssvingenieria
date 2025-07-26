<?php

include_once __DIR__ . '/DAO/class.DAO.php'; 

class Paginador {

    public function __construct(private DAOGeneral $_objDao ){}

    public function getHtml() {
        if($this->_objDao->getPaginadoVars()['total_paginas'] <= 1){
            return '';
        }
        $html = '<div class="text-center"><nav aria-label="Page navigation">
  <ul class="pagination">';
    if($this->_objDao->getPaginadoVars()['page'] == 1) {
        $html .= '<li class="disabled"><a href="javascript:void(0)" aria-label="Previous">';
    } else {
        $html .= '<li>';
        $html .= '<a href="'. ($_SERVER['PHP_SELF']).'?idsec='.($_GET['idsec']).'&page='.($this->_objDao->getPaginadoVars()['page']-1).'&per_page=30" aria-label="Previous">';
    }
    $html .= '<span aria-hidden="true">&laquo;</span>
      </a>
    </li>';
    for($i = 1; $i <= $this->_objDao->getPaginadoVars()['total_paginas']; $i++){
        if($i == $this->_objDao->getPaginadoVars()['page']) {
            $html .= ('<li class="active"><a href="javascript:void(0)">' . $i .'</a></li>');
        } else {
            $html .= ('<li ><a href="'. $_SERVER['PHP_SELF'].'?idsec='.$_GET['idsec'].'&page='.$i.'&per_page=30" >' . $i .'</a></li>');
        }
    }
    if($this->_objDao->getPaginadoVars()['page'] == $this->_objDao->getPaginadoVars()['total_paginas']) {
        $html .= '<li class="disabled"><a href="javascript:void(0)" aria-label="Next">';
    } else {
        $html .= '<li>
        <a href="'. $_SERVER['PHP_SELF'].'?idsec='.($_GET['idsec']).'&page='.($this->_objDao->getPaginadoVars()['page']+1).'&per_page=30" aria-label="Next">';
    }
    $html .= '<span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav></div>';
    return $html;
    }
}