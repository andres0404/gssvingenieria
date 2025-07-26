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