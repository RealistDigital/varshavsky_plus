<?php

/** AJAX получение дирекрории */
if(isset($_GET['dir'])) {
    $file = file("dir.txt");    // Считываем весь файл в массив
    unset($file[0]);            // Удаляем строку
    $fp = fopen("dir.txt", "w");    // Открываем
    fputs($fp, implode("", $file)); // Перезаписываем
    fclose($fp); //Close 
    
    $fopen = fopen("dir.txt", "a"); // Открываем файл в режиме записи 
    $test = fwrite($fopen, $_GET['dir']); // Запись в файл
    fclose($fopen); //Close 
}

/** Загрузка картинки */
if (!empty($_FILES)) {
    
//Config
require_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
//DB
require_once(SYSTEM_PATH.'/config/db.php');

    $file_dir = file("dir.txt"); // Считываем весь файл в массив
    $targetFolder = $file_dir[0] == "" ? '/public/files' : "/".$file_dir[0]; // Определяем директорию 
    
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png', 'JPG', 'JPEG', 'PNG', 'GIF'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
    
	$savePath  = $targetFolder."/".$_FILES['Filedata']['name']; // Для save в БД
    $id_save   = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT); // ID save 
    
	if (in_array($fileParts['extension'], $fileTypes) && is_numeric($id_save)) {
		move_uploaded_file($tempFile, $targetFile);
		
        // Узнаем parent URL
        $sql_select = "SELECT `url` FROM ".TABLE." WHERE `id` = ".$id_save."";
        $res = DB::query($sql_select);
        $row = DB::fetchAssoc($res);
        
        // Вставляем картинку
        $sql_insert = "INSERT INTO ".TABLE." (`img`, `parent`, name_".LANG.", `type_tpl`, `position`) VALUE ('" . substr($savePath, 1) . "', '" . $id_save . "', 'New', '0', '99999')";
        DB::exec($sql_insert); // Add in DB
        
        $last_id = DB::lastInsertId();  // Last ID
        
        // Узнаем шаблон для установки
        $sqlTpl = DB::query("
            SELECT 
                t1.type_tpl,
                t2.id
            FROM 
                ".TABLE."       as t1,
                ".TABLE_TPL."   as t2
            WHERE 
                t1.id = ".$id_save." AND
                t2.parent_id = t1.type_tpl
                
        ");
        while($resTpl = DB::fetchAssoc($sqlTpl)) {
            $dataTpl[] = $resTpl;
        }
        // set template
        if(!empty($dataTpl)) {
            if(count($dataTpl) < 2) {
                $setTpl = ", `type_tpl` = ".$dataTpl[0]['id']."";
            }
        }
        
        // Обновляем параметры
        $sql_update = "UPDATE ".TABLE." SET address = ".$last_id.", url = '".$row['url'].$last_id."/"."' ".$setTpl." WHERE `id` = ".$last_id."";
        DB::exec($sql_update); // Add in DB
	} else {
		echo 'Invalid file type.';
	}
}
?>