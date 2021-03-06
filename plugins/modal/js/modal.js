/**
    Разработка  - Ланских Сергей
    Дата        - 30-05-2013
*/

/** Plugin modal window */
(function ($) {
    
    $.fn.modalWindow = function (options) {
        // default settings
        var settings = $.extend({
            close       : false,        // event на закрытие окна
            width       : 300,          // ширина 
            height      : 300,          // высота
            colorBg     : '0,0,0',      // bg color RGB - format
            colorBlock  : '#fff',       // bg блока 
            shadowWp    : true,         // тень
            shadowColor : "#333",       // bg тени    
            opacity     : 0.5,          // прозрачность фона
            blockModal  : '.modal-block',   // class окна 
            closeClass  : 'cloce-modal-window'  // class кнопки закрыть
        }, options); 
        
        // this obj
        var self = this;
        
        // close
        if(settings.close) {
            self.hide();
            $('.'+settings.closeClass).remove();
            return self;
        } 
        // показываем окно
        self.show();
        
        // делаем фон
        self.css({
            width   : $(window).width(),
            height  : $(document).height(),
            backgroundColor:    'rgba('+settings.colorBg+','+settings.opacity+')'
        });
        // absolute / fixed
        var top_position    = $(window).height() > settings.height ? ($(window).height() / 2) - ( settings.height / 2) : 50;
        var type_position   = $(window).height() < settings.height ? 'absolute' : 'fixed';
        // формируем блок
        self.find(settings.blockModal).css({
            position    : type_position,
            width   : settings.width,
            height  : settings.height,
            top     : top_position,
            left    : ($(window).width() / 2) - ( settings.width / 2),
            backgroundColor : settings.colorBlock,
            boxShadow   : settings.shadowWp ? settings.shadowColor+" 0px 0px 4px 1px" : ""      
        });
        
        // Кнопка Close
        self.find(settings.blockModal).prepend('<a href="javascript:void(0)" class="'+settings.closeClass+'">Х</a>');
        
        // закрытие окна
        self.find('.'+settings.closeClass).live('click', function(){
            self.hide();
            $(this).remove();
        });
        
        return self;
    }

})(jQuery);