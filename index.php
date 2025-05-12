<?php
//include_once 'clases/class.conexion.php';
//print_r($_SERVER);
//die(SERVIDOR.'/clases/class.seccion.php');
include_once $_SERVER['DOCUMENT_ROOT'].'/agencia/clases/class.seccion.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/agencia/clases/DAO/DAO_General.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/agencia/clases/class.plantillas.php';
/*
include_once SERVIDOR.'/clases/class.seccion.php';
include_once SERVIDOR.'/clases/DAO/DAO_General.php';
include_once SERVIDOR.'/clases/class.plantillas.php';
*/
$objGeneral = new DAO_General();
$objGeneral->set_id(1);
$objGeneral->consultar();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <link rel="icon" href="/agencia/img/logos/favicon.ico"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $objGeneral->get_desc_pagina(); ?>">
    <meta name="author" content="<?php echo $objGeneral->get_tit_pagina();?>">
    
    <meta property="og:url"           content="http://www.gssvingenieria.com/agencia/" />
<meta property="og:type"               content="business.business" />
<meta property="og:title"              content="<?php echo $objGeneral->get_tit_pagina();?>" />
<meta property="og:description"        content="<?php echo $objGeneral->get_desc_pagina(); ?>" />
<meta property="og:image"              content="http://<?php echo $_SERVER['HTTP_HOST'].'/agencia/img/logos/gssv_mini.png';?>" />
<meta property="og:image:type" content="image/png" />
<meta property="og:image:width" content="230" />
<meta property="og:image:height" content="100" />
<meta property="og:image"              content="http://<?php echo $_SERVER['HTTP_HOST'].'/agencia/img/share1.png';?>" />
<meta property="og:image:type" content="image/png" />
<meta property="og:image:width" content="400" />

    <title><?php echo $objGeneral->get_tit_pagina();?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
.sobre {
 position:absolute;
 top:0px;
 left:0px;
 border:none;
}
</style>
</head>

<body id="page-top" class="index">
<?php
/*$con = ConexionSQL::getInstance();
$id = $con->consultar("select * from general");
$res = $con->obenerFila($id);
print_r($res);*/

$objMenu = new Secciones();
$dataMenu = $objMenu->getSecciones();

?>
    
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <img src="img/logos/<?php echo $objGeneral->get_logo();?>" style="width: 5em" /> <?php //echo $objGeneral->get_nom_empresa();?></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <?php
                    if($dataMenu != FALSE){
                        for($i = 0; $i < count($dataMenu); $i++){
                            echo '<li><a class="page-scroll" href="#'.$dataMenu[$i]->get_anclaSeccion().'">'.ucfirst($dataMenu[$i]->get_nomSeccion() ).'</a></li>';
                        }
                    }
                    ?>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <?php 
                $lema = $objGeneral->get_lema();
                $arrLema = explode("|", $lema);?>
                <div class="intro-heading"><?php echo $arrLema[0];?></div>
                <div class="intro-lead-in"><?php echo $arrLema[1]; ?></div>
                <!--<a href="#services" class="page-scroll btn btn-xl">Saber m&aacute;s</a>-->
            </div>
        </div>
    </header>
<?php
    $objPlantilla = null;
    if($dataMenu != FALSE){
        $objPlantilla = new Plantillas();
        for($i = 0; $i < count($dataMenu); $i++){
            echo $objPlantilla->getHtmlSeccion($dataMenu[$i]);
        }
    }
?>
  
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; <?php echo $objGeneral->get_nom_empresa();?></span>
                </div>
                <?php
                $f = $objGeneral->get_url_facebook();
                $u = $objGeneral->get_url_web();
                $t = $objGeneral->get_url_twitter();
                $l = $objGeneral->get_url_linkedin();
                ?>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <?php if(!empty($t)){?><li><a href="<?php echo $t;?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php } ?>
                        <?php if(!empty($f)){?><li><a href="<?php echo $f;?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php } ?>
                        <?php if(!empty($l)){?><li><a href="<?php echo $l;?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php } ?>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Politica de privacidad</a>
                        </li>
                        <li>Desarrollado por: <a href="mailto:leviatan.info@gmail.com" title="app cloud - Contacto: Andres Silva">apps cloud <span class="fa fa-cloud fa-stack "></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Portfolio Modals -->
    <!-- Use the modals below to showcase details about your portfolio projects! -->
    <?php
    if($objPlantilla instanceof Plantillas){
       // echo $objPlantilla->getModalPortafolio();
    }
    ?>
   
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script async src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/agency.js"></script>

</body>

</html>
