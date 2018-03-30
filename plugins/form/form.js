/**
    Разработка  - Ланских Сергей
    Дата        - 07-06-2013
*/

/** Plugin focus / blur fields form && check form field */
(function($){
    // Plugin focus / blur
    $.fn.focusBlur = function(options){
        // this
        var self = this;
        // ID form 
        var id_form = self.attr('id');
        // массив для def. значений полей
        var values_fields = new Array();
        // все inputs && textarea
        var selector = $('#'+id_form+' input[type=text], #'+id_form+' textarea');
        // сканим и default val в массив
        selector.each(function(){
            values_fields[$(this).attr('id')] = $(this).val();
        });
        // Focus event
        selector.focus(function(){
            // ID focus поля
            var id_focus_f = $(this).attr('id');
            //-
            if (values_fields[id_focus_f] == $(this).val()) {
                $(this).attr('value', '');
            }
        });
        // Blur event
        selector.blur(function(){
            // ID focus поля
            var id_blur_f = $(this).attr('id');
            //-
            if ($(this).val() == "") {
                $(this).attr('value', values_fields[id_blur_f]);
            }
        });
        //console.log(values_fields);
        //-
        return self;
    };
    
    // Plugin check form
    
    // counter load plugin 
    var load_chek = 0;
    // массив для def. значений полей
    var values_fields = new Array();
    
    //-
    $.fn.checkForm = function (options) {
        // this
        var self = this;
        // counter errors
        var errors = 0;
        // settings
        var settings = $.extend({
            fields_check    : false,        // object( "id" : 'type' / email, int, string )
            empty_count     : 0,            // мин. количество допустимых символов в поле
            border_good     : 'green',      
            border_bad      : 'red',
            even_form       : false
        }, options);
        
        // сканим только при первом запросе
        if(load_chek == 0){ 
            // ID form 
            var id_form = self.attr('id');
            // все inputs && textarea
            var selector = $('#'+id_form+' input[type=text], #'+id_form+' textarea');
            // сканим и default val в массив
            selector.each(function(){
                values_fields[$(this).attr('id')] = $(this).val();
            });
        }
        
        // перебор полученых полей
        $.each(settings.fields_check, function(id, type){
            switch(type){
                case 'int':
                    
                break;
                case 'string':
                
                break;
                case 'email':
                
                break;
                default:
                    _border_res(id, _empty_field(id));
                break;
            }
        });
        
        console.log(errors);
        
        // Установка результата
        function _border_res (id, flag) { 
            if(flag == false) {
                $('#'+id).css({ 'border' : '1px solid '+settings.border_bad }); 
                errors++;
            } else {
                $('#'+id).css({ 'border' : '1px solid '+settings.border_good }); 
            }
        }

        // проверка на пустору
        function _empty_field (id) {
            // значение поля
            var value_input = $('#'+id).val();
            //-
            console.log(values_fields[id] + " ---- " + value_input);
            if(value_input.length >= settings.empty_count && values_fields[id] != value_input) {
                return true;
            }
            return false;
        }
        
        // Проверка Email на валидность
        function valid_email (email) {
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            return pattern.test(email);
        }
        //-
        load_chek++;
        
        // send form
        if(errors == 0) {
            return true;
        }
        return false;
    };
    
})(jQuery);