$(document).ready(function () {

    getsession();

    //Variables   
    var _proveedor;
    var _idProveedor; 
    var _registros= [];
    var _preguntas = [];
    var _respuestas = [];
    var clientes = [];

    var numeroRespuestas=0;
    var generarGrafico=0;
    var obteniendoActividades;
    var obteniendoRespuestas;
    var obteniendoClientes;

    var datos = [];




    //Consulta ajax
    function getsession(){
        $.ajax({
            url: "php/iniciosesion.php", 
            dataType: "JSON", 
            success: function(result){
                console.log(result);			
                _proveedor = result;
                _idproveedor = result.id;
                console.log(_idproveedor);
                cargaActividad();

            }});
    };

    function cargaActividad(){
        console.log("cargar actividad");
        $.each(_proveedor.pr_actividades, function (key, value) {
            $('#sel_actividades').append('<option value="'+value.id+'">'+value.ac_nombreActividad+'</option>').fadeIn();
        });
    }


    $('#btnGenerar').on('click', function(){
        _preguntas = []; //Vaciar el arreglo
        var id = $("#sel_actividades option:selected").val();
        getActividad(id);

    });

    //Funcion que obtiene la data de la actividad seleccionada
    function getActividad(_idActividad){

        obteniendoActividades = $.ajax({
            url: "php/consultasActividad.php",
            type: "POST",
            dataType: 'json',
            data: {"_idActividad": _idActividad}
            }).done(function(respuesta){
                if (respuesta.estado === 200) {
                    console.log("estado Actividad: "+respuesta.estado);
                    console.log("idActividad. "+_idActividad);
                    _preguntas = respuesta.preguntas;
                    console.log("# Preguntas: "+ _preguntas.length);
                    console.dir(_preguntas);
                    $.each(_preguntas, function (key, value) {
                        _idPregunta = value.id;
                        getRespuesta(_idPregunta);    
                    });

                }
                      
            });
    
    };

    //Funcion que obtiene las respuestas de las preguntas de la actividad
    function getRespuesta(_idPregunta){
       obteniendoRespuestas = $.ajax({
            url: "php/consultasRespuesta.php",
            type: "POST",
            dataType: 'json',
            data: {"_idPregunta": _idPregunta}
            }).done(function(respuesta){
               if (respuesta.estado === 200) {
                    console.log("estado Pregunta: "+respuesta.estado);
                    console.log("cantidad Respuestas: "+respuesta.cantidadRespuestas);
                    console.log("cantidad Opciones: "+respuesta.cantidadOpciones);
                    console.dir(respuesta.coleccionRespuestas);
                    $.each(respuesta.coleccionRespuestas, function (key, value) {
                        _idRespuesta = value.id;
                        getCliente(_idRespuesta);
                        generarGrafico= generarGrafico+1;    
                    });
                }
            });
   
    };

    //Funcion que obtiene el cliente de cada respuesta de las preguntas de la actividad
    function getCliente(_idRespuesta){

        obteniendoClientes = $.ajax({
                url: 'php/consultasCliente.php',
                type: 'POST',
                dataType: 'json',
                data: {"_idRespuesta": _idRespuesta}
            }).done(function(respuesta) {
                if (respuesta.estado === 200) {
                    
                    console.log("estado Respuesta: "+respuesta.estado);
                    console.log("id Cliente "+respuesta.idCliente);
                    console.log("correo: "+respuesta.correo);
                    console.log("cantidad Clientes: "+clientes.length);
                    var objetoCliente = new Object();
                    var nuevo = 1;
                    
                    $.each(clientes, function (key, value) {
                        console.log("key: "+key);
                        if(value.id == respuesta.idCliente){
                            console.log("Actualizacion");
                            clientes[key].calificacion = parseInt(clientes[key].calificacion) + 1;
                            nuevo = 0;
                            numeroRespuestas = numeroRespuestas+1;
                            datos[key]= clientes[key].calificacion;
                            return false;
                        }else{
                            nuevo = 1;
                        }
                    });

                if(nuevo == 1){
                    console.log("Nuevo");
                    numeroRespuestas = numeroRespuestas+1;
                    objetoCliente.id = respuesta.idCliente;
                    objetoCliente.correo = respuesta.correo;
                    objetoCliente.calificacion = 1;
                    clientes.push(objetoCliente);
                    datos.push(objetoCliente.calificacion);
                }

                console.dir("clientes");
                console.dir(clientes);

                console.log(generarGrafico +"  numResp. "+ numeroRespuestas);
                if(numeroRespuestas == generarGrafico){
                    console.log("<<<<<<<<<<<<<<<<<<<<<<<<<<<<< llego al final");
                    graficarBarras();
                }


                 
            }
           
        });

    }

    function graficarBarras(){
        console.log("Graficando Barras");
        console.log(datos);
         var datos = [200,20,4,1];
          var config = { columnWidth: 45, columnGap: 5, margin: 10, height: 200 };
         
          d3.select("svg")
              .selectAll("rect")
              .data(datos)
            .enter().append("rect")
              .attr("width", config.columnWidth)
              .attr("x", function(d,i) {
                 return config.margin + i * (config.columnWidth + config.columnGap)
               })
              .attr("y", function(d,i) { return config.height - d })
              .attr("height", function(d,i) { return d })
              .attr("fill", function(d) {
                return "rgb(0, 0, " + (d * 10) + ")";
                })
               .text(function(d) {
                    return d;
                })



    }



    function drawGeneral(aux){

        console.log('drawGeneral');
        cosole.log(datos);
        var suma = [];
        var cont = 0;
        var len = _preguntas.length;
        var tot= [];
        var y = [];

        $.each(_preguntas, function (key, value) {
            console.log(key, value);
            cont++;
            var num = 0;
            var contador = 0;

            $.each(aux, function (k, v) {

                if((v.id === value.id)){
                    tot= [];
                    contador++;
                    num = num + parseFloat(v.valor);
                    console.log(cont, num, contador);
                    tot.push({'label': value.pr_pregunta, 'value': num/contador, 'cont': contador});
                    //return tot = num / contador;

                }

            });
            console.log('tot',tot);
            y.push(tot[0]);
        });

        console.log('y',y);
        //        sacar(y);
    }

    function sacar(x){
        _data = [];
        _data = x;
        console.log('sacar');
        console.log('data',_data);
        if (jQuery.isEmptyObject(x) === false){
            graficar(x);
        }else{
            console.log('no existen respuestas');
        }

    }





    function graficar(data){

        var margin = {top: 50, right: 20, bottom: 200, left: 40},
            width = 960 - margin.left - margin.right,
            height = 600 - margin.top - margin.bottom;

        var formatPercent = d3.format(".0%");

        var x = d3.scale.ordinal()
        .rangeRoundBands([0, width], .1);

        var y = d3.scale.linear()
        .range([height, 0]);

        var xAxis = d3.svg.axis()
        .scale(x)
        .orient("bottom");

        var yAxis = d3.svg.axis()
        .scale(y)
        .orient("left");

        var tip = d3.tip()
        .attr('class', 'd3-tip')
        .offset([-10, 0])
        .html(function(d) {
            return "<strong>Valor:</strong> <span style='color:white'>" + d.value + "</span>";
        })

        var svg = d3.select("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + 0 + ")");

        svg.call(tip);

        x.domain(data.map(function(d) { return d.label; }));
        y.domain([0, d3.max(data, function(d) { return d.value; })]);

        svg.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis)
            .selectAll("text")
            .attr("transform", "rotate(-60)")
            .attr("dx", "-.8em")
            .attr("dy", ".25em")
            .style("text-anchor", "end")
            .style("font-size", "15px");

        svg.append("g")
            .attr("class", "y axis")
            .call(yAxis)
            .append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 6)
            .attr("dy", ".71em")
            .style("text-anchor", "end")
            .text("Puntuación Respuestas")
            .style("font-size", "15px"); 


        svg.selectAll(".bar")
            .data(data)
            .enter().append("rect")
            .attr("class", "bar")
            .attr("x", function(d) { return x(d.label); })
            .attr("width", x.rangeBand())
            .attr("y", function(d) { return y(d.value); })
            .attr("height", function(d) { return height - y(d.value); })
            .on('mouseover', tip.show)
            .on('mouseout', tip.hide);


    }




});





