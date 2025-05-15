<?php
include_once __DIR__.'/../../clases/DAO/DAO_General.php';
$objGeneral = new DAO_General();
$objGeneral->set_id(1);
$objGeneral->consultar();
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login Administrador</title>

        <!-- CSS -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
        <script>
            function verificalogin(){
                $("#msg-error").hide("slow");
                 $.ajax({
            method: "POST",
            url: "/clases/class.login.php",
            data: { 
                usuario: $("#form-username").val(),
                clave: $("#form-password").val(),
            }
          })
            .done(function( msg ) {
              //alert( msg );
              //var obj = $.parseJSON(msg);
              if(msg.ok == 0){
                  $("#msg-error").html(msg.mensaje);
                  $("#msg-error").show("slow");
                  //alert(msg.mensaje);
              }else{
                  document.location.href = msg.url;
              }
            });
            }
        </script>
    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong><a href="/" title="Inicio" alt="Inicio" ><?php  echo $objGeneral->get_nom_empresa(); ?></a></strong> Login </h1>
                            <div class="description">
                            	<p>
	                            	<?php $lema = $objGeneral->get_lema(); 
                                        $arrLema = explode("|", $lema);
                                        echo $arrLema[1];
                                        //echo "<br>";
                                        //echo $arrLema[0];
                                        ?> 
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Administrador de su web site</h3>
                            		<p>Entre su nombre de usuario y password:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
                                <div class="alert alert-danger" id="msg-error" style="display: none;"></div>
			                    <form role="form" action="" method="post" class="login-form" >
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Usuario</label>
			                        	<input type="text" name="form-username" placeholder="Usuario..." class="form-username form-control" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="form-password" placeholder="Password..." class="form-password form-control" id="form-password">
			                        </div>
                                                <button type="button" class="btn" onclick="verificalogin();">Entrar!</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 social-login">
                        	<h3>... o visitenos en:</h3>
                        	<div class="social-login-buttons">
                                    <?php
                                    $redesSociales['facebook'] = $objGeneral->get_url_facebook();
                                    $redesSociales['twitter'] = $objGeneral->get_url_twitter();
                                    ?>
                                    
                                    <?php
                                    if(!empty($redesSociales['facebook'])){
                                        ?>
                                    <a class="btn btn-link-2" title="facebook" href="<?php echo $redesSociales['facebook'];?>" target="_blank">
	                        		<i class="fa fa-facebook"></i> Facebook
	                        	</a>
                                    <?php
                                    }
                                    if(!empty($redesSociales['twitter'])){
                                    ?>
                                    <a class="btn btn-link-2" title="twitter" href="<?php echo $redesSociales['twitter'];?>" target="_blank">
	                        		<i class="fa fa-twitter"></i> Twitter
	                        	</a>
                                    <?php
                                    }
                                    ?>
	                        	<!--<a class="btn btn-link-2" href="#"><i class="fa fa-google-plus"></i> Google Plus</a>-->
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>