<link href="<?=SYS_PLUGINS?>uploader_images/uploadify.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=SYS_PLUGINS?>uploader_images/jquery.uploadify-3.1.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#file_upload").uploadify({
            height        : 23,
            width         : 120,
            buttonText    : 'Выбрать файлы',
            swf           : '<?=SYS_PLUGINS?>uploader_images/uploadify.swf',
            uploader      : '<?=SYS_PLUGINS?>uploader_images/uploadify.php',
            fileSizeLimit : '8MB',
            
            formData      : {
                id : <?=$data_info['id']?>
            },
            onQueueComplete : function () {
                location.reload();
            }
        });
    });
</script>

<?php

$dir = 'public/files';
/** Дерево директорий */
function showTree($folder, $space) {
    // Получаем полный список файлов и каталогов внутри $folder 
    $files = scandir($folder);
    foreach($files as $file) {
        // Отбрасываем текущий и родительский каталог 
        if (($file == '.') || ($file == '..')) continue;
        $f0 = $folder.'/'.$file;  //Получаем полный путь к файлу
        // Если это директория 
        if (is_dir($f0)) {
            if($file != "_thumb" && $file != "_mini") {
                // Выводим, делая заданный отступ, название директории
                echo "<option value='".$f0."'>".$space.$file."</option>";
                // С помощью рекурсии выводим содержимое полученной директории
                showTree($f0, $space.' - ');
            }
        }
    }
}
?>