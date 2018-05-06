$( document ).ready(function() {
    $( "#formSubida" ).toggle( "blind", 1 );
});
$( "#subidaArchivosBoton" ).click(function() {
    $( "#formSubida" ).toggle( "blind", 500 );
});
