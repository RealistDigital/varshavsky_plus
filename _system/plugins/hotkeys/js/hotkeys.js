$(document).ready(function(){

//-------------------------------------------------------------------------------
// Hotkeys
//-------------------------------------------------------------------------------

//-
var status_chek;
// key event 
$('html').keydown(function(e){
    
    /** Save по Cnrl + S */
    if(e.ctrlKey && e.which == 83) {
        e.preventDefault();
        $('form').submit(); 
    }
    
    /** Public part */
    if(e.ctrlKey && e.which == 81) {
        var addrPublic = $('#public-part').attr('href'); 
        window.location.href = addrPublic;
    }
    
    /** Back */
    if(e.ctrlKey && e.which == 8) {
        history.back()
    }
    
    /** Выделить все селекты */
    if(e.ctrlKey && e.altKey && e.which == 65) {
        //-
        if(status_chek) {
            $('#wp-content input[type=checkbox]').each(function(){
                $(this).attr('checked', true);
            });
            status_chek = false;
        } else {
            $('#wp-content input[type=checkbox]').each(function(){
                $(this).attr('checked', false);
            });
            status_chek = true;
        }
    }
    
    /** Показать текущий шаблон */
    if(e.ctrlKey && e.altKey && e.which == 84) {
        var tpl = parseInt($('body').data('template'));
        
        if(tpl != "") {
            $.getJSON(
                '/_system/ajax/view_template.php',
                {
                    ajax    : 1,
                    tpl     : tpl
                }, function (d) {
                    if (d.res == 1) {
                        alert ('Information current template\n\nName- '+d.name_view+'\n\nView - '+d.view+' \nEdit - '+d.edit);
                    }
                }
            );
        }
        return false;
    }
 
});




});

