<?php

//print_r($_POST);
if(isset($_POST['form_clase']) && !empty($_POST['form_clase'])){
    include_once $_SERVER['DOCUMENT_ROOT'].'/agencia/ruta.php';
    include_once SERVIDOR.'/clases/DAO/DAO_Secciones.php';
    include_once SERVIDOR.'/clases/DAO/DAO_elementos.php';
    include_once SERVIDOR.'/clases/DAO/DAO_ComplementoElemento.php';
    include_once SERVIDOR.'/clases/DAO/DAO_General.php';
    // preparar campos de formulario
    $data = array();
    foreach($_POST as $key => $valor){
        if($key != 'form_clase'){
            $campo = end(explode("|", $key));
            $data[$campo] = $valor;
        }
    }
    $_obj = new $_POST['form_clase']();
    $mapa = $_obj->getMapa();
    $actualiza = true;
    foreach($mapa as $nomCampo => $arrAtributos){
        if(isset($data[$nomCampo])){
            $_obj->{'set_' . $nomCampo}($data[$nomCampo]);
        }
        if($nomCampo == $_obj->getPrimario() && empty($data[$nomCampo])){
            $actualiza = false;
        }
    }
    $respuesta = array();
    if($_obj->guardar()){ // guarda o actualiza
        $respuesta = array("ok" => 1, "mensaje" => "Datos almacenados","actualiza" => $actualiza ? 1 : -1);
    }else{
        $respuesta = array("ok" => 0, "mensaje" => "No se pudo almacenar datos");
    }
    header('Content-type: application/json');
    echo json_encode($respuesta);
}
// -- Para mensajes de contacto vistos
if(isset($_POST['contacVisto']) && !empty($_POST['contacVisto']) ){
    include_once SERVIDOR.'/clases/DAO/DAO_Contactenos.php';
    if(count($_POST['mensajes']) > 0){
        for($i = 0 ; $i < count($_POST['mensajes']); $i++){
            $_objCon = new DAO_Contactenos();
            $_objCon->set_id_contact($_POST['mensajes'][$i]);
            $_objCon->set_visto(1);
            $_objCon->guardar();
        }
    }
    
}

