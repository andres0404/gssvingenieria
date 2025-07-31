$(document).ready(function() {
    $('#filtroBody').toggle('collapsed');
    $('#filtroHeader').toggleClass('collapsed');
    //$(div).toggle("slow");
    // Inicializar contador
    actualizarContador();
    
    // Manejar el envío del formulario
    //$('#filtroForm').on('submit', function(e) {
    //    e.preventDefault();
    //    aplicarFiltros();
    //});
    
    // Actualizar filtros activos en tiempo real
    $('input, select').on('change', function() {
        actualizarFiltrosActivos();
    });
    
    // Toggle para colapsar/expandir filtros
    $('#filtroHeader').on('click', function() {
        $('#filtroBody').toggle('slow');
        $('#filtroHeader').toggleClass('collapsed');
    });
});

function aplicarFiltros() {
    console.log('Aplicando filtros...');
    
    // Obtener valores de los filtros
    var filtros = {
        nombre: $('#nombreProyecto').val().toLowerCase(),
        tipoEstructura: $('#tipoEstructura').val(),
        materialEstructural: $('#materialEstructural').val(),
        usoEstructura: $('#usoEstructura').val(),
        tipoEstudio: $('#tipoEstudio').val(),
        sistemaEstructural: $('#sistemaEstructural').val()
    };
    
    // Aplicar filtros a cada elemento
    $('.portfolio-item').each(function() {
        var elemento = $(this);
        var mostrar = true;
        var conLabel = false;
        
        // Filtro por nombre (si existe)
        if (filtros.nombre) {
            conLabel = true;
            var nombreElemento = elemento.find('h4').text().toLowerCase();
            if (nombreElemento.indexOf(filtros.nombre) === -1) {
                mostrar = false;
            }
        }
        
        // Filtro por Tipo estructura
        if (mostrar && filtros.tipoEstructura > -1 && elemento.attr('data-tipo_estructura')) {
            conLabel = true;
            var materialArray = JSON.parse(elemento.attr('data-tipo_estructura'));
            if (materialArray.indexOf(parseInt(filtros.tipoEstructura)) === -1) {
                mostrar = false;
            }
        }
        // Filtro por material
        if (mostrar && filtros.materialEstructural > -1 && elemento.attr('data-material_estructural')) {
            conLabel = true;
            var materialArray = JSON.parse(elemento.attr('data-material_estructural'));
            if (materialArray.indexOf(parseInt(filtros.materialEstructural)) === -1) {
                mostrar = false;
            }
        }
        
        // Filtro por uso
        if (mostrar && filtros.usoEstructura > -1 && elemento.attr('data-uso_estructura')) {
            conLabel = true;
            var usoArray = JSON.parse(elemento.attr('data-uso_estructura'));
            if (usoArray.indexOf(parseInt(filtros.usoEstructura)) === -1) {
                mostrar = false;
            }
        }
        // Filtro por tipoEstudio
        if (mostrar && filtros.tipoEstudio > -1 && elemento.attr('data-tipo_estudio')) {
            conLabel = true;
            var usoArray = JSON.parse(elemento.attr('data-tipo_estudio'));
            if (usoArray.indexOf(parseInt(filtros.tipoEstudio)) === -1) {
                mostrar = false;
            }
        }
        // Filtro por sistemaEstructural
        if (mostrar && filtros.sistemaEstructural > -1 && elemento.attr('data-sistema_estructural')) {
            conLabel = true;
            var usoArray = JSON.parse(elemento.attr('data-sistema_estructural'));
            if (usoArray.indexOf(parseInt(filtros.sistemaEstructural)) === -1) {
                mostrar = false;
            }
        }
        
        // Mostrar u ocultar elemento
        if (mostrar && conLabel) {
            elemento.removeClass('oculto').addClass('resaltado');
            setTimeout(function() {
                elemento.removeClass('resaltado');
            }, 1000);
        } else {
            elemento.addClass('oculto');
        }
    });
    
    // Actualizar contador
    actualizarContador();
    
    // Mostrar filtros activos
    actualizarFiltrosActivos();
    
    console.log('Filtros aplicados correctamente');
}

function actualizarContador() {
    var total = $('.portfolio-item').length;
    var visibles = $('.portfolio-item:not(.oculto)').length;
    
    $('#elementosTotales').text(total);
    $('#elementosVisibles').text(visibles);
    
    // Cambiar color según resultados
    if (visibles === 0) {
        $('#contadorResultados').removeClass().addClass('contador-resultados').css('background', '#dc3545');
    } else if (visibles < total) {
        $('#contadorResultados').removeClass().addClass('contador-resultados').css('background', '#ffc107');
    } else {
        $('#contadorResultados').removeClass().addClass('contador-resultados').css('background', '#28a745');
    }
}

function actualizarFiltrosActivos() {
    var filtros = [];
    
    // Nombre del proyecto
    var nombre = $('#nombreProyecto').val();
    if (nombre) {
        filtros.push('Nombre: ' + nombre);
    }
    
    // Listas maestras
    var tipoEstructura = $('#tipoEstructura option:selected').text();
    if ($('#tipoEstructura').val() && $('#tipoEstructura').val() != -1) {
        filtros.push('Tipo: ' + tipoEstructura);
    }
    
    var material = $('#materialEstructural option:selected').text();
    if ($('#materialEstructural').val() && $('#materialEstructural').val() != -1) {
        filtros.push('Material: ' + material);
    }
    
    var uso = $('#usoEstructura option:selected').text();
    if ($('#usoEstructura').val() && $('#usoEstructura').val() != -1) {
        filtros.push('Uso: ' + uso);
    }

    var tipoEstudio = $('#tipoEstudio option:selected').text();
    if ($('#tipoEstudio').val() && $('#tipoEstudio').val() != -1) {
        filtros.push('Tipo Estudio: ' + tipoEstudio);
    }
    var sistema = $('#sistemaEstructural option:selected').text();
    if ($('#sistemaEstructural').val() && $('#sistemaEstructural').val() != -1) {
        filtros.push('Sistema: ' + sistema);
    }
    
    // Mostrar filtros activos
    if (filtros.length > 0) {
        var html = '';
        filtros.forEach(function(filtro) {
            html += '<span class="badge-filtro">' + filtro + '</span>';
        });
        $('#filtrosTags').html(html);
        $('#filtrosActivos').show();
    } else {
        $('#filtrosActivos').hide();
    }
}

function limpiarFiltros() {
    $('#filtroForm')[0].reset();
    $('#filtrosActivos').hide();
    
    // Mostrar todos los elementos
    $('.portfolio-item').removeClass('oculto');
    actualizarContador();
    
    console.log('Filtros limpiados');
}

// Función para verificar si un elemento contiene un número específico
function elementoContieneNumero(elemento, numero) {
    var dataElementos = elemento.attr('data-elementos');
    if (dataElementos) {
        var array = JSON.parse(dataElementos);
        return array.indexOf(numero) !== -1;
    }
    return false;
}

// Función para filtrar por número específico
function filtrarPorNumero(numero) {
    $('.portfolio-item').each(function() {
        var elemento = $(this);
        if (elementoContieneNumero(elemento, numero)) {
            elemento.removeClass('oculto').addClass('resaltado');
            setTimeout(function() {
                elemento.removeClass('resaltado');
            }, 1000);
        } else {
            elemento.addClass('oculto');
        }
    });
    actualizarContador();
}