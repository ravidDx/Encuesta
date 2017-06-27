$(document).ready(function () {

    getsession();  
    var _proveedor;
    var _idProveedor; 
    var _registros= [];

    //Consulta ajax
    function getsession(){
        $.ajax({url: "php/iniciosesion.php", dataType: "JSON", success: function(result){
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

    var _preguntas = [];

    $('#btnGenerar').on('click', function(){
        _preguntas = [];
        var id = $("#sel_actividades option:selected").val();
        console.log(id);
        if (jQuery.isEmptyObject(id) === false){
            //            getActividad(id);
            $.get(
                'http://cobroalpasosails.herokuapp.com/Actividad',
                {id: id}, 
                function (pr) {
                    //                    console.log(pr);
                    $.each(pr.ac_preguntas, function (k, v) {
                        _preguntas.push(v);
                    });
                    //                    _registros = [];
                    getActividad(id);
                }
            ).fail(function(res){
                alert("Error: " + res.getResponseHeader("error"));
            });
            console.log(_preguntas);
        }

    });

    function getActividad(idActividad){
        $.ajax({
            url: 'php/consultas.php',
            type: 'POST',
            //                dataType: 'json',
            data: {"idActividad": idActividad}
        }).done(function(msg) {
            console.log("get Actividad");
            console.log(msg);
        });
    }

    var _data = [];

    function drawGeneral(aux){

        console.log('drawGeneral');
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





