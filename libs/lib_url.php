<?php
//-----------------------------------------------------------------------------
// Функ. работы с URL адресами
//-----------------------------------------------------------------------------
Class Lib_url {
    
//-----------------------------------------------------------------------------
// Переобразование URL
//-----------------------------------------------------------------------------
public static function getUrl () {
    $url = !isset($_GET['url'])? 'index': $_GET['url'];
    $url = rtrim($url, '/');
    $url = explode('/', $url);
    return $url;
}

//-----------------------------------------------------------------------------
// Переадресация PHP
//-----------------------------------------------------------------------------
public static function redirect($uri = '', $method = 'location', $http_response_code = 301) {
	switch($method) {
		case 'refresh'	: 
            header("Refresh:0;url=".$uri);
		break;
		
        default			: 
            header("Location: ".$uri, TRUE, $http_response_code);
		break;
	}
	exit;
}
//-----------------------------------------------------------------------------
// Переадресация HTML
//-----------------------------------------------------------------------------
public static function redirect_html($url, $refresh=false) { 
    if($refresh) {
        echo '<meta http-equiv="refresh" content="0; url="">';
        exit;
    }
    echo '<meta http-equiv="refresh" content="0; url='.$url.'">';
	exit;
}

//-----------------------------------------------------------------------------
// Текущее меню админки
//-----------------------------------------------------------------------------
public static function current_admin_menu ($url_menu, $first_menu=false) {
    $url = Lib_url::getUrl();
    if($first_menu) {
        $current = $url[2] == "" || $url[2] == $url_menu ? 'class="current-menu"' : NULL; 
    } else {
        $current = $url[2] == $url_menu ? 'class="current-menu"' : NULL; 
    }
    return $current;
}

}
?>