$(document).ready(function () { 

    $("#btnIniciarSesion").on("click", function () {
        
            $('.loginLoading').show();
            $('#btnIniciarSesion').prop( "disabled", true );
            $.get(
                'http://cobroalpasosails.herokuapp.com/Proveedor',{ pr_correoElectronico: "jess@jess.com" },
                function (res) {
                    if(res.length != 0 ){
                        console.log("Usuario encontrado");
                        console.log(res);
                        if(res[0].pr_password == $.md5("123")){
                            console.log('exito ');
                
                            login(res[0]);
                        }else{
                            mensajeError('Correo electronico y/o contraseña incorrectos, intente nuevamente.');
                            $('.loginLoading').hide();
                             $('#btnIniciarSesion').prop( "disabled", false );
                        }

                    }else{
                        mensajeError('Usuario no encontrado');
                        $('.loginLoading').hide();
                        $('#btnIniciarSesion').prop( "disabled", false );
                    }
                }
            ).fail(function(res){
                console.log("Error: " + res.getResponseHeader("error"));
            });
        
    });

    function mensajeError(mensaje){
        $('.msgErrorLogin').html('<strong>Error !! </strong>'+mensaje);
        $('.msgErrorLogin').show(0).delay(5000).hide(0);
    }

    

   function login(provedor){
        $.ajax({
            url: 'php/iniciosesion.php',
            type: 'POST',
            dataType: 'json',
            data: {"proveedor": provedor}
        }).done(function(msg) {
            console.log("success");
            console.log(msg);
            $('.loginLoading').hide();
            window.location.href = "visualizacion.php";
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log("fail: " + textStatus + " " + errorThrown);
        });
    }
});      

