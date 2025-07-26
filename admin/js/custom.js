function eliminarImagen(path, nomImg,div_cont){
    if(confirm(`Desea eliminar la imagen ${nomImg}?`)){
    $.ajax({
            method: "POST",
            url: "operaciones_imagenes.php",
            data: { borrar_img: "1", path: path, img: nomImg }
        }).done(function( objP ) {
            if(objP.ok == 1){
                $("#cont_" + div_cont).toggle(2000);
            }else {
                $("#cont_error_img").html(objP.mensaje);
                $("#cont_error_img").toggle("slow");
                $("#cont_error_img").delay(6000).toggle("slow");
            }
        })
    }
}
function validarSubirImagen(){
    var imgValidas = ["jpg", "png", "gif"];
    if($("#img_imagen").val().length < 3){ 
        alert("El campo archivo esta vacio"); 
        return false; 
    }
    var archivo = $("#img_imagen").val().split("."); 
    if(imgValidas.find(ext => ext === archivo[archivo.length - 1])){ 
        $("#img_form").submit(); 
    }else{
        alert(`Extension ${ archivo[archivo.length - 1]} no permitida`); 
        return false;
    }
}
function procesarFormulario(nom_form){
    var dataString = $("#" + nom_form).serialize();
    $.ajax({
        type: "POST",
        url: "../clases/class.procesarFormulario.php",
        data: dataString,
        success: function(data) {
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
    });
}
var VISTO = 0;
function marcarVistos(){
    if(VISTO == 1) return false;
    $.ajax({
        method: "POST",
        url: "/clases/class.procesarFormulario.php",
        data: { contacVisto: "1", mensajes: Array.from(document.querySelectorAll(".message-preview")).map(e => e.id) }
    }).done(function( objP ) {
        VISTO = 1;
        $("#contacto_badge").css("display","none");
    });
}