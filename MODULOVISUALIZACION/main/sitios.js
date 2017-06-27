$(document).ready(function () {

    var _idproveedor;
    var _result;

    

    

    getsession();    

    function getsession(){
        $('.sitioLoading').show();
        $.ajax({url: "php/iniciosesion.php", dataType: "JSON", success: function(result){
            console.log(result);
            _idproveedor = result.id;

            getSitios();
            //_id = result;
        }});
    };


    function getSitios(){

        var app = {};
        var _datos = [];

        $.get(
            'http://cobroalpasosails.herokuapp.com/Sitio',{ st_publica: _idproveedor },
            function (res) {
                //console.log(res);
                if(res.length != 0 ){
                    enviaDatos(res);
                }else{
                    $('.sitioLoading').hide();
                }
            }
        ).fail(function(res){
            alert("Error: " + res.getResponseHeader("error"));
        });
    };

    function filterColumn ( i ) {
        $('#tablesitios').DataTable().column( i ).search(
            $('#col'+i+'_filter').val()
        ).draw();
    }

    function enviaDatos(sitios){
        //console.log(sitios);
        $.ajax({
            url: 'php/tablaSitios.php',
            type: 'POST',
            //dataType: 'json',
            data: {"sitios": sitios}
        }).done(function(msg) {
            //console.log("success");
            //console.log(msg);
            $('#actividades').html(msg);
            $('.sitioLoading').hide();
            $('#tablesitios').dataTable({
                "ordering": false,
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel'
                ],
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });

            var table = $('#tablesitios').DataTable();
            $('input.column_filter').on( 'keyup click', function () {
                filterColumn( $(this).parents('tr').attr('data-column') );
            } );

            function selecta(x){
                var asd;
                $('#filterTable').find( '.select-filter' ).each(function( index ) {
                    if($( this ).parents('tr').attr('data-column') === String(x)){
                        asd = $( this ).parents('tr').attr('data-column', String(x));
                        return false; 
                    }
                });
                return asd;
            }

            table.columns( '.select-filter' ).every( function () {
                var that = this;
                // Create the select list and search operation
                var asd = selecta(that.selector.cols);
                var t = $('<td></td>');
                var select = $('<select class="form-control"><option value="">Seleccione...</option></select>')
                .appendTo(t)
                .on( 'change', function () {
                    that
                        .search( $(this).val() )
                        .draw();
                } );

                // Get the search data for the first column and add to the select list
                this
                    .cache( 'search' )
                    .sort()
                    .unique()
                    .each( function ( d ) {
                    select.append( $('<option value="'+d+'">'+d+'</option>') );
                } );

                t.appendTo(asd);
            } );

        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log("fail: " + textStatus + " " + errorThrown);
        });
    }

   

    

    

    

    
});