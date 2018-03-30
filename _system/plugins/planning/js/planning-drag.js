$(document).ready(function(){

//-------------------------------------------------------------------------------
// Координаты маркера квартиры
//-------------------------------------------------------------------------------

// event load page
var position_x = $.isNumeric($('#x-apart-info').val()) ? $('#x-apart-info').val() : false;
var position_y = $.isNumeric($('#y-apart-info').val()) ? $('#y-apart-info').val() : false;

var position_x_2 = $.isNumeric($('#x-apart-info-2').val()) ? $('#x-apart-info-2').val() : false;
var position_y_2 = $.isNumeric($('#y-apart-info-2').val()) ? $('#y-apart-info-2').val() : false;

var position_x_3 = $.isNumeric($('#x-apart-info-3').val()) ? $('#x-apart-info-3').val() : false;
var position_y_3 = $.isNumeric($('#y-apart-info-3').val()) ? $('#y-apart-info-3').val() : false;

_init_coordinates_load ($('.drag-marker'), position_x, position_y);
_init_coordinates_load ($('.drag-marker-2'), position_x_2, position_y_2);
_init_coordinates_load ($('.drag-marker-3'), position_x_3, position_y_3);

// event click
$('.add-coordinates').click(function(e){
    _init_coordinates_drag();
});

// Установка при load page
function _init_coordinates_load(inputObj, x, y) {
    // for load page
    inputObj.css({
        left    : x+"px",
        top     : y+"px"    
    });
}

// Координаты
function _init_coordinates_drag () {
    var imageObject = $('#window-plan-marker img');
    var modalBlock  = $('#window-plan-marker div.modal-block');
    
    // параметры картинки
    var width_modal =  modalBlock.width() == 0 ? imageObject[0].naturalWidth : modalBlock.width();
    var height_modal = modalBlock.height() == 0 ? imageObject[0].naturalHeight : modalBlock.height();
    
    // элементы 
    var input_x = "#x-apart-info";
    var input_y = "#y-apart-info";
    
    var input_x_2 = "#x-apart-info-2";
    var input_y_2 = "#y-apart-info-2";
    
    var input_x_3 = "#x-apart-info-3";
    var input_y_3 = "#y-apart-info-3";
    
    // modal active
    $('#window-plan-marker').modalWindow({
        width   : width_modal,
        height  : height_modal,
        colorBlock : "#e6e6e6"
    });
    
    // блок для перемещения
    $('#container-drag-marker').css({
        width   : width_modal,
        height  : height_modal
    });

    // Drag marker 1
    $(".drag-marker").draggable({ 
        containment:"#container-drag-marker", 
        scroll:false, 
        stop:function(event, ui) {
            // запись в input X
            $(input_x).attr('value', ui.position.left);
            // запись в input Y
            $(input_y).attr('value', ui.position.top);
        } 
    });
    
    // Drag marker 2
    $(".drag-marker-2").draggable({ 
        containment:"#container-drag-marker", 
        scroll:false, 
        stop:function(event, ui) {
            // запись в input X
            $(input_x_2).attr('value', ui.position.left);
            // запись в input Y
            $(input_y_2).attr('value', ui.position.top);
        } 
    });
    
    // Drag marker 3
    $(".drag-marker-3").draggable({ 
        containment:"#container-drag-marker", 
        scroll:false, 
        stop:function(event, ui) {
            // запись в input X
            $(input_x_3).attr('value', ui.position.left);
            // запись в input Y
            $(input_y_3).attr('value', ui.position.top);
        } 
    });
}

});

