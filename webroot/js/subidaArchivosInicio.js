$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
$( "#subidaArchivosBoton" ).click(function() {
    $( "form" ).toggle( "blind", 500 );
});
