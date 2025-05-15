<?php
session_start();
if(isset($_GET['logout']) AND $_GET['logout'] == 1){
    session_destroy();
    header("location: /admin/login/index.php");
}
if(!isset($_SESSION['id_usu'])){
    header("location: /admin/login/index.php");
}


include_once __DIR__.'/../clases/DAO/DAO_Usuarios.php';
include_once __DIR__.'/../clases/class.permisos.php';
include_once __DIR__.'/../clases/class.seccion.php';
include_once __DIR__.'/../clases/class.contactenos.php';
include_once __DIR__.'/../clases/DAO/DAO_Secciones.php';
include_once __DIR__.'/../clases/DAO/DAO_elementos.php';
include_once __DIR__.'/../clases/class.formulario.php';

// consultar provisionalmente
$objUsuario = new DAO_Usuarios();
$objUsuario->set_estado(1);
$objUsuario->set_id_usu($_SESSION['id_usu']);
$objUsuario->consultar();

$permiso = $objUsuario->get_permiso();
// comparacion de permisos bitwise (bit a bit)
if(!( $permiso & Permisos::ADMIN) ){
    die("No tiene permisos de administrador");
}
include_once __DIR__.'/../clases/DAO/DAO_General.php';
$objGeneral = new DAO_General();
$objGeneral->set_id(1);
$objGeneral->consultar();
// secciones

