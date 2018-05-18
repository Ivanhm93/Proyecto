$(document).ready(function(){

    $('#appbundle_user_Registrar').text('Modificar');

    $('#appbundle_user_username').click(function(){

        $('#error').css('color','red');
        $('#error').text('El nombre de usuario no se puede modificar');
    });

    $('#appbundle_user_username').blur(function(){

        $('#error').empty();
    });
});