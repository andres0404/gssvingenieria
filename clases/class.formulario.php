<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/agencia/ruta.php';
include_once SERVIDOR.'/clases/class.formInputs.php';
include_once SERVIDOR.'/clases/class.imagenes.php';
include_once SERVIDOR.'/clases/class.mtablas.php';

/**
 * Clas para crear rapidamente formularios a partir una clase DAO
 */
class GenerarFormulario {
    
    
    //private $_conLabel = false;
 
    private $_nomProcesarFormulario = 'procesarFormulario';
    /**
     *
     * @var DAOGeneral 
     */
    private $_objDAO;
    private $_objDAOModal;
    
    private $_editarId = false;
    
    
    /*
    public function conLabel(){
        $this->_conLabel = true;
    }
    public function sinLabel(){
        $this->_conLabel = false;
    }


    /**
     * establecer el objeto DAO para deducir de el un formulario
     * @param DAOGeneral $objDAO
     */
    public function setDAO(DAOGeneral $objDAO){
        $this->_objDAO = $objDAO;
    }
    
    public function setDAOModal(DAOGeneral $objDAOModal){
        $this->_objDAOModal = $objDAOModal;
    }
   
    
    
    /**
     * obtener formulario
     */
    public function obtenerFormulario($conModal = false){
        $primario = $this->_objDAO->getPrimario();
        $form = "F".$this->_objDAO->getTabla().$this->_objDAO->{'get_'.$primario}();
        $mapa = $this->_objDAO->getMapa();
        $separador = "|";
        $html = '';
        $idModal = '';
        //$html .= print_r($this->_objDAO,1);
        $html .= $conModal ? $this->_ventanaModalAgregarComplementoElementos($form, $idModal) : "";
        $html .= ( '<form id="'.$form.'" name="'.$form.'" role="form">');
        $html .= FormInput::campoOculto("form_clase", get_class($this->_objDAO) );
        foreach($mapa as $campo => $arrAtributo){
            if($primario == $campo){
                $html .= FormInput::campoTextoApagado($form.$separador.$campo, isset($arrAtributo['label']) ? $arrAtributo['label'] : $campo, $this->_objDAO->{'get_'.$campo}());
                continue;
            }
            if(isset($arrAtributo['opciones'])){
                $html .= FormInput::campoSeleccion($form.$separador.$campo, isset($arrAtributo['label']) ? $arrAtributo['label'] : $campo,  $arrAtributo['opciones'],$this->_objDAO->{'get_'.$campo}());
                continue;
            }
            if(isset($arrAtributo['sql']) && !empty($arrAtributo['sql'])){ // no mostrar los campos traidos con sql
                continue;
            }
            switch ($arrAtributo['tipodato']){
                case 'varchar':
                    //$html .= '<div class="form-group">';
                    //$html .= $this->_conLabel ? ('<label>'.$campo.'</label>') : '';
                    $html .= FormInput::campoTexto($form.$separador.$campo, isset($arrAtributo['label']) ? $arrAtributo['label'] : $campo, $this->_objDAO->{'get_'.$campo}(), true, isset($arrAtributo['ayuda']) ? $arrAtributo['ayuda'] : '') ;
                    //$html .= '</div>';
                    break;
                case 'integer':
                    //$html .= '<div class="form-group">';
                    //$html .= $this->_conLabel ? ('<label>'.$campo.'</label>') : '';
                    $html .= FormInput::campoTexto($form.$separador.$campo, isset($arrAtributo['label']) ? $arrAtributo['label'] : $campo, $this->_objDAO->{'get_'.$campo}(), true, isset($arrAtributo['ayuda']) ? $arrAtributo['ayuda'] : '') ;
                    //$html .= '</div>';
                    break;
                case 'text':
                    //$html .= '<div class="form-group">';
                    //$html .= $this->_conLabel ? ('<label>'.$campo.'</label>') : '';
                    $html .= FormInput::campoAreaTexto($form.$separador.$campo, isset($arrAtributo['label']) ? $arrAtributo['label'] : $campo, $this->_objDAO->{'get_'.$campo}(), true, isset($arrAtributo['ayuda']) ? $arrAtributo['ayuda'] : '');
                    //$html .= '</div>';
                    break;
                case 'boolean':
                    //$html .= '<div class="form-group">';
                    //$html .= $this->_conLabel ? ('<label>'.$campo.'</label>') : '';
                    //$html .= FormInput::campoChequeo($form.$separador.$campo,$form.$separador.$campo,isset($arrAtributo['label']) ? $arrAtributo['label'] : $campo, 1, $this->_objDAO->{'get_'.$campo}() );
                    $html .= FormInput::campoRadioEnLinea($form.$separador.$campo, $form.$separador.$campo, isset($arrAtributo['label']) ? $arrAtributo['label'] : $campo, array('1'=>'On','0'=>'Off'), $this->_objDAO->{'get_'.$campo}());
                    //$html .= '</div>';
                    break;
                case 'date':
                    break;
                case 'time':
                    break;
                case 'lista-imagen':
                    $_objImg = new Imagenes();
                    $objSeccion = $this->_objDAO->get_obj_seccion();
                    if ($objSeccion instanceof DAO_Secciones ){
                        //$html .= print_r($this->_objDAO, 1);
                        // -- verificar si el combo se debe llenar de alguna tabla del maestro de tablas
                        if(substr($objSeccion->get_img_path(), 0, 1) == ":"){
                            $idMTablas = substr($objSeccion->get_img_path(), 1);
                            if(is_numeric($idMTablas)){
                                $html .= $this->_objDAO->{'get_'.$campo}();
                                $html .= FormInput::campoSeleccion($form.$separador.$campo, isset($arrAtributo['label']) ? $arrAtributo['label'] : $campo, MTablas::getTablaCheckBox($idMTablas,NULL,2),$this->_objDAO->{'get_'.$campo}(),isset($arrAtributo['ayuda']) ? $arrAtributo['ayuda'] : '');
                            }
                        }else{
                            // -- usar path
                            $arrPath = explode("/",$objSeccion->get_img_path());
                            if(isset($arrPath[1])){
                                $_objImg->setFolder($arrPath[1]);
                                $listaImg = $_objImg->getListaArchivos(true);
                                //print_r($listaImg);
                                $html .= FormInput::campoSeleccion($form.$separador.$campo, isset($arrAtributo['label']) ? $arrAtributo['label'] : $campo, $listaImg,$this->_objDAO->{'get_'.$campo}(),isset($arrAtributo['ayuda']) ? $arrAtributo['ayuda'] : '');
                            }
                        }
                    }
                    // -- lista imagenes en formulario complemento
                    if(($this->_objDAO instanceof DAO_ComplementoElemento) OR ($this->_objDAO instanceof DAO_General) ){
                        //$html .= print_r($this->_objDAO, 1);
                        $arrPath = explode("/",$this->_objDAO->get_img_path());
                        if(isset($arrPath[1])){
                            $_objImg->setFolder($arrPath[1]);
                            $listaImg = $_objImg->getListaArchivos(true);
                            //print_r($listaImg);
                            $html .= FormInput::campoSeleccion($form.$separador.$campo, isset($arrAtributo['label']) ? $arrAtributo['label'] : $campo, $listaImg,$this->_objDAO->{'get_'.$campo}(),isset($arrAtributo['ayuda']) ? $arrAtributo['ayuda'] : '');
                        }
                    }
                    break;
            }
        }
        $html .= '<div class="form-group">';
        $html .= FormInput::button('Guardar', 2,  'onclick="'.$this->_nomProcesarFormulario.'(\''.$form.'\');" ');
        $html .= $conModal ? FormInput::button('Complemento', 2, 'data-toggle="modal" href="#'.$idModal.'" ') : "";
        $html .= '</div>';
        $html .= '</form>';
        
        //$html .= '</div>';
        return $html;
    }
    /**
     * 
     * @param type $idModal
     * @param type $idMdl Description
     * @return string
     */
    private function _ventanaModalAgregarComplementoElementos($idModal, &$idMdl){
        $idMdl = 'compElemento_' . $idModal;
        $_obj = new self();
        $_obj->setDAO($this->_objDAOModal);
        $html = '<div class="portfolio-modal modal fade" id="'.$idMdl.'" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl"> </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            '.$_obj->obtenerFormulario().'
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        return $html;
    }
    
    public function getJavascriptFormulario(){
        $javas = '<script>';
        $javas .= 'function '.$this->_nomProcesarFormulario.'(nom_form){';
        $javas .= 'var dataString = $("#" + nom_form).serialize();';
        //$javas .= 'alert(dataString);';
        $javas .= '$.ajax({
            type: "POST",
            url: "/agencia/clases/class.procesarFormulario.php",
            data: dataString,
            success: function(data) {
                //alert(data.ok + " " + data.mensaje );
                if(data.ok == "1"){
                    $("#success-generico").html(data.mensaje);
                    $("#modal-success-generico").modal("show");
                    //$("#modal-success-generico").delay(5000).modal("hide");
                    if(data.actualiza == -1){
                        location.reload();
                    }
                }else{
                    $("#danger-generico").html(data.mensaje);
                    $("#danger-generico").toggle("slow");
                    $("#danger-generico").delay(5000).toggle("slow");
                }
            }
        });';
        $javas .= '}';
        $javas .= '</script>';
        return $javas;
    }
    
}