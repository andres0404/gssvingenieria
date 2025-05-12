<?php
include_once 'class.conexion.php';
include_once 'class.elementosSeccion.php';

/* 
 * Plantillas
 */

class Plantillas {
    
    /**
     * 
     * @var Secciones 
     */
    private $_objSeccion;
    private $_classGris;
    
    private $_head;
    private $_foot;


    public function __construct() {
        $this->_classGris = false;
    }
    /**
     * 
     * @return string
     */
    private function _getClassGris(){
        $class = '';
        if($this->_classGris === true){
            $class = 'bg-light-gray';
            $this->_classGris = false;
        }else{
            $this->_classGris = true;
        }
        return $class;
    }
    /**
     * 
     * @param Secciones $objSeccion
     * @return type
     */
    public function getHtmlSeccion(Secciones $objSeccion){
        $this->_objSeccion = $objSeccion;
        $this->_getHeadFootSeccion();
        switch ($this->_objSeccion->get_idSeccion()){
            case 1: // servicios
                return $this->_getServicios();
            break;
            case 2:// proyectos
                return $this->_getPortafolio();
            break;
            case 3:
                return $this->_getNosotros();
            break;
            case 4:
                return $this->_getEquipo();
            break;
            case 5:
                return $this->_getContacto();
            break;
        }
    }
    
