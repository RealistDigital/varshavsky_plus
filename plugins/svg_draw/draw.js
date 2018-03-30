/**
    Разработка  - Ланских Сергей
    Дата        - 07-06-2013
*/

/** Plugin SVG Raphael Draw */
(function($){
    var counter = 0;
    $.fn.svgDraw = function (options) {
        
        // settings
        var settings = $.extend({
            canvas          : "raphael-holder",
            width_canvas    : 500,
            height_canvas   : 500,
            path_svg        : "M139 283 L224 333 L188 371 L199 422 L121 368 L103 317 Z", // тестовый путь
            fill            : "#4b8703",    // color BG || IMG 'url(/public/img/сheap-apart.png)
            fill_opacity    : 0.4,          // opacity BG
            opacity         : 1,            // opacity general
            stroke          : '#4b8703',    // border color
            stroke_width    : 4,            // border width    
            line            : 1,            // line для отрисовки
        }, options);   
        
        
        // this obj
        var self = this;
        // Холст для отрисовки
        //var canvas = self.attr('id');      
        
        // SVG part 
        var raphael = Raphael(settings.canvas, settings.width_canvas, settings.height_canvas);
        var lines = new Array();
        
        // settings svg 
        lines[settings.line] = raphael.path(settings.path_svg);             // Путь отрисовки 
        lines[settings.line].attr('fill',           settings.fill);         // color BG || IMG 'url(/public/img/сheap-apart.png)
        lines[settings.line].attr('fill-opacity',   settings.fill_opacity); // opacity BG
        lines[settings.line].attr('opacity',        settings.opacity);      // opacity general
        lines[settings.line].attr('stroke',         settings.stroke);       // border color
        lines[settings.line].attr('stroke-width',   settings.stroke_width); // border width    
        
        counter++;
        /*
        // Cheap
        lines['35'] = raphael.path('M370 17 L508 17 L509 38 L544 38 L545 166 L522 166 L522 219 L370 220 Z');
        lines['35'].attr('fill','url(/public/img/сheap-apart.png)'); // img
        lines['35'].attr('fill-opacity',0.5);
        lines['35'].attr('opacity',1);   
        lines['35'].attr('stroke','#4b8703');
        lines['35'].attr('stroke-width',4);   
        */ 
    }
    
})(jQuery);