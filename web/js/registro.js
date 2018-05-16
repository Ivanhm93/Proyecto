$("#appbundle_user_username").blur(function(){
                    
    var nick = this.value;
                    
    $.ajax({
                        
        url: 'http://localhost:8080/chustor/web/app_dev.php/nick-test',
        data: {nick: nick},
        type: 'POST',
        success: function(Response){
                            
            if(Response === 'usado') {
                                
                $('#appbundle_user_username').css("border", "1px solid red"); 
            }
            else if(Response === 'sinusar') {
                                
                $('#appbundle_user_username').css("border", "1px solid green");
            }

        }

    });
                    
});
