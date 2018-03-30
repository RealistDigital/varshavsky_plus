//-------------------------------------------------------------------------------
// Hotkeys
//-------------------------------------------------------------------------------

$(document).ready(function(){

// key event 
$('html').keydown(function(e){
    
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
                        alert ('View - '+d.view+' \n Edit - '+d.edit);
                    }
                }
            );
        }
        return false;
    }
});

});