    private function _getHeadFootSeccion(){
        $_objComp = new DAO_ComplementoSeccion();
        $_objComp->set_id_seccion($this->_objSeccion->get_idSeccion());
        $_objComp->consultar();
        $this->_head = $_objComp->get_txt_head();
        $this->_foot = $_objComp->get_txt_foot();
    }
    /**
     * Plantilla seccion
     */
    private function _getServicios(){
        $objElem = new Elementos();
        $hmtl = '<section id="'.$this->_objSeccion->get_anclaSeccion().'" class="'.$this->_getClassGris().'">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">'.$this->_objSeccion->get_nomSeccion().'</h2>
                    <h3 class="section-subheading text-muted">'.$this->_objSeccion->get_subtitulo().'</h3>
                </div>
            </div>
            <div class="row text-center">
                '.$objElem->getHtmlElemento($this->_objSeccion).'
            </div>
        </div>
    </section>';
        return $hmtl;
    }
    /*
     
    <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Dise&ntilde;o estructural</h4>
                    <p class="text-muted">Planos calculados de las ideas de sus arquitectos.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Documentaci&oacute;n en la nube</h4>
                    <p class="text-muted">Disponga de la documentacion generada por nosotros en la nube.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Gesti&oacute;n d permisos</h4>
                    <p class="text-muted">Gestión de permisos ante el IDU y entregamos su proyecto listo para ser contruido.</p>
                </div>
    */
    /**
     * protafolio
     * @return string
     */
    private function _getPortafolio(){
        $objElem = new Elementos();
        $html = '<!-- Portfolio Grid Section -->
    <section id="'.$this->_objSeccion->get_anclaSeccion().'" class="'.$this->_getClassGris().'">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">'.$this->_objSeccion->get_nomSeccion().'</h2>
                    <h3 class="section-subheading text-muted">'.$this->_objSeccion->get_subtitulo().'</h3>
                </div>
            </div>
            <div class="row">
                '.$objElem->getHtmlElemento($this->_objSeccion).'
            </div>
        </div>
    </section>';
        return $html;
    }
    /**
     * 
     * @return type
     * /
    public function getModalPortafolio(){
        $objElem = new Elementos();
        $objElem->setActivarModal();
        return $objElem->getHtmlElemento(2);
    }
    /**
     * 
     * @return string
     */
    private function _getNosotros(){
        $objElem = new Elementos();
        $html = '<!-- About Section -->
    <section id="'.$this->_objSeccion->get_anclaSeccion().'" class="'.$this->_getClassGris().'">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">'.$this->_objSeccion->get_nomSeccion().'</h2>
                    <h3 class="section-subheading text-muted">'.$this->_objSeccion->get_subtitulo().'</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                         '.$objElem->getHtmlElemento($this->_objSeccion).'
                        
                    </ul>
                </div>
            </div>
        </div>
    </section>';
        return $html;
    }
    /*<!--<li class="timeline-inverted">
                            <div class="timeline-image">
                                <h4>Haremos parte
                                    <br>de su 
                                    <br>Historia!</h4>
                            </div>
                        </li>-->*/
    /**
     * 
     * @return string
     */
    private function _getEquipo(){
        $objElem = new Elementos();
        $html = '<!-- Team Section -->
    <section id="'.$this->_objSeccion->get_anclaSeccion().'" class="'.$this->_getClassGris().'">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">'.$this->_objSeccion->get_nomSeccion().'</h2>
                    <h3 class="section-subheading text-muted">'.$this->_objSeccion->get_subtitulo().'</h3>
                </div>
            </div>
            <div class="row">
                '.$objElem->getHtmlElemento($this->_objSeccion).'
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    '.$this->_foot.'
                </div>
            </div>
        </div>
    </section>';
        /*$html .= '<!-- Clients Aside -->
    <aside class="clients">
        <div class="container">
            <div class="row">
                '.$objElem->getImgEmpresas().'
            </div>
        </div>
    </aside>';*/
        return $html;
    }
    /**
     * 
     * @return string
     */
    private function _getContacto(){
        $objGeneral = new DAO_General();
        $objGeneral->set_id(1);
        $objGeneral->consultar();
        $datos = array(
            'Email' => $objGeneral->get_email(),
            'Teléfono' => $objGeneral->get_telefono(),
            'Celular' => ( '<a href="tel:'.$objGeneral->get_celular().'" >'.$objGeneral->get_celular().'</a>'), 
            'Dirección' => $objGeneral->get_direccion(),
            'Ciudad' => $objGeneral->get_ciudad()
        );
        $strDatos = '';
        foreach($datos as $key => $valor){
            if(empty($valor)){continue;}
            $strDatos .= ( '<div><b>'.$key.':</b> '.$valor.'</div>');
        }
        $html = '<!-- Contact Section -->
    <section id="'.$this->_objSeccion->get_anclaSeccion().'" class="contact">
        <script>
        function enviarFormContactenos(){
            $("#contenedor_alert").fadeOut("slow");
            $.ajax({
            method: "POST",
            url: "clases/class.procesarContactenos.php",
            data: { 
                con_name: $("#con_name").val(),
                con_email: $("#con_email").val(),
                con_phone:$("#con_phone").val(),
                con_message:$("#con_message").val(),
            }
          })
            .done(function( msg ) {
              //alert( msg );
              var obj = $.parseJSON(msg);
              $("#texto_alert").html(obj.mensaje);
              $("#contenedor_alert").fadeIn("slow");
              if(obj.codigo == 1){
                // limpiar campos
                $("#con_name").val("");
                $("#con_email").val("");
                $("#con_phone").val("");
                $("#con_message").val("");
              }
            });
        }
        </script>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">'.$this->_objSeccion->get_nomSeccion().'</h2>
                    <h3 class="section-subheading text-muted">'.$this->_objSeccion->get_subtitulo().'</h3>
                </div>
            </div>
            <div class="row" style="width:70%;margin: 5px auto;">
            <div class="well" style="filter: opacity(80%);">
                '.$strDatos.'
            </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form  name="enviar_contactenos" id="enviar_contactenos" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nombre *" id="con_name" required data-validation-required-message="Ingrese su nombre.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email *" id="con_email" required data-validation-required-message="Ingrese su email.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Un tel&eacute;fono de contacto " id="con_phone" required data-validation-required-message="Ingrese su numero telefonico.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Mensaje*" id="con_message" required data-validation-required-message="Cuentanos por favor."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="button" class="btn btn-xl" onclick="enviarFormContactenos()">Enviar Mensaje</button>
                            </div>
                        </div>
                    </form>
                    <div class="alert alert-warning alert-dismissible" role="alert" id="contenedor_alert" style="filter:opacity(85%); display: none;">
                        
                        <div id="texto_alert"></div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>';
        return $html;
    }
    
    
}
