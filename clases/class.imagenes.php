<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Imagenes{


    private $_extPermitidas = array('jpg','png','gif');
    private $_mimeTypes = array('image/gif','image/jpeg','image/pjpeg','image/png');
    private $_maxFile = 500000; // 500 kb
    private $_lisArchivos = array();
    private $_verFolder;
    private $_jsFuncionesImg = array( 'eliminar' => 'eliminarImagen', 'subir' => 'validarSubirImagen');
    private $_operarImagenes = 'operaciones_imagenes.php';
    
    private $_pathImg ;
    
    public function __construct() {
        $this->_pathImg = __DIR__.'/../img/';
    }
    /**
     * Establecer la carpeta que se va a ver
     * @param type $folder
     */
    public function setFolder($folder){
        $this->_verFolder = $folder;
    }
    
    /**
     * 
     * @return string
     */
    public function formularioImagenes(){
        $listaDir = $this->_listarDirectorios(); // formulario
        
        
        $form = '<div class="col-lg-8">';
        
        //$form .= '<div class="col-lg-12">';
        $form .= $this->_panelSubirImagenes();
        //$form .= '</div>';
        
        //$form .= '<div class="col-lg-12">';
        $form .= $this->_panelImagenes();
        //$form .= '</div>';
        
        $form .= '</div>'; // fin col-lg-8
        $form .= '<div class="col-lg-4">';
        $form .= '<div class="panel panel-default">';
        $form .= '<div class="panel-heading">';
        $form .= 'Directorio img';
        $form .= '</div>'; // fin panel-heading
        $form .= '<div class="panel-body"> ';
        $form .= $listaDir;
        $form .= '</div>'; // fin panel-body
        $form .= '</div>'; // fin panel panel-default
        $form .= '</div>'; // fin col-lg-4
        return $form;
    }
    /**
     * 
     * @return string
     */
    private function _panelImagenes(){
        $form = '<div class="panel panel-default">';
        
        $form .= ('<div class="panel-heading">Imagenes <b>'.$this->_verFolder.'</b></div>');
        $form .= '<div class="col-lg-12 "><div class=\'alert alert-danger\' style="display:none" id="cont_error_img" ></div></div>';
        $form .= '<div class="panel-body"> ';
        $form .= implode(" ",$this->_lisArchivos);
        $form .= '</div>'; // fin panel-body
        $form .= '</div>'; // fin panel panel-default
        return $form;
    }
    /**
     * 
     * @return string
     */
    private function _panelSubirImagenes(){
        $form = '<div class="panel panel-default">';
        
        $form .= ('<div class="panel-heading">Subir Imagen en <b>'.$this->_verFolder.'</b></div>');
        $form .= '<div class="panel-body"> ';
        $form .= ('<div class="well">Se podran subir imagenes en los formatos ' . implode(", ",$this->_extPermitidas).'</div>');
        $form .= ('<form method="post" enctype="multipart/form-data" action="'.$this->_operarImagenes.'" id="img_form" name="img_form">');
        $form .= '<div class="col-lg-8">';
        $form .= '<div class="form-group">';
        $form .= '<label>Archivo</label>';
        $form .= ('<input type="hidden" name="img_folder" value="'.$this->_verFolder.'" id="img_folder" />');
        $form .= '<input type="file" name="img_imagen" id="img_imagen">';
        $form .= '</div>'; // fin form-group
        $form .= '</div>'; // fin col-lg-8
        $form .= '<div class="col-lg-4"><br>';
        $form .= '<div class="form-group">';
        $form .= '<button class="btn btn-sm btn-primary" type="button" onclick="'.$this->_jsFuncionesImg['subir'].'()"><i class="fa fa-arrow-up"></i> Subir</button>';
        $form .= '</div>'; // fin form-group
        $form .= '</div>'; // fin col-lg-4
        $form .= '</form>';
        $form .= '</div>'; // fin panel-body
        $form .= '</div>'; // fin panel panel-default
        return $form;
    }
    /**
     * Listar directorios de un directorio
     * @return string
     */
    private function _listarDirectorios(){
        $html = '<ul>';
        if(is_dir($this->_pathImg)){
            if($dir = opendir($this->_pathImg)){
                while(($files = readdir($dir)) !== false){
                    if(is_dir($this->_pathImg.$files) && $files != "." && $files != ".."){
                        $html .= ("<li><a href='".$_SERVER['PHP_SELF']."?idsec=-1&dir=".$files."'>$files</a></li>");
                        if($files == $this->_verFolder && $idfil = opendir($this->_pathImg.$files) ){
                            $count = 1;
                            while( ($fil = readdir($idfil) ) !== false ){
                                if($fil != "." && $fil != ".."){
                                    $this->_lisArchivos[] = '<div id="cont_'.$count.'" style="display:inline-block"><img src="/img/'.$files.'/'.$fil.'" alt="['.$fil.']" style="width:140px;" class="img-thumbnail"><div><i class="fa fa-times" style="cursor:pointer;" title="Eliminar" onclick="'.$this->_jsFuncionesImg['eliminar'].'(\''.$files.'\',\''.$fil.'\','.$count.');" ></i> '.$fil.'</div></div>' ;
                                    $count += 1;
                                }
                            }
                        }
                    }
                }
            }
            closedir($dir);
        }else{
            $html .= "No hay nada en {$this->_pathImg} ";
        }
        $html .= '</ul>';
        return $html;
    }
    /**
     * Obtener lista de archivos de un directorio
     * @return type
     */
    public function getListaArchivos($paraCampoSeleccion = false){
        $fil = array();
        if(is_dir($this->_pathImg.$this->_verFolder)){
            if($dir = opendir($this->_pathImg.$this->_verFolder)){
                while(($files = readdir($dir)) !== false){
                    if(!is_dir($this->_pathImg.$this->_verFolder."/".$files) && $files != "." && $files != ".."){
                        if($paraCampoSeleccion)
                            $fil[$files] = $files;
                        else
                            $fil[] = $files;
                    }
                }
            }
        }
        ksort ($fil);
        return $fil;
    }
    /**
     * Obtener funcion javascript para eliminar una imagen
     * @return string
     */
    public function getJavascriptEliminarImagen(){
        $javas = '<script>';
        $javas .= ('function '.$this->_jsFuncionesImg['eliminar'].'(path, nomImg,div_cont){');
        $javas .= 'if(confirm("Desea eliminar la imagen " + nomImg + "?" )){';
        $javas .= ('$.ajax({
                method: "POST",
                url: "'.$this->_operarImagenes.'",
                data: { borrar_img: "1", path: path, img: nomImg }
              })
                .done(function( objP ) {
                  //alert( "Data Saved: " + msg );
                  //var objP = $.parseJSON( msg );
                  //alert(objP.ok + " * " + objP.mensaje + " * " + objP.div_content);
                  if(objP.ok == 1){
                    //$("#cont_" + div_cont ).html("<div class=\'alert alert-success\'>" + objP.mensaje + "</div>");
                    $("#cont_" + div_cont).toggle(2000);
                  }else {
                    $("#cont_error_img").html(objP.mensaje);
                    $("#cont_error_img").toggle("slow");
                    $("#cont_error_img").delay(6000).toggle("slow");
                  }
                });');
        $javas .= '}';
        $javas .= '}';
        $javas .= '</script>';
        return $javas;
    }
    
    public function getJavascriptSubirImagen(){
        $javas = '<script>';
        $javas .= ('function '.$this->_jsFuncionesImg['subir'].'(){');
        $javas .= 'if($("#img_imagen").val().length < 3){ alert("El campo archivo esta vacio"); return false; }';
        $javas .= 'var archivo = $("#img_imagen").val().split("."); ';
        $J = array();
        for($i = 0; $i < count($this->_extPermitidas) ; $i++){
            $J[] = 'archivo[archivo.length - 1] == "' . $this->_extPermitidas[$i] . '"';
        }
        $javas .= ('if('.  implode(" || ", $J).'){ $("#img_form").submit(); }else{alert("Extension ." + archivo[archivo.length - 1] + " no permitida"); return false;}');
        $javas .= '}'; // fin funcion
        $javas .= '</script>';
        return $javas;
    }
    /**
     * Procesar subida de archivo
     * @return boolean
     * @throws ImagenesException
     */
    public function subirArchivo(){
        $this->_existeError($_FILES['img_imagen']['error']);
        if(!in_array($_FILES['img_imagen']['type'], $this->_mimeTypes)){
            throw new ImagenesException("Tipo de archivo no permitido " . $_FILES['img_imagen']['type']);
        }
        if($_FILES['img_imagen']['size'] > $this->_maxFile){
            throw new ImagenesException("El tamaño del archivo ({$_FILES['img_imagen']['size']}) supera lo permitido: " . $this->_maxFile);
        }
        $archivo = $this->_pathImg.$this->_verFolder."/".basename($_FILES['img_imagen']['name']);
        if(!move_uploaded_file($_FILES['img_imagen']['tmp_name'],$archivo)){
            throw new ImagenesException("Error al subir archivo. " );
        }
        return true;
    }
    
    /**
     * Devolver mensaje de 
     * @param type $codigo
     * @return boolean
     */
    protected function _existeError($codigo) {
        if(empty($codigo)){
            return false;
        }
        switch ($codigo) {
            case UPLOAD_ERR_INI_SIZE: 
                throw new ImagenesException("El archivo subido exede la directiva upload_max_filesize en php.ini");
                break; 
            case UPLOAD_ERR_FORM_SIZE: 
                throw new ImagenesException("El archivo subido exede la directiva MAX_FILE_SIZE especificada en el formulario HTML.");
                break; 
            case UPLOAD_ERR_PARTIAL: 
                throw new ImagenesException("El archivo fue parcialmente subido");
                break; 
            case UPLOAD_ERR_NO_FILE: 
                throw new ImagenesException("El archivo no fue subido");
                break; 
            case UPLOAD_ERR_NO_TMP_DIR: 
                throw new ImagenesException("No se encuentra folder temporal");
                break; 
            case UPLOAD_ERR_CANT_WRITE: 
                throw new ImagenesException("Falla para escribir el archivo en el disco.");
                break; 
            case UPLOAD_ERR_EXTENSION: 
                throw new ImagenesException("Carga detenida por extencion ");
                break; 
            default: 
                throw new ImagenesException("Error de carga desconocido");
                break; 
        }
    } 
    
    /**
     * Imagen debe venir concatenada con la carpeta donde esta contenida en la carpeta img
     * @param type $imagen
     */
    public function borrarImagen($imagen){
        //return true;
        //throw new ImagenesException("No se pudo eliminar archivo $imagen");
        //return false;
        if(unlink($this->_pathImg.$imagen)){
            return true;
        }
        throw new ImagenesException("No se pudo eliminar archivo $imagen");
    }
}
class ImagenesException extends Exception{}