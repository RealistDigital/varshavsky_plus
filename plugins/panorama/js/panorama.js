/**
    Разработка  - Ланских Сергей
    Дата        - 23-09-2013
*/

/** Panorama 360 */
(function($){
    // call ...
    $.fn.panorama360 = function (method) {
        // Call method, default init
        if ( methods[method] ) {
            return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Метод с именем ' +  method + ' не существует!' );
        } 
    };
    
    // Globals
    var settings;
    var countFrames;
    var cooeficientFrame;
    
    var startFrame = 0;
    var oldFrame = 0;
    var countMoves = 0;
    
    // Debug
    var debug       = '#debug';
    
    // Methods 
    var methods = {
        // init - default
        init : function( options ) { 
            
            // Extends
            settings = $.extend({
                width   : 300,
                height  : 300,
                auto        : false,                // Auto panorama
                autoTime    : 3000,                 // Auto - время остановки 
                autoDelay   : 1000,                 // Auto - задержка старта
                
                frames  : null,                             // Массив картинок 
                speedFrames : 5,                            // Скорость ( коефициент )
                edgeObject  : new Array(1, 17, 34, 53),     // Грани объекта
                containerPreloader  : '#preloader',         // Конт. прелоадера
                containerOldFrame   : '#old-frame',         // Конт. для подложки предедущего кадра 
                moveBlock : null
                
            }, options);
            
            // Private
            settings.containerPanorame  = this;
            
            var self = this;
            
            // Styles 
            self.css({
                width   : settings.width,
                height  : settings.height
            }); 
            
            self.attr('unselectable', 'on')
                 .css({
                    "-moz-user-select": "none",
                    "-khtml-user-select": "none",
                    "-webkit-user-select": "none",
                    "user-select": 'none'
                 })
                 .on('selectstart', false);
            
            // Preloader
            methods.preloader (settings.frames);
                      
            // init first frame
            if (settings.frames != null) {
                self.css({
                    backgroundImage  : 'url('+settings.frames[0]+')',
                    backgroundRepeat : 'no-repeat',
                    cursor           : 'move'   
                }).hide();
                
                $(settings.moveBlock).css({
                    cursor           : 'move'   
                });
                
                // All frames
                countFrames         = settings.frames.length;
                cooeficientFrame    = self.width() / countFrames; 
                
                // call move
                methods.mouseMove();
            }
        },
        
        preloader : function ( images ) {    
            var counterImages = 0;
            // loading img for BG
            for (var i=0; i < images.length; i++) {
                var frame =  new Image();
                frame.src = images[i];
                
                // loading frames ...
                frame.onload = function () {
                    counterImages++;
                    if(counterImages === countFrames) {
                        $(settings.containerPreloader).hide();
                        settings.containerPanorame.show();
                        // Auto
                        if(settings.auto) {
                            methods.auto();
                        }
                    }
                }; 
            }
        },
        
        // mouse coordinates
        mouseMove : function() {
            var eventMouse  = true; 
            // mouse down
            $(settings.moveBlock).unbind('mousedown'); // clear event
            $(settings.moveBlock).mousedown(function(eventDown){
                var costForDirection = 0;
                eventMouse = true;
                
                // check mouse up
                $(settings.moveBlock).unbind('mouseup');
                $(settings.moveBlock).mouseup(function(){
                    eventMouse = false; // up mouse (
                    // set Frame
                    methods.setFrame();
                });
                
                // check click left
                if (eventDown.which != 1) {
                    eventMouse = false; // not left key (
                }
                
                // mouse moving
                $(settings.moveBlock).unbind('mousemove'); // clear event
                $(settings.moveBlock).mousemove(function(eventMove){
                    // if mouse key LETF and Key Down
                    if(eventMouse) {
                        var x = eventMove.pageX - settings.containerPanorame.offset().left;
                        var y = eventMove.pageY - settings.containerPanorame.offset().top;
                        // cheking coordinates
                        if ((x > 0 && y > 0) && (x < settings.containerPanorame.width() && y < settings.containerPanorame.height())) {
                            // direction
                            var direction;
                            //-
                            if(x > costForDirection) {
                                direction = 'right';
                            } else {
                                direction = 'left';
                            }
                            costForDirection = x;
                            
                            //-
                            methods.panorama( direction );
                        }
                    }
                
                });
            });
        },
        //
        panorama : function ( direction ) {
            // method append start
            methods.start();
            
            countMoves++;
            if(countMoves >= (cooeficientFrame / settings.speedFrames) ) { 
                // direction panoram
                if(direction == 'left') {
                    oldFrame = startFrame;
                    startFrame++;
                    if (startFrame >= countFrames) { startFrame = 0; }
                } else if (direction == 'right') {
                    oldFrame = startFrame;
                    startFrame--;
                    if (startFrame <= 0) { startFrame = countFrames - 1; }
                }
                //-
                countMoves = 0;
                // set BG 
                $(settings.containerOldFrame).css({ backgroundImage : 'url('+settings.frames[oldFrame]+')' });
                settings.containerPanorame.css({ backgroundImage : 'url('+settings.frames[startFrame]+')' });
            }
            
            // degug
            if($(debug)[0]) {
                $(debug).text('Frame - '+startFrame+' direction - '+direction);
            }
        },
        
        // Auto Panorama
        auto : function () {
            // Time Delay
            setTimeout(function(){
                // run auto
                var time = 0;
                var intevalFrame = setInterval(function (){
                    methods.panorama('left');
                    time += 20;
                    
                    // stop time
                    if( time >= settings.autoTime ) {
                        clearInterval(intevalFrame);
                        settings.finish(1); // First frame
                    }
                }, 20);
                
                // delete inteval
                $(settings.moveBlock).click(function(){
                    clearInterval(intevalFrame);
                });
            }, settings.autoDelay);   
        },
        
        //  Set Frame animate
        setFrame : function () {
            var constMin = Math.abs(settings.edgeObject[0] - startFrame);
            var setFrame = settings.edgeObject[0];
            
            // Узнаем к которому установленому кадру ближе тукущий кадр
            for ( var i=0; i < settings.edgeObject.length; i++ ) {
               if(Math.abs(settings.edgeObject[i] - startFrame) < constMin) {
                   constMin = Math.abs(settings.edgeObject[i] - startFrame);
                   setFrame = settings.edgeObject[i];
               }
            }
    
            // Устанавливаем ближний кадр
            var direction;
            var countInterval = startFrame - setFrame < 0 ? direction = 'left' : direction = 'right';
            var lengsForFrame = Math.abs(startFrame - setFrame) * 2;
            var counterInter = 0;
            
            var intervalSetFrame = setInterval(function(){
                if(lengsForFrame <= 0) {
                    // получаем номер грани объекта
                    var returnKey;
                    for (u in settings.edgeObject) {
                        if(settings.edgeObject[u] == setFrame) {
                            returnKey = parseInt(u) + 1;
                        }
                    }
                    // on complete
                    methods.finish( returnKey );
                    clearInterval(intervalSetFrame);
                } else {
                    methods.panorama(direction);
                }
                lengsForFrame--;
            }, 20);
        },
        // append start
        start : function () {
            settings.start();
        },
        // on complete
        finish : function ( key ) {
             settings.finish( key );
        }
    };
    
    
    
})(jQuery);