$(document).ready(function(){
    //-----------------------------------------------------------------------------
    // Login / Focus && Blub полей формы
    //-----------------------------------------------------------------------------
    
    $('.field-login input, .field-pass input').focus(function(){
        if($(this).val() == "login") {
            $(this).val(""); 
        }
       
    });
    $('.field-login input, .field-pass input').blur(function(){
        if($(this).val() == ""){
            $(this).val("login"); 
        }
    });
});