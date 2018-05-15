						            //Ayuda
                        $( "#ayuda" ).click(function() {
                            ayuda = document.getElementById("amount").value;
                            console.log(ayuda);
                        });
                        
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

                            $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) + "€" +
                            " - " + $( "#slider-range" ).slider( "values", 1 ) + "€" );
                        });
                            
                        //Calendar
                        $(function() {

                        $("#from").datepicker({ minDate: 0 });
                        $("#to").datepicker({ minDate: 1 });
                        });
                        
                        $( function() {
                              var dateFormat = "mm/dd/yy",
                              from = $( "#from" )
                                .datepicker({
                                  changeMonth: true,
                                  numberOfMonths: 1
                                })
                                .on( "change", function() {
                                  to.datepicker( "option", "minDate", getDate( this ) );
                                }),
                              to = $( "#to" ).datepicker({
                                changeMonth: true,
                                numberOfMonths: 1
                              })
                              .on( "change", function() {
                                from.datepicker( "option", "maxDate", getDate( this ) );
                              });
                         
                            function getDate( element ) {
                              var date;

                              try {
                                date = $.datepicker.parseDate( dateFormat, element.value );
                              } catch( error ) {
                                date = null;
                              }
                         
                              return date;
                            }
                          });