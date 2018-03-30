//-----------------------------------------------------------------------------
// Полная версия
//-----------------------------------------------------------------------------
tinyMCE.init({
    // General options
    mode : "textareas",
    theme : "advanced",
    /* Мои настройки */
    mode : "specific_textareas",
    editor_selector : "mceFull",
    element_format : "html",
    theme_advanced_font_sizes : "10px,11px,12px,13px,14px,15px,16px,18px,22px,24px",
    relative_urls : false,
    force_br_newlines : true,
    force_p_newlines : false,
    forced_root_block : '',
    /* / Мои настройки */
    
    plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",

    // Theme options
    theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,|,image,insertimage,insertfile,|,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
    theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resizing : true,

    // Skin options
    skin : "o2k7",
    skin_variant : "silver",
    language : "ru",
    
    // Таблица стилей сайта
    content_css : "/public/css/style.css"
});
//-----------------------------------------------------------------------------
// Полная версия / с доработкой / сокращена
//-----------------------------------------------------------------------------
tinyMCE.init({
    // General options
    mode : "textareas",
    theme : "advanced",
    /* Мои настройки */
    mode : "specific_textareas",
    editor_selector : "mceFullSimple",
    element_format : "html",
    theme_advanced_font_sizes : "10px,11px,12px,13px,14px,15px,16px,18px,22px,24px",
    relative_urls : false,
    force_br_newlines : true,
    force_p_newlines : false,
    forced_root_block : '',
    /* / Мои настройки */
    
    plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",

    // Theme options
    theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,undo,redo,|,link,unlink,anchor,|,image,insertimage,insertfile,|,code,|,forecolor,backcolor",
    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,fullscreen",
    
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resizing : true,

    // Skin options
    skin : "o2k7",
    skin_variant : "silver",
    language : "ru",
    
    // Таблица стилей сайта
    content_css : "/public/css/style.css"
});
//-----------------------------------------------------------------------------
// Сокращенная версия
//-----------------------------------------------------------------------------
tinyMCE.init({
	mode : "textareas",
	theme : "simple",
    editor_selector : "mceSimple",
    skin_variant : "silver",
    language : "ru"
});