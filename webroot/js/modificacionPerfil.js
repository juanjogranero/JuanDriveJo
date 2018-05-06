$(function() {

    // We can attach the `fileselect` event to all file inputs on the page
    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    // We can watch for our custom `fileselect` event like this
    $(document).ready( function() {
        $(':file').on('fileselect', function(event, numFiles, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }

        });
    });

});

function fileValidation(){
    var fileSize = $('#imagenPerfilUsuario')[0].files[0].size;
    var siezekiloByte = parseInt(fileSize / 1024);
    var fileInput = document.getElementById('imagenPerfilUsuario');
    var filePath = fileInput.value;
    var allowedExtensions = /(.jpg)$/i;
    if (siezekiloByte >  $('#imagenPerfilUsuario').attr('size')) {
        alert("La imagen no puede superar los 512Kb");
        fileInput.value = '';
        return false;
    }
    if(!allowedExtensions.exec(filePath)){
        alert('Por favor,introduzca un fichero de tipo imagen con el formato .jpg');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'" alt=\'nueva foto de perfil\' class=\'img-circle\' style=\'width:150px;height:150px ;margin-top:5%;box-shadow: 0px 0px 18px 2px rgba(0,0,0,0.3);\'/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}