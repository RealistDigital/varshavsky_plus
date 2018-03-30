<? 
/*по масиву задается структура базы эт пример ниже
 $base_table = array("name_table1","name_table2","name_table3");
 $base_sql = array(
   "name_table1" => array("id","name_pole1","name_pole2","name_pole3"),
   "name_table2" => array("id","name_pole1","name_pole2","name_pole3","name_pole4","name_pole5","name_pole6"),
   "name_table3" => array("id","name_pole1","name_pole2","name_pole3","name_pole4")
   );
/* */
  $base_table = array("_subscribe");
  $base_sql = array(
   "_subscribe" => array("id","email","name")
  );

 foreach($base_table as $table) {

	$str = '';
	$polya = '';

//генерим запрос по полям
  $i = 0;
	foreach ($base_sql[$table] as $pole){ if($i>0)$polya .= ",".$pole; $i++;}
	
	$query = "SELECT id$polya FROM $table;";
	$res = DB::query($query);


//формируем первую строку из полей таблицы
	$str .= "id";	
	$i = 0;
	foreach ($base_sql[$table] as $pole){ if($i>0)$str .= ";".$pole; $i++;}
	$str .="\n";


//полностью выводим всю таблицу и строим по строкам
	while($to_file = DB::fetchAssoc($res)){
		$i=0;
		foreach($to_file as $k => $v){
			if($i>0) {$str .= ";$v";}
				else { $str .= "$v";} 
			$i++;
		}
		$str .= "\n";
	}

// пишем в файл
	//$str = iconv("Windows-1251", "UTF-8", $str);
	$fp = fopen($_SERVER['DOCUMENT_ROOT']."/public/files/csv/$table.csv",'w+');//dirname(__FILE__)
	fwrite($fp,$str);
	fclose($fp);

 }
?>

<br>
<!-- Описание шаблона -->
<h2 class="h2-style-1"><?=$data_info['decription_tpl']?></h2>
<br>
<div id="wp-content">
    <form name="form" method="POST" action="<?=URL_ADMIN?>save/<?=$url[3]?>/">
        <label>Заголовок</label><br>
        <input class="input-style-2" type="text" name="name_<?=LANG?>" value="<?=$data_info['name_'.LANG]?>"><br><br>
        <label>URL адрес</label><br>
        <input class="input-style-3 check-url" data-check="<?=$data_info['id']?>" type="text" name="address" value="<?=$data_info['address']?>"><br><br>
        <br><br><br><br>
        
        
       
       
       
        
<FORM name=admingu ENCTYPE="multipart/form-data" METHOD=POST>
<input type=hidden name=obnovit value="1">

<table cellpadding=5 width=70%  style='border:1px solid #bfbfbf;'>
  <tr>
    <td class=key>Таблица c email</td>
    <td class=val><a href='/public/files/csv/_subscribe.csv' target="_blank">Загрузить</a></td>
  </tr>
     </table>
</form>
<style>
#wp-content a {
    color: #464646;
    font-size: 14px;
    text-decoration: none;
}
td.key {
    background: none repeat scroll 0 0 #ebebeb;
    padding: 2px 5px;
    vertical-align: top;
    width: 200px;
}
td.val {
    padding: 0 5px;
    vertical-align: top;
    background:white;
}
</style>
        
        
        
        
        <br><br><br><br>
        <a href="#" class="seo-button buttons"><span></span>SEO информация</a>
        <div id="hidden-seo-info">
            <br>
            <h2 class="h2-style-1">Мета информация</h2>
            <br>
            <label>Title</label><br>
            <input type="text" class="input-style-3" name="title_<?=LANG?>" value="<?=$data_info['title_'.LANG]?>">
            <br>
            <label>Meta description</label><br>
            <textarea class="textarea-style-1" name="meta_d_<?=LANG?>"><?=$data_info['meta_d_'.LANG]?></textarea>
            <br>
            <label>Meta keywords</label><br>
            <textarea class="textarea-style-1" name="meta_k_<?=LANG?>"><?=$data_info['meta_k_'.LANG]?></textarea>
        </div>
        <br><br><br>
        <a href="javascript:void(0)" class="save-button buttons"><span></span>Сохранить</a>
        <!-- Для save -->
        <input type="hidden" name="save">
        <br><br>
    </form>
</div>
