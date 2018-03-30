/**
    Разработка  - Ланских Сергей
    Дата        - 12.10.2013
*/

/** Plugin Tool Tips */
(function ($) {
    
    $.fn.toolTips = function (options) {
        // default settings
        var settings = $.extend({
            width       : 300,          // ширина 
            height      : false,        // высота
            padding     : 10,
            left        : 0,
            top         : 0,
            contentBlock: '.toolTipContent',
            bgColor     : '#fff',
            border      : '1px solid #ccc',
            arrow       : false,
            positionArrow : false
        }, options); 
        
        // this obj
        var self = this;
        
        // style Tip
        self.css({
            position : 'relative'
        });
        
        // style content
        if(settings.contentBlock && $(settings.contentBlock)[0]) {
            //-
            self.find(settings.contentBlock).css({
                position    : 'absolute',
                top         : settings.top,
                left        : settings.left,
                padding     : settings.padding,
                display     : 'none',
                'z-index'           : 99999,
                width               : settings.width,
                backgroundColor     : settings.bgColor,
                border              : settings.border 
            });
            
        }
        
        // style close button
        if(settings.contentBlock && $(settings.contentBlock)[0]) {
            self.find(settings.contentBlock).prepend('<span class="tool-tip-close-button">x</>');
        }
        
        // styles arrow
        if(settings.arrow) {
            self.find(settings.contentBlock).prepend('<span class="tool-tip-arrow"></span>');
        }
        
        // events
        self.click(function(){
            // position arrow
            if(settings.left != 0) {
                // position / dinamic or static
                var positionArr = !settings.positionArrow ? -settings.left + parseInt(settings.padding) - 3 : settings.positionArrow; 
                //--
                $(this).find('.tool-tip-arrow').css({
                    left : positionArr
                });
            }

            // show    
            if(!$(this).hasClass('active-tip')) {
                // hide old
                $('span, a, div').removeClass('active-tip');
                $(settings.contentBlock).hide(0);
                // showing
                $(this).addClass('active-tip');
                $(this).find(settings.contentBlock).show(0);
                //--
                return false;
            } else {
                // hide all
                $('span, a, div').removeClass('active-tip');
                $(settings.contentBlock).hide(0);
            }
        }); 
        
        // hide click close button
        $('.tool-tip-close-button').click(function(){
            $(self.selector).removeClass('active-tip');
            $(settings.contentBlock).hide(0);
            //-
            return false;
        });
        
        // stop close for click content block
        $(settings.contentBlock).click(function(){
            return false;
        });
        
        // hide click close button
        /*
        $('body').click(function(){
            if($(self.selector).hasClass('active-tip')) {
                $(self.selector).removeClass('active-tip');
                $(settings.contentBlock).hide(0);
            }
            //-
            return false;
        });
        */

        return self;
    }

})(jQuery);