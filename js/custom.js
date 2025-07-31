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
function abre_cierra_servicio(id){
     $("#servi_txt_" + id).slideToggle("fast", 
         function(){ 
            if(  $("#servi_txt_" + id).css("display") == "none" ){  
                $("#servi_" + id).removeClass("fa fa-chevron-circle-up fa-stack").addClass("fa fa-chevron-circle-down fa-stack");
            }else{ 
              $("#servi_" + id).removeClass("fa fa-chevron-circle-down fa-stack").addClass("fa fa-chevron-circle-up fa-stack");
            }
     });
}