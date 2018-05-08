$( document ).ready(function() {
    $( "#formSubida" ).toggle( "blind", 1 );
});
$( "#subidaArchivosBoton" ).click(function() {
    $( "#formSubida" ).toggle( "blind", 500 );
});
function eliminarArchivo(codigoFicheroEliminar,tamanioFicheroEliminar) {
    if(confirm("Estas seguro de que quieres eliminar este archivo ?")){
        location.href ="core/eliminarArchivo.php?codigoFicheroEliminar="+codigoFicheroEliminar+"&tamanioFicheroEliminar="+tamanioFicheroEliminar;
    }
}