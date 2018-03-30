<?php
//-----------------------------------------------------------------------------
// Lib - Работа с картинками
//-----------------------------------------------------------------------------

Class Lib_img {

/** Превью картинки
 * @img     - путь картинки
 * @width   - ширина 
 * @height  - высота
 * @fn      - подпись к превью
 * @folder  - папка для mini img
*/
public static function getPreview ($img, $width=100, $height=70, $fn="_mini", $folder="_mini"){
    // старый путь
    $olddest    = str_replace("\\","/", URL_ROOT).str_replace("///","/",$img);
    // делим путь на части
    $arr_parts_img  = explode('/', $img);
    $count_parts    = count($arr_parts_img);
    // имя картинки
    $name_img       = $arr_parts_img[$count_parts-1];
    // удаляем имя с массива
    unset($arr_parts_img[$count_parts-1]);
    // новый путь
    $new_path       = implode('/', $arr_parts_img);
    $new_path       = $new_path.'/'.$folder;
    // проверка директории
    if(!is_dir($new_path)) {
        // создаем директорию
        mkdir(URL_ROOT.$new_path);
    } 
    // обрезаем формат файла
    $new_name   = str_replace(array("///",".jpg",".jpeg",".gif",".png"),array("/","","","",""),$new_path.'/'.$name_img);
    
    //Узнаем формат картинки
    if(strstr($img,"jpg")) { 
        $new_name.=$fn.".jpg"; 
    } elseif(strstr($img,"jpeg")) {
        $new_name.=$fn.".jpeg"; 
    } elseif(strstr($img,"gif")) {
        $new_name.=$fn.".gif"; 
    } elseif(strstr($img,"png")) {
        $new_name.=$fn.".png"; 
    }
    // новый путь
    $newdest=str_replace("\\","/", URL_ROOT).$new_name;
    // если нет файла то делаем Preview
    if(!is_file($newdest)) {
        Lib_img::resize_then_crop ($olddest, $newdest, $width, $height, 255, 255, 255);
    }
    return $new_name;
}

// Crop img
protected static function resize_then_crop($filein, $fileout, $imagethumbsize_w, $imagethumbsize_h, $red, $green, $blue) {

    // Get new dimensions
    list($width, $height) = getimagesize($filein);
    
    $new_width = $width * $percent;
    $new_height = $height * $percent;

    //JPEG
    if(preg_match("/.jpg/i", "$filein")) {
      $format = 'image/jpeg';
    }
    //JPEG
    if(preg_match("/.jpeg/i", "$filein")) {
      $format = 'image/jpeg';
    }
    //GIF
    if (preg_match("/.gif/i", "$filein")) {
      $format = 'image/gif';
    }
    //PNG
    if(preg_match("/.png/i", "$filein")) {
      $format = 'image/png';
    }
  
    switch($format) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($filein); //JPEG
        break;
        case 'image/gif';
            $image = imagecreatefromgif($filein); //GIF
        break;
        case 'image/png':
            $image = imagecreatefrompng($filein); //PNG
        break;
    }
    
    $width = $imagethumbsize_w;
    $height = $imagethumbsize_h;
    
    list($width_orig, $height_orig) = getimagesize($filein);
    
    if ($width_orig < $height_orig) {
        $height = ($imagethumbsize_w / $width_orig) * $height_orig;
    } else {
       $width = ($imagethumbsize_h / $height_orig) * $width_orig;
    }
    
    //if the width is smaller than supplied thumbnail size
    if ($width < $imagethumbsize_w) {
        $width = $imagethumbsize_w;
        $height = ($imagethumbsize_w/ $width_orig) * $height_orig;;
    }
    
    //if the height is smaller than supplied thumbnail size 
    if ($height < $imagethumbsize_h) {
        $height = $imagethumbsize_h;
        $width = ($imagethumbsize_h / $height_orig) * $width_orig;
    }
    
    $thumb = imagecreatetruecolor($width , $height);  
    $bgcolor = imagecolorallocate($thumb, $red, $green, $blue);   
    
    ImageFilledRectangle($thumb, 0, 0, $width, $height, $bgcolor);
    imagealphablending($thumb, true);
    imagecopyresampled($thumb, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
    
    $thumb2 = imagecreatetruecolor($imagethumbsize_w , $imagethumbsize_h);
    
    // true color for best quality
    $bgcolor = imagecolorallocate($thumb2, $red, $green, $blue);   
    ImageFilledRectangle($thumb2, 0, 0,
    $imagethumbsize_w , $imagethumbsize_h , $white);
    imagealphablending($thumb2, true);
    $w1 =($width/2) - ($imagethumbsize_w/2);
    $h1 = ($height/2) - ($imagethumbsize_h/2);
    imagecopyresampled($thumb2, $thumb, 0,0, $w1, $h1,
    $imagethumbsize_w , $imagethumbsize_h ,$imagethumbsize_w, $imagethumbsize_h);
    // Output
    //header('Content-type: image/gif');
    //imagegif($thumb); //output to browser first image when testing
    if ($fileout !="")imagejpeg($thumb2, $fileout); //write to file
    //header('Content-type: image/gif');
    //imagegif($thumb2); //output to browser
}


}
?>