$(document).ready(function(){

//-------------------------------------------------------------------------------
// Общием функции сайта
//-------------------------------------------------------------------------------

//Save / отправка формы
$('.save-button').click(function(){
    if ($('input').hasClass('not-valid-url')) {
        $(this).css({
            opacity : 0.7
        });
    } else {
        $('form').submit(); 
    }
});

// Вкл. / Выкл. HotKeys
$('.info-hotkeys').toggle(function(){
    $('#block-hotkeys').slideDown();
}, function(){
    $('#block-hotkeys').slideUp();
});

//Открыть / закрыть доп. информацию 
$('.open-more-info').toggle(function(){
    $('.hidden-more-info').show();
},function(){
    $('.hidden-more-info').hide();
}); 

//Блокирование шаблона
$('.block-tpl').toggle(function(){
    var tpl = $(this).data('tpl');
    //Открываем
    $('.bg-select-disable-'+tpl+'').hide();
}, function(){
    var tpl = $(this).data('tpl');
    //Блокируем
    $('.bg-select-disable-'+tpl+'').show();
});

//Дата 
$( ".date" ).datepicker({ dateFormat: "dd.mm.yy" });

//-------------------------------------------------------------------------------
// Ошибка удаления Категории / Шаблона
//-------------------------------------------------------------------------------

if (location.hash == "#warning-del-cat") {
    alert("В даной категории есть вложеные категории! Удалите вложеные категории!");
}

//Предупреждение при удалении записи
$('a.delete').click(function(e){
    if(!confirm('Вы действительно хотите удалить эту запись?')){
        e.preventDefault();    
    }
});

//-------------------------------------------------------------------------------
// Сортировка list контента
//-------------------------------------------------------------------------------
$('#tb-content').tableDnD({
    onDragClass: 'drag-sort',
    dragHandle: ".drag"
});  

//-----------------------------------------------------------------------------
// Настройка страницы Width / Height
//-----------------------------------------------------------------------------   

function _height_window () {
    //При старте ставим Height 
    if($('#main-wp').height() < ($(window).height()-20)){
        $('#main-table').css({ 'height': $(window).height()-50+"px"});
    }
    //При старте ставим Width
    $('#main-wp').width($('#main-table').width());
}
_height_window ();

// resize ...
$(window).resize(function(){
    _height_window ();
    if($('#main-wp').width() < $(window).width()) {
        $('#main-wp').width($('#main-table').width() + ($(window).width() - $('#main-wp').width())-40);
    }
});

//-----------------------------------------------------------------------------
// Breadcrumbs 
//-----------------------------------------------------------------------------

$('#breadcrumbs').width($('#breadcrumbs').width()); //ширину блоку
var wp_bread_width = 0;
$('#breadcrumbs ul li').each(function(){ //узнаем всю ширину <ul> 
    wp_bread_width += $(this).width();
});
$('#breadcrumbs ul').width(wp_bread_width); //присваиваем ширину <ul>
if(wp_bread_width > $('#breadcrumbs').width()){ //если ul > wp-bread то делаем отптекание навигации  
    $('#breadcrumbs ul').css({'left':'-'+(wp_bread_width-$('#breadcrumbs').width())+'px'}); //оптекание 
    $('#scroll-bread').show(); //scroll bread show  
}

/** Scroll breadcrumbs **/

//Prev End
$('#scroll-bread .prev-end').click(function(){ 
    $('#breadcrumbs ul').css({'left':0});
    $('#scroll-bread .next-end, #scroll-bread .next').show();
    $('#scroll-bread .prev-end, #scroll-bread .prev').hide();
});

//Prev
$('#scroll-bread .prev').click(function(){ 
    $('#breadcrumbs ul').animate({ 'left':0 }, 1200, function(){
        $('#scroll-bread .next-end, #scroll-bread .next').show();
        $('#scroll-bread .prev-end, #scroll-bread .prev').hide();
    });
});

//Next End
$('#scroll-bread .next-end').click(function(){
    $('#breadcrumbs ul').css({'left':'-'+(wp_bread_width-$('#breadcrumbs').width())+'px'});
    $('#scroll-bread .prev-end, #scroll-bread .prev').show();
    $('#scroll-bread .next-end, #scroll-bread .next').hide();
});

//Next
$('#scroll-bread .next').click(function(){ 
    $('#breadcrumbs ul').animate({ 'left':'-'+(wp_bread_width-$('#breadcrumbs').width())+'px' }, 1200, function(){
        $('#scroll-bread .prev-end, #scroll-bread .prev').show();
        $('#scroll-bread .next-end, #scroll-bread .next').hide();
    });
});

//-----------------------------------------------------------------------------
// Доп. инфа / SEO инфа / show - hide
//-----------------------------------------------------------------------------

//Доп. инфа
$('.dop-button').toggle(function(){
    $('#hidden-dop-info').show();
}, function(){
    $('#hidden-dop-info').hide();
});

//SEO
$('.seo-button').toggle(function(){
    $('#hidden-seo-info').show();
}, function(){
    $('#hidden-seo-info').hide();
});

//-----------------------------------------------------------------------------
// Tabs - Права пользователя
//-----------------------------------------------------------------------------

$('.menu-tabs').click(function(){
    $('.menu-tabs').removeClass('active-tab');
    $(this).addClass('active-tab');
    var current_tab = $(this).data('tab'); 
    $('.tabs-content').hide();
    $('#tab-'+current_tab).show();   
});

//-----------------------------------------------------------------------------
// Вкл. / Выкл online редактора
//-----------------------------------------------------------------------------

$('.online-editor').click(function(){
    $.getJSON(
        '/_system/ajax/online_editor.php',
        {
            status  : 1
        }, function(data) {
            //Вкл.
            if(data['res'] == 1) {
                alert(' - Online редактор " Включен " - ');
                $('.online-editor').text("Выкл. Online редактор");
            //Выкл.
            } else {
                alert(' - Online редактор " Выключен " - ');
                $('.online-editor').text("Online редактор");
            }
        }
    );
});

//-----------------------------------------------------------------------------
// Постраничка в админке
//-----------------------------------------------------------------------------

var _counter_pages      = 0;  // счетчик элементов
var _cunt_page_to_admin = $('.pagination-list').data('count-elem');  // сколько элементов на стр.
var _pagination_id      = '#tb-content';
var _pagination_wp      = '.pagination-list';

// го
if ($(_pagination_wp).length > 0) {
    _init_pagination (); // установка links
    _pagination (); // run pagination
}

// запуск постранички
function _pagination (curr_page) {
    var count_elem = $(_pagination_id+' tr.page-js').size(); // кол. всех элементов для pagination
    // если нет указаной страницы то ставим первую
    if (!location.hash && !curr_page) {
        page = 1;
    } else {
        page = !curr_page ? location.hash.substr(1) : curr_page;
    }
    // сколько страниц - округляем в большую строну
    pages_all = Math.ceil(count_elem / _cunt_page_to_admin);
    // до какой отображать
    end_view = page * _cunt_page_to_admin;
    // от какой отображать
    start_view = end_view - _cunt_page_to_admin;
    // скрыть все 
    $(_pagination_id+' tr.page-js').hide();
    // отображение контента
    $(_pagination_id+' tr.page-js').each(function(){
        _counter_pages++;
        if(_counter_pages > start_view && _counter_pages <= end_view) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
    _counter_pages = 0;
}

// установка панели pagination 
function _init_pagination () {
    // тут написать подсчет навигации ... 
    var count_elem = $(_pagination_id+' tr.page-js').size(); // кол. всех элементов для pagination
    // сколько страниц показывать в постраничке
    pages_all = Math.ceil(count_elem / _cunt_page_to_admin);
    // составляем ...
    for (i=1; i<=pages_all; i++) {
        if(i == 1 && !location.hash) {
            $(_pagination_wp).append('<a href="#'+i+'" class="curr_page_ad" data-page="'+i+'">'+i+'</a>');
        } else if(location.hash) {
            page = location.hash.substr(1);
            if(page == i) {
                $(_pagination_wp).append('<a href="#'+i+'" class="curr_page_ad" data-page="'+i+'">'+i+'</a>');
            } else {
                $(_pagination_wp).append('<a href="#'+i+'" data-page="'+i+'">'+i+'</a>');
            }
        } else {
            $(_pagination_wp).append('<a href="#'+i+'" data-page="'+i+'">'+i+'</a>');
        }
    }
}

// переключение
$('.pagination-list a').live('click', function(){
    $('.pagination-list a').removeClass('curr_page_ad');
    $(this).addClass('curr_page_ad');
    _pagination($(this).data('page'));
});

//-----------------------------------------------------------------------------
// Сортировка заказов магазина
//-----------------------------------------------------------------------------

$('#sort-orders').change(function(){
    $(this).submit();
});

//-----------------------------------------------------------------------------
// Проверка Валидности && существования URL 
//-----------------------------------------------------------------------------

$("input.check-url").change(function(){
    if(checkUrl($(this).val())) {
        var idField     = parseInt($(this).data('check'));
        var urlField    = $(this).val();
        var self        = $(this);
        // checking ..
        if (idField != "" && urlField != "") {
            $.getJSON(
                '/ru/admin/check-url/',
                {
                    id_field  : idField,
                    url_field : urlField 
                }, function (d) {
                    if(d.check == 1) {
                        self.removeClass('not-valid-url');
                    } else {
                        self.addClass('not-valid-url');
                    }
                }
            );
        } else {
            $(this).addClass('not-valid-url');
        }
    } else {
        $(this).addClass('not-valid-url');
    }
});

// Проверка URL рег.
function checkUrl(url) {
    var pattern = new RegExp(/^([a-z0-9-_])+$/);
    return pattern.test(url);
}

//-----------------------------------------------------------------------------
// Дополнительные возможности 
//-----------------------------------------------------------------------------

var formCopyLang    = $('#form-copy-lang');
var formCopyContent = $('#form-copy-content');

$('#save-copy-lang').click(function(){
    formCopyLang.submit();
});
$('#save-copy-content').click(function(){
    formCopyContent.submit();
});


});

