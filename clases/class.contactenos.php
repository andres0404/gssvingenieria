<?php

include_once __DIR__.'/DAO/DAO_Contactenos.php';

/**
 * Clase para crear elementos en la interfaz para interactuar con los mensajes de contacto
 */
class Contactenos{
    
  
    private $_color = array('gold', '#80FF00','#58D3F7','#FE2EF7','#D8D8D8');
    private $_indiceColor = 0;
    private $_arrObjContacto = array();


    public function __construct() {
        ;
    }
    public function consultarContactenosNoVistos(){
        $_objContacto = new DAO_Contactenos();
        $_objContacto->set_visto("0");
        $_objContacto->setCustomWhere("fecha_envio > date_sub(curdate(), interval 1 month)");
        $this->_arrObjContacto = $_objContacto->consultar();
        $id = $_objContacto->get_id_contact();
        if(!is_array($this->_arrObjContacto) && !empty($id)){
            $this->_arrObjContacto = array($_objContacto);
        }else if(!is_array($this->_arrObjContacto)){
            $this->_arrObjContacto = array();
        }
        //print_r($this->_arrObjContacto);
    }
    /**
     * Obtener javascript del elemento
     * @return string
     */
    public function getScriptContactenosNoVistos(){
        $idMensaje = array();
        //print_r($this->_arrObjContacto);
        if(is_array($this->_arrObjContacto) && count($this->_arrObjContacto) > 0){
            foreach($this->_arrObjContacto as $obj){
                $idMensaje[] = $obj->get_id_contact();
            }
        }
        $html = '<script>
            var VISTO = 0;
                function marcarVistos(){
                    if(VISTO == 1) return false;
                    $.ajax({
                method: "POST",
                url: "/clases/class.procesarFormulario.php",
                data: { contacVisto: "1", mensajes: ['.  implode(",", $idMensaje).'] }
              })
                .done(function( objP ) {
                  //alert( "Data Saved: " + msg );
                  //var objP = $.parseJSON( msg );
                  VISTO = 1;
                  $("#contacto_badge").css("display","none");
                });
                        }
                    </script>';
        return $html;
    }
    /**
     * Numero de mensajes contactenos no visto
     * @return string
     */
    public function getBadge(){
        
        $num = count($this->_arrObjContacto);
        return $num > 0 ? ('<span id="contacto_badge" class="badge" style="background-color: RED;">'.$num.'</span>') : '';
    }
    
    /**
     * Mensajes contactenos no vistos en el menu del principio
     */ 
    public function obtenerContactenosNoVistos(){
        $R = array();
        if(is_array($this->_arrObjContacto) && count($this->_arrObjContacto) > 0){
            
            foreach ($this->_arrObjContacto as $key => $obj){
                $R[] = $this->getHtmlMensajeContactenos($obj);
                if($this->_indiceColor >= count($this->_color)-1 ) {
                    $this->_indiceColor = 0;
                }
                $this->_indiceColor += 1;
            }
        }
        return implode("\n", $R);
    }
    /**
     * Obtener mensajes de contactenos
     */
    public function obtenerContactenos(){
        $R = array();
        $_objContac = new DAO_Contactenos();
        $_obj = $_objContac->consultar();
        $id = $_objContac->get_id_contact();
        if(empty($_obj) && !empty($id)){
            $_obj = array($_objContac);
        }else if(empty($_obj) ){
            return false;
        }
        $html = '';
        for($i = 0; $i < count($_obj);  $i++){
            $tel = $_obj[$i]->get_telefono();
            $htmlTel = !empty($tel) ? ("<div class=\"small text-muted\"><b>Tel.: </b><a href=\"tel:$tel\">$tel</a></div>") : '';
            $mail = $_obj[$i]->get_email();
            $htmlMail = !empty($tel) ? ("<div class=\"small text-muted\"><b>Correo.: </b><a href=\"mailto:$mail\"> $mail</a> </div>") : '';
            $hora = substr($_obj[$i]->get_hora_envio(), 0,5);
            //$html .= '<div class="page-header"></div>'; // 
            $html .= '<div class="well"><h3>'.$_obj[$i]->get_nombre().'</h3>';
            $html .= '<i class="fa fa-clock-o"></i> '.$_obj[$i]->get_fecha_env().' a las '.$hora;
            $html .= $htmlTel.$htmlMail;
            $html .= '<div>'.$_obj[$i]->get_mensaje().'</div>';
            $html .= '</div>';
        }
        return $html;
    }
    
    /**
     * 
     * @param DAO_Contactenos $_obj
     * @return string
     */
    private function getHtmlMensajeContactenos(DAO_Contactenos $_obj){
        $inicial = substr($_obj->get_nombre(), 0,1);
        $tel = $_obj->get_telefono();
        $htmlTel = !empty($tel) ? ("<div class=\"small text-muted\"><b>Tel.: </b>$tel</div>") : '';
        $mail = $_obj->get_email();
        $htmlMail = !empty($tel) ? ("<div class=\"small text-muted\"><b>Correo.: </b> $mail </div>") : '';
        $hora = substr($_obj->get_hora_envio(), 0,5);
        $html = '<li class="message-preview">
                            <a href="'.$_SERVER['PHP_SELF'].'?idsec=-3">
                                <div class="media">
                                    <span class="pull-left">
                                        <div style="background-color: '.$this->_color[$this->_indiceColor].';font-size: 2em; padding:0.3em 0.6em 0.3em 0.6em; border-radius: 1em">'.$inicial.'</div>
                                        <!-- <img class="media-object" src="http://placehold.it/50x50" alt="">-->
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>'.$_obj->get_nombre().'</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> '.$_obj->get_fecha_env().' a las '.$hora.'</p>
                                        '.$htmlTel.$htmlMail.'
                                        <p>'.$_obj->get_mensaje().'</p>
                                    </div>
                                </div>
                            </a>
                        </li>';
        return $html;
    }
    
    
}
