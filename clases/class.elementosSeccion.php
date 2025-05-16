<?php

include_once __DIR__ . '/DAO/DAO_elementos.php';
include_once __DIR__ . '/DAO/DAO_ComplementoSeccion.php';
include_once __DIR__ . '/DAO/DAO_ComplementoElemento.php';
include_once __DIR__ . '/DAO/DAO_Clientes.php';
/*
 * 
 */

class Elementos {
    
    
   
    /**
     *
     * @var Secciones
     */
    private $_seccion;

    public function __construct() {
        ;
    }
    /**
     * 
     * @param Secciones $Seccion
     * @return type
     */
    public function getHtmlElemento(Secciones $Seccion) {
        $this->_seccion = $Seccion;
        $idSeccion = $this->_seccion->get_idSeccion();
        $objDAO = new DAO_Elementos();
        $objDAO->habilita1ResultadoEnArray();
        $objDAO->set_id_seccion($idSeccion);
        $objDAO->set_estado(1);
        $arrObj  = $objDAO->consultar();
        switch ($idSeccion) {
            case 1: // 
                $html = '<script>'
                . 'function abre_cierra_servicio(id){'
                . '     $("#servi_txt_" + id).slideToggle("fast", '
                . '         function(){ '
                . '             if(  $("#servi_txt_" + id).css("display") == "none" ){  '
                . '$("#servi_" + id).removeClass("fa fa-chevron-circle-up fa-stack").addClass("fa fa-chevron-circle-down fa-stack");}else{ $("#servi_" + id).removeClass("fa fa-chevron-circle-down fa-stack").addClass("fa fa-chevron-circle-up fa-stack");}'
                . '     });'
                . '}</script>';
                $html .= $this->_getServicios($arrObj);
                break;
            case 2:// proyectos
                $html = $this->_getPortafolio($arrObj);
                break;
            case 3:
                $html = $this->_getNosotros($arrObj);
                break;
            case 4:
                $html = $this->_getEquipo($arrObj);
                break;
            case 5:
                $html = $this->_getContacto();
                break;
        }
        
        return ($html);
    }
    /**
     * 
     * @return string Description
     */
    private function _getServicios($arrObj){
       
        $arrHtml = array();
        $col_por_fila = 3;
        for($i = 0 ; $i < count($arrObj); $i++){
            $arrHtml[] = '<div class="col-sm-4"><span class="fa-stack fa-4x" style="cursor:pointer;" onclick="abre_cierra_servicio('.$arrObj[$i]->get_id_elemen().')" >
                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                    <i class="fa fa-'.$arrObj[$i]->get_img().' fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="service-heading" onclick="abre_cierra_servicio('.$arrObj[$i]->get_id_elemen().')" style="cursor:pointer;">'.$arrObj[$i]->get_titulo().'<span id="servi_'.$arrObj[$i]->get_id_elemen().'" class="fa fa-chevron-circle-down fa-stack " ></span></h4>
                <div class="text-muted" style="display:none" id="servi_txt_'.$arrObj[$i]->get_id_elemen().'">'.$arrObj[$i]->get_texto().'</div>
            </div>';
            if(($i+1) % $col_por_fila == 0){
                $arrHtml[] = '</div><div class="row text-center">';
            }
        }
        return implode("\n", $arrHtml);
    }
    /**
     * 
     * @param type $arrObj
     */
    private function _getPortafolio($arrObj){
        $arrHtml = array();
        //print_r($arrObj);
        for($i = count($arrObj)-1 ; $i >= 0 ; $i--){
            $complement = $arrObj[$i]->get_complemento();
            $a = '';
            $a_close = '';
            $cruz = '<i class="fa fa-minus fa-3x"></i>';
            if($complement == 1){
                $a = '<a href="#portfolioModal'.($i+1).'" class="portfolio-link" data-toggle="modal">';
                $a_close = '</a>';
                $cruz = '<i class="fa fa-plus fa-3x"></i>';
            }
            $arrHtml[] = '<div class="col-md-3  portfolio-item" style="justify-content: center;display: flex;flex-wrap: wrap;align-content:flex-start;">'.($a).'
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                '.($cruz).' 
                            </div>
                        </div>
                        <div style="display: flex;justify-content: center;flex-wrap: wrap;">
                        <!-- <img class="sobre" style="margin: 6em 0 0 15%;" src="img/linea_roja.gif" width="4" height="47%" />-->
                        <img src="'.$this->_seccion->get_img_path().$arrObj[$i]->get_img().'" class="img-circle img-responsive" style="width:75%" alt="">
                        
                        </div>'.($a_close).'
                    <div class="portfolio-caption">
                        <h4>'.$arrObj[$i]->get_titulo().'</h4>
                        <p class="text-muted">'.$arrObj[$i]->get_texto().'</p>
                    </div>
                </div>';
        }
        $arrHtml[] = $this->_getPortafolioModal($arrObj);
        $container = '<div style="display:flex;flex-wrap:wrap">' . implode("\n", $arrHtml) . '</div>';
        return $container;
    }
    /**
     * 
     * @param type $arrObj
     * @return type
     */
    private function _getPortafolioModal($arrObj){
        $arrHtml = array();
        //print_r($arrObj);
        for($i = 0 ; $i < count($arrObj); $i++){
            $_objComp = new DAO_ComplementoElemento();
            $_objComp->set_id_elemen($arrObj[$i]->get_id_elemen());
            $_objComp->consultar();
            $id = $_objComp->get_id_elemen();
            if(empty($id)){
                continue;
            }
            $func_imagen = function () use ($_objComp){
                $html = '';
                $indicators = '';
                $slides = '';
                $id_carousel = 'carousel-example-generic-' . $_objComp->get_id_comp_e();
                if(is_array($_objComp->get_comp_img())){
                    $img = $_objComp->get_comp_img();
                    $countImg = count($img);
                    if($countImg > 1){
                        for($i = 0; $i < count($img) ; $i++){
                            $indicators .= ('<li style="border-color:black;" data-target="#' .$id_carousel. '" data-slide-to="'.$i.'" ' . ($i == 0 ? 'class="active"' : '') .'></li>');
                            $slides .= '<div class="item ' . ($i == 0 ? 'active' : '') .'" style="height: 100%;">
                            <img src="'.$this->_seccion->get_img_path().$img[$i].'" alt="" class="carousel-img">
                            </div>';
                        }
                        $html .= '<div id="' .$id_carousel. '" class="carousel slide" data-ride="carousel">';
                        $html .= ('<ol class="carousel-indicators">'.$indicators.'</ol>');
                        $html .= '<div class="carousel-inner carouse-inner-custom" role="listbox" >';
                        $html .= $slides;
                        $html .= '</div>';
                        $html .= '<a class="left carousel-control carousel-custom-control"  href="#' .$id_carousel. '" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control carousel-custom-control"  href="#' .$id_carousel. '" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>';
                        $html .= '</div>';
                    } else {
                        $html .= '<img class="img-responsive img-centered" src="'.$this->_seccion->get_img_path().$img[0].'" alt="">';
                    }
                }
                return $html;
            };
            $arrHtml[] = '<div class="portfolio-modal modal fade" id="portfolioModal'.($i+1).'" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>'.$arrObj[$i]->get_titulo().'</h2>
                                <p class="item-intro text-muted">'.$_objComp->get_comp_subtitulo().'</p>
                                '.$func_imagen().$_objComp->get_comp_texto().'
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }
        return implode("\n", $arrHtml);
    }
    
    
    private function _getNosotros($arrObj){
        $arrHtml = array();
        for($i = 0;$i < count($arrObj); $i++){
            $arrHtml[] = '<li class="'.($i % 2 == 0 ? "timeline-inverted" : "").'">
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="'.$this->_seccion->get_img_path().$arrObj[$i]->get_img().'" alt="" >
                                    <!-- <img class="sobre" style="margin: 1.3em 0 0 15%;" src="img/linea_roja.gif" width="4" height="76%" />-->
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <!--<h4>2009-2011</h4>-->
                                    <h4 class="subheading">'.$arrObj[$i]->get_titulo().'</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">'.$arrObj[$i]->get_texto().'</p>
                                </div>
                            </div>
                        </li>';
        }
        return implode("\n", $arrHtml); 
    }
    /**
     * 
     * @param type $arrObj
     * @return type
     */
    private function _getEquipo($arrObj){
        $arrHtml = array();
        for($i = 0; $i < count($arrObj); $i++){
            $objEl = new DAO_ElemenContacto();
            $objEl->set_id_elem($arrObj[$i]->get_id_elemen());
            $objEl->consultar();
            $facebook = '';
            $twitter = '';
            $linkedin = '';
            //print_r($objEl);
            $link = $objEl->get_url_facebook();
            if( !empty($link) ){
                $facebook = '<li><a href="'.$objEl->get_url_facebook().'"><i class="fa fa-facebook"></i></a></li>';
            }
            $link = $objEl->get_url_twitter();
            if( !empty($link) ){
                $twitter = ' <li><a href="'.$objEl->get_url_twitter().'"><i class="fa fa-twitter"></i></a></li> ';
            }
            $link = $objEl->get_url_linkedin();
            if( !empty($link) ){
                $linkedin = '<li><a href="'.$objEl->get_url_linkedin().'"><i class="fa fa-linkedin"></i></a></li>';
            }
            // 
            $arrHtml[] = '<div class="col-sm-4">
                    <div class="team-member">
                        
                        <img src="'.$this->_seccion->get_img_path().$arrObj[$i]->get_img().'" class="img-responsive img-circle" alt="" />
                        <h4>'.$arrObj[$i]->get_titulo().'</h4>
                        <p class="text-muted">'.$arrObj[$i]->get_texto().'</p>
                        <ul class="list-inline social-buttons">
                            
                            '.$twitter.$facebook.$linkedin.' 
                            
                        </ul>
                    </div>
                </div>';
        }
        return implode("\n", $arrHtml); 
    }
    /**
     * 
     * @return type
     */
    public function getImgEmpresas(){
        $arrHtml = array();
        
        $objCliente = new DAO_Clientes();
        $ArrObjCliente = $objCliente->consultar();
        for($i = 0; $i < count($ArrObjCliente); $i++){
            $mostrar = $ArrObjCliente[$i]->get_mostrar_idx();
            if($mostrar == 0){
                continue;
            }
            $arrHtml[] = '<div class="col-md-3 col-sm-6">
                    <a href="'.$ArrObjCliente[$i]->get_url_facebook().'">
                        <img src="img/logos/'.$ArrObjCliente[$i]->get_img().'" class="img-responsive img-centered" alt="'.$ArrObjCliente[$i]->get_raz_social().'">
                    </a>
                </div>';
        }
        return implode("\n", $arrHtml); 
    }
    
    /**
     * 
     * @return type
     * /
    private function _consultarElementos() {
        $query = "SELECT * FROM elementos WHERE id_seccion = $this->_seccion and estado = 1 ORDER BY orden";
        $con = ConexionSQL::getInstance();
        return $con->consultar($query);
    }
    */

}