$objMenu = new Secciones();
$dataMenu = $objMenu->getSecciones();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/logos/favicon.ico"> 
    <title>Admin - <?php echo $objGeneral->get_nom_empresa(); ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style>
    .portfolio-modal .modal-content {
        background-clip: border-box;
        border: 0 none;
        border-radius: 0;
        box-shadow: none;
        min-height: 100%;
        padding: 100px 0;
        text-align: center;
    }
    .portfolio-modal .modal-content h2 {
        font-size: 3em;
        margin-bottom: 15px;
    }
    .portfolio-modal .modal-content p {
        margin-bottom: 30px;
    }
    .portfolio-modal .modal-content p.item-intro {
        font-family: "Droid Serif","Helvetica Neue",Helvetica,Arial,sans-serif;
        font-size: 16px;
        font-style: italic;
        margin: 20px 0 30px;
    }
    .portfolio-modal .modal-content ul.list-inline {
        margin-bottom: 30px;
        margin-top: 0;
    }
    .portfolio-modal .modal-content img {
        margin-bottom: 30px;
    }
    .portfolio-modal .close-modal {
        background-color: transparent;
        cursor: pointer;
        height: 75px;
        position: absolute;
        right: 25px;
        top: 25px;
        width: 75px;
    }
    .portfolio-modal .close-modal:hover {
        opacity: 0.3;
    }
    .portfolio-modal .close-modal .lr {
        background-color: #222;
        height: 75px;
        margin-left: 35px;
        transform: rotate(45deg);
        width: 1px;
        z-index: 1051;
    }
    .portfolio-modal .close-modal .lr .rl {
        background-color: #222;
        height: 75px;
        transform: rotate(90deg);
        width: 1px;
        z-index: 1052;
    }
    .portfolio-modal .modal-backdrop {
        display: none;
        opacity: 0;
    }
    </style>
    <script>
        function toogleElemento(div){
            $(div).toggle("slow");
        }
    </script>
    <?php 
    $_objImg = new Imagenes();
    echo $_objImg->getJavascriptEliminarImagen();
    echo $_objImg->getJavascriptSubirImagen();
    $_objForm = new GenerarFormulario();
    echo $_objForm->getJavascriptFormulario();
    ?>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Adm <?php echo $objGeneral->get_nom_empresa(); ?></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    
                    <?php
                        $_objContacto = new Contactenos();
                        $_objContacto->consultarContactenosNoVistos();
                        echo $_objContacto->getScriptContactenosNoVistos();
                        //6129
                        ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="marcarVistos();"><?php echo $_objContacto->getBadge(); ?> <i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <?php
                        echo $_objContacto->obtenerContactenosNoVistos();
                        ?>
                        
                        <li class="message-footer">
                            <a href="<?php echo $_SERVER['PHP_SELF']."?idsec=-3"; ?>">Leer todos los mensajes</a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>-->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $objUsuario->get_nombre(); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?logout=1"><i class="fa fa-fw fa-power-off"></i> Salir</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li <?php echo isset($_GET['idsec']) && $_GET['idsec'] == -2 ? 'class="active"' : ''; ?>><a href="index.php?idsec=-2" ><i class="fa fa-fw fa-dashboard"></i> General</a></li>
                    <?php
                    // generacion de menu izquierdo
                    if($dataMenu != FALSE ){
                        for($i = 0; $i < count($dataMenu); $i++){
                            $idSeccion = $dataMenu[$i]->get_idSeccion(); 
                            $class = isset($_GET['idsec'] ) && $idSeccion == $_GET['idsec'] ? 'class="active"' : '';
                            //echo '<li><a class="page-scroll" href="#'.$dataMenu[$i]->get_anclaSeccion().'">'.ucfirst($dataMenu[$i]->get_nomSeccion() ).'</a></li>';
                            echo '<li '.$class.'><a href="index.php?idsec='.$idSeccion.'"><i class="fa fa-fw '.$dataMenu[$i]->get_icono().'"></i> '.ucfirst($dataMenu[$i]->get_nomSeccion() ).'</a></li>';
                        }
                    }
                    $_objSeccion = new DAO_Secciones();
                    if(isset($_GET['idsec'])){
                        $_objSeccion->set_id_seccion($_GET['idsec']);
                        $_objSeccion->consultar();
                        //print_r($_objSeccion);
                    }
                    ?>
                    <li <?php echo isset($_GET['idsec']) && $_GET['idsec'] == -1 ? 'class="active"' : ''; ?>>
                        <a href="index.php?idsec=-1"  ><i class="fa fa-fw fa-file-image-o"></i> Imagenes</a>
                    </li>
                    <li>
                        <!--<a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>-->
                        <a href="/" target="_blank"><i class="fa fa-fw fa-bicycle"></i> Visualizar P&aacute;gina</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
                <!-- Page Heading -->
                <?php
                $titulo = $_objSeccion->get_nom_seccion();
                $subTitulo = $_objSeccion->get_subtitulo();
                $faIcono = $_objSeccion->get_icono();
                $nomSeccion = $_objSeccion->get_nom_seccion();
                if(isset($_GET['idsec']) && $_GET['idsec'] == -1 ){ // imagenes
                    $titulo = 'imagenes';
                    $subTitulo = 'Sube tus fotos en diferentes secciones';
                    $faIcono = 'fa-file-image-o';
                    $nomSeccion = $titulo;
                }else if(isset($_GET['idsec']) && $_GET['idsec'] == -2 ){ // formulario informacion general
                    $titulo = 'general';
                    $subTitulo = 'Configuraci&oacute;n general de p&aacute;gina';
                    $faIcono = 'fa-cogs';
                    $nomSeccion = $titulo;
                }else if(isset($_GET['idsec']) && $_GET['idsec'] == -3 ){ // ver mensajes de contactenos
                    $titulo = 'contactenos';
                    $subTitulo = 'Mensajes de contacto de tus posibles clientes';
                    $faIcono = 'fa-envelope';
                    $nomSeccion = $titulo;
                }
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php echo $titulo; ?><small> <?php echo $subTitulo; ?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa <?php echo $faIcono ; ?>"></i> <?php echo $nomSeccion ; ?>
                            </li>
                        </ol>
                        <div class="modal fade bs-example-modal-sm" tabindex="-1" id="modal-success-generico" name="modal-success-generico" role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm" role="document">
                          <div class="modal-content">
                            <div class="alert alert-success" id="success-generico" name="success-generico" ></div>
                          </div>
                        </div>
                      </div>
                        
                        <div class="alert alert-danger" id="danger-generico" name="danger-generico" style="display: none;"></div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        $idSeccion = $_objSeccion->get_id_seccion();
                        if(isset($_GET['idsec']) && $_GET['idsec'] == -1 ){ // imagenes
                            if(isset($_GET['dir']) && $_GET['dir'] ){
                                $_objImg->setFolder($_GET['dir']);
                            }
                            if(isset($_GET['msg'])){
                                $mensaje = json_decode(base64_decode($_GET['msg']),true);
                                //print_r($mensaje);
                                if($mensaje['ok'] == 1){
                                    echo '<div id="alerta_generica" class="alert alert-success">'.$mensaje[ 'mensaje'].'</div>';
                                }else{
                                    echo '<div id="alerta_generica" class="alert alert-danger">'.$mensaje[ 'mensaje'].'</div>';
                                }
                            }
                            echo $_objImg->formularioImagenes();
                        }else if(isset($_GET['idsec']) && $_GET['idsec'] == -2 ){ // formulario informacion general ?>
                        <div class="col-lg-6">
                            <?php
                            $_objForm->setDAO($objGeneral);
                            echo $_objForm->obtenerFormulario();
                            ?>
                        </div>
                        <?php
                        
                        }else if(isset($_GET['idsec']) && $_GET['idsec'] == -3 ){ // ver mensajes de contactenos ?>
                        <div class="col-lg-12">
                            <?php
                            echo $_objContacto->obtenerContactenos();
                            ?>
                        </div>   
                        <?php
                        }else{
                        ?>
                        <div class="col-lg-3">
                        <?php
                        $_objForm->setDAO($_objSeccion);
                        //$_objForm->conLabel();
                        echo $_objForm->obtenerFormulario();
                        //print_r($_objSeccion);
                        ?>
                        </div>
                    <div class="col-lg-9">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title" onclick="toogleElemento('#cont_ele_nuevo');" style="cursor: pointer;">Nuevo</h3>
                            </div>
                            <div class="panel-body" style="display: none;" id="cont_ele_nuevo"> 
                                Panel content 
                                <?php
                                $_objElemNuevo = new DAO_Elementos();
                                $_objElemNuevo->set_obj_seccion($_objSeccion);
                                $_objForm->setDAO($_objElemNuevo);
                                echo $_objForm->obtenerFormulario();
                                ?>
                            </div>
                        </div>
                        <?php
                        // ---- listado de elementos de seccion
                        $objElemento = new DAO_Elementos();
                        $objElemento->set_obj_seccion($_objSeccion);
                        $arrElem = $objElemento->consultar();
                        //print_r($arrElem);
                        if(is_array($arrElem)){
                            foreach($arrElem as $key => $objE){
                            ?>
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <h3 class="panel-title" style="cursor: pointer;" onclick="toogleElemento('#cont_elem_<?php echo $objE->get_id_elemen(); ?>')"><span class="caret"></span>    <?php echo $objE->get_titulo(); ?> <span style="color: #bbbbbb; font-size: 0.8em;">(<?php echo $objE->get_orden(); ?>)</span></h3>
                                </div>
                                <div class="panel-body" id="cont_elem_<?php echo $objE->get_id_elemen(); ?>" style="display: none;"><?php
                                $_objForm->setDAO($objE);
                                //print_r($objE);
                                $valor = $objE->get_complemento();
                                if($valor){
                                    $_objCElem = new DAO_ComplementoElemento();
                                    $_objCElem->set_id_elemen($objE->get_id_elemen());
                                    $_objCElem->consultar();
                                    $_objForm->setDAOModal($_objCElem);
                                }
                                //$_objForm->conLabel();
                                echo $_objForm->obtenerFormulario(!empty($valor) ? $valor : FALSE );
                                ?></div>
                            </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                        <?php
                        }
                        ?>
                    </div>
                    
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
