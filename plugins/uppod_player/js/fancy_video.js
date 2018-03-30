$(document).ready(function(){

// Простой видео плеер  
$('.fancy-video').fancybox();

// Youtube плеер
$('.fancy-youtube-video').click(function(){	
    $.fancybox({
		'padding'		: 0,
		'autoScale'		: false,
		'transitionIn'	: 'none',
		'transitionOut'	: 'none',
		'title'			: this.title,
		'width'		: 680,
		'height'		: 495,
		'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
		'type'			: 'swf',
		'swf'			: {
		   	 'wmode'		: 'transparent',
			'allowfullscreen'	: 'true'
		}
	});
    return false;	
});


});