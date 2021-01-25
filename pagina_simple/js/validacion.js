$(document).ready(function(){
    $('#form').on('submit', function(){
        //Se obtiene los valores de cambios de contraseña
        var contra = $('#contra')
        var contra2 = $('#contra2')

        if(contra.val() != contra2.val()){
            $('#error').removeClass('ocultar');
            $('#error').addClass('mostrar');
            return false;
        }else{
            $('#error').removeClass('mostrar');
            $('#error').addClass('ocultar');

            $('#ok').removeClass('mostrar')
            return true;
        }
    })
    // $("#form").on('paste', function(e){
    //     e.preventDefault();
    //     alert('Esta acción está prohibida');
    //   })
      
    // $("#form").on('copy', function(e){
    //     e.preventDefault();
    //     alert('Esta acción está prohibida');
    // })
    
})
