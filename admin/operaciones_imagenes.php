<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/agencia/ruta.php';
include_once SERVIDOR.'/clases/class.imagenes.php';

/*print_r($_POST);
print_r($_FILES);
print_r($_GET);*/
if(isset($_POST['borrar_img']) && !empty($_POST['borrar_img'])){
    try{
        $_objImg = new Imagenes();
        $_objImg->borrarImagen($_POST['path']."/".$_POST['img']);
        $R = array("ok" => 1, "mensaje" => "Imagen Borrada {$_POST['path']} {$_POST['img']}");
    } catch (ImagenesException $ex) {
        $R = array("ok" => "0", "mensaje" => $ex->getMessage());
    }
    header('Content-type: application/json');
    echo json_encode($R);
}

if(isset($_FILES['img_imagen']) && isset($_POST['img_folder']) && !empty($_POST['img_folder'])){
    try{
        $_objImg = new Imagenes();
        $_objImg->setFolder($_POST['img_folder']);
        $_objImg->subirArchivo();
        $R = array("ok" => "1", "mensaje" => "<em>{$_FILES['img_imagen']['name']}</em> subido en <em>{$_POST['img_folder']}</em> correctamente.");
    } catch (ImagenesException $ex) {
        $R = array("ok" => "0", "mensaje" => $ex->getMessage());
    }
    header("location: /agencia/admin/index.php?idsec=-1&dir={$_POST['img_folder']}&msg=".base64_encode(json_encode($R)) );
}
