//Filtro Slider
$( function() {
    $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 100,
        values: [ 0, 50 ],
        slide: function( event, ui ) {
            $( "#amount" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ]);
        }
    });

    $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) + "€" + " - " + 
    $( "#slider-range" ).slider( "values", 1 ) + "€" );});
                         
    
//Calendar
$(function() {

    $("#from").datepicker({ minDate: 0 });
    $("#to").datepicker({ minDate: 1 });
});
                        
$( function() {
    
    var dateFormat = "mm/dd/yy",
    from = $( "#from" ).datepicker({ changeMonth: true, numberOfMonths: 1}).on( "change", function() {

        to.datepicker( "option", "minDate", getDate( this ) );
    }),
    to = $( "#to" ).datepicker({changeMonth: true, numberOfMonths: 1}).on( "change", function() {

        from.datepicker( "option", "maxDate", getDate( this ) );
    });
                         
    function getDate( element ) {

        var date;

        try {
            
            date = $.datepicker.parseDate( dateFormat, element.value );
        } 
        catch( error ) {

            date = null;
        }
                         
        return date;
    }
});

$(document).ready(function(){
    
    $('#provincia').each(function(){
        $(this).change(function(){

            $('#filtrador').css('display','inline');
            $('#loadingAjax').removeAttr('style');
            $('#localidad').remove();
            $('#lbllocalidad').remove();
            $('#ajaxProv').append('<label id="lbllocalidad">Localidad:</label>');
            $('#ajaxProv').append('<select name="localidad" id="localidad"></select>');
            var url1=$(this).val();
            $.ajax({
                method: "GET",
                url: "home/" +url1,
                dataType: 'json',
                success: function(data)
                {
                    $('#loadingAjax').css('display', 'none');
                    var posts=JSON.parse(data.posts);
                    $('#localidad').empty();

                        for (i in posts)
                        {
                            
                            $("#localidad").append("<option value='"+ posts[i].id + "'>"+ posts[i].nombre + "</option> " );                
                        
                        }	
                    
                },
                error: function(jqXHR, exception)
                {
                    if(jqXHR.status === 405)
                    {
                        console.error("METHOD NOT ALLOWED!");
                    }
                }
            });
        })
        
    });


    $('#filtroSelect').each(function(){
        $(this).change(function(){

            var valor = $("#filtroSelect").val();
            var $divs = $('div.ordenables');

            switch(valor) {
                case 'Ordenaciones':
                    $("#apartamentos").load(" #apartamentos");
                    break;
                case 'Precios Bajos':
                    var ordenados = $divs.sort(function (a, b) {
                        return $(a).find("h5").text() > $(b).find("h5").text();
                    });
                    $("#apartamentos").html(ordenados);
                break;
                case 'Precios Altos':
                    var ordenados = $divs.sort(function (a, b) {
                        return $(a).find("h5").text() < $(b).find("h5").text();
                    });
                    $("#apartamentos").html(ordenados);
                break;
                case 'Pocas Personas':
                    var ordenados = $divs.sort(function (a, b) {
                        return $(a).find("h6:first").text() > $(b).find("h6:first").text();
                    });
                    $("#apartamentos").html(ordenados);
                break;
                case 'Muchas Personas':
                var ordenados = $divs.sort(function (a, b) {
                    return $(a).find("h6:first").text() < $(b).find("h6:first").text();
                });
                $("#apartamentos").html(ordenados);
                break;
                case 'Pocas Habitaciones':
                    var ordenados = $divs.sort(function (a, b) {
                        return $(a).find("h6:eq(1)").text() > $(b).find("h6:eq(1)").text();
                    });
                    $("#apartamentos").html(ordenados);	
                break;
                case 'Muchas Habitaciones':
                var ordenados = $divs.sort(function (a, b) {
                    return $(a).find("h6:eq(1)").text() < $(b).find("h6:eq(1)").text();
                });
                $("#apartamentos").html(ordenados);	
                break;
            }
        })
        
    });

}); 