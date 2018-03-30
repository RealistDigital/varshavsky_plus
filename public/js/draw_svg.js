/** Draws SVG for houses */
(function ($) {

    // Calls methods
    $.fn.drawSvg = function (method) {
        // Call method, default init
        if ( methods[method] ) {
            return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            alert('not isset method - '+method);
        }
    };

    // Global vars
    var raphael = new Array();;
    var lines   = new Array();
    var idLine  = 0;

    var methods = {
        init : function (params) {
            var initParams = $.extend({
                wrapInitName    : null,
                linesName       : 'line1',
                raphaelName     : 'raphael1',
                wpDrawSvg       : 'svggroup1',
                widthScale      : null,
                heightScale     : null
            }, params);

            // init Raphael
            var raphaelScale = new ScaleRaphael(initParams.wrapInitName, initParams.widthScale, initParams.heightScale, initParams.wpDrawSvg);
            raphael.push(initParams.raphaelName);
            raphael[initParams.raphaelName] = raphaelScale;

            // init params
            lines.push(initParams.linesName);
            lines[initParams.linesName] = new Array();
        },

        // Drawing ...
        draw : function ( params ) {
            //idLine++;
            // params
            var drawParams = $.extend({
            	path            : null,
                stroke          : '#007fc7',
                strokeWidth     : 0,
                fill            : '#1c252c',
                fillOpacity     : 0.7,
                opacity         : 0,
                linejoin        : 'round',
                href            : false,
                idLine 			: 0,
                houseState      : 0
            }, params);

            if(drawParams.path == undefined) return false;

            // Lines drawing
            lines[drawParams.linesName][drawParams.idLine] = raphael[drawParams.raphaelName].path(drawParams.path);
            lines[drawParams.linesName][drawParams.idLine].attr('stroke',        drawParams.stroke);
            lines[drawParams.linesName][drawParams.idLine].attr('stroke-width',  drawParams.strokeWidth);
            lines[drawParams.linesName][drawParams.idLine].attr('fill',          drawParams.fill);
            lines[drawParams.linesName][drawParams.idLine].attr('fill-opacity',  drawParams.fillOpacity);
            lines[drawParams.linesName][drawParams.idLine].attr('opacity',       drawParams.opacity);
            lines[drawParams.linesName][drawParams.idLine].attr('linejoin',      drawParams.linejoin);
            lines[drawParams.linesName][drawParams.idLine].attr('font',          drawParams.idLine);
            lines[drawParams.linesName][drawParams.idLine].attr('font-style',    drawParams.houseState);

            if (drawParams.href) {
                lines[drawParams.linesName][drawParams.idLine].attr('href', drawParams.href);
            }


            // Hover SVG
            var svgPath = $('svg a path');
            svgPath.unbind('mouseover');
            svgPath.unbind('mouseout');

            svgPath.bind('mouseover', function(){
                var lineId = $(this).attr('font');
                var houseStateId = $(this).attr('font-style');

				//Если статус дома по умолчанию (0)т.е. не продан, то событие на ховер
				if (houseStateId == 0){
                    $('.markerSVG[font='+lineId+']').show();
					$('#marker_'+lineId).addClass('here');
                    $('#svggroup1 svg a path[font ='+lineId+']').stop().animate({opacity : 1 }, 400);
					$('#svggroup2 svg a path[font ='+lineId+']').stop().animate({opacity : 1 },300);
                }
            });

            svgPath.bind('mouseout', function () {
                var lineId = $(this).attr('font');
                var houseStateId = $(this).attr('font-style');

                //Если статус дома по умолчанию (0)т.е. не продан, то событие на ховер
                if (houseStateId == 0){
                    $('.markerSVG[font='+lineId+']').hide();
					$('#marker_'+lineId).removeClass('here');
                    $('#svggroup1 svg a path[font ='+lineId+']').stop().animate({ opacity : 0 }, 400);
                    $('#svggroup2 svg a path[font ='+lineId+']').stop().animate({ opacity : 0 },300);
                }
            });

            // Hover Marker
			$('.markerSVG').unbind('mouseover');
            $('.markerSVG').unbind('mouseout');

            $('.markerSVG').bind('mouseover', function () {
                var lineId = $(this).attr('font');
                $('.markerSVG[font='+lineId+']').show();
				$('#marker_'+lineId).addClass('here');
                $('svg a path[font ='+lineId+']').stop().animate({ opacity : 1 }, 300);
            });

			$('.markerSVG').bind('mouseout',function(){
                var lineId = $(this).attr('font');
                $('.markerSVG[font='+lineId+']').hide();
				$('#marker_'+lineId).removeClass('here');
                $('svg a path[font ='+lineId+']').stop().animate({ opacity : 0 }, 300);
            });
        },

        resize : function (params) { // Resize

            var resizeParams = $.extend({
                raphaelName     : 'raphael1',
                imgWidth        : null,
                imgHeight       : null
            }, params);

            // resizing svg
            raphael[resizeParams.raphaelName].changeSize(resizeParams.imgWidth, resizeParams.imgHeight, true, false);

        }
    };
}) (jQuery);

