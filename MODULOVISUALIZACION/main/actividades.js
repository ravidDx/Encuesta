$(document).ready(function () {

    var _proveedor;
    
	
		

      getsession();    
 //////Ejemplo de get json
    function getsession(){
        $('.actividadesLoading').show();
        $.getJSON({url: "php/iniciosesion.php", dataType: "JSON", success: function(result){
            _proveedor = result;
			
            getActividad();
         
        }});
    };

   ///////// Ejemplo de ajax para llamar a un Curl en php de varias consultas simultaneas
    var _idActividadSeleccionada;

    $("body").on("click", ".btnLanzar", function (x) {
        _idActividadSeleccionada = $(this).attr('value');		

        console.log("ID Actividad y click");
        console.log(_idActividadSeleccionada);
        
        $.ajax({
            url: 'php/cuentaActividadSitio.php',
            type: 'POST',
            //dataType: 'json',
            data: {"idactividadSeleccionada": _idActividadSeleccionada}
        }).done(function(msg) {
            var objeto = $.parseJSON(msg);
            console.log("Consulta exitosa valor paquete y # sitios");
	    $('#cuentasitios').html(objeto.numactsitio);
            $('#valoract').html(objeto.valorPaquete);
            
            $('#LanzarActividad').modal({
                show: 'true'
            }); 
                        
            //window.location.href = "actividadsitios.php";
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log("fail: " + textStatus + " " + errorThrown);
        });
		
		/////Ejemplo de Get desde Jquery
		  $.get(
                'http://cobroalpasosails.herokuapp.com/ActividadSitio',{ as_tieneactividad: _idActividadSeleccionada },
                function (ac_sitios) {
                    console.log(ac_sitios);
					  $('#cuentasitios').html(ac_sitios.length);
                    //enviaDatos(ac_sitios);
                }
            ).fail(function(res){
                alert("Error: " + res.getResponseHeader("error"));
            }); 
		
			
		
    });

    
	


});