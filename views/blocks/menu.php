<?
	$query = "SELECT * FROM _main WHERE parent='0' AND visible_".LANG."='yes' ORDER BY position LIMIT 100";
	$res = DB::query($query);
	while($m = DB::fetchAssoc($res)){
		
		$query = "SELECT * FROM _main WHERE parent='".$m['id']."' AND visible_".LANG."='yes' ORDER BY position LIMIT 10";
		$res2 = DB::query($query);
		$m2_html = '';
		$m2_flag = 0;
		if(DB::numRows($res2)>0){
			$m2_html = "<ul class='sub_menu'>";
			while($m2 = DB::fetchAssoc($res2)){
				$m2_html .= "<li class='sub_menu_item'><a class='sub_menu_item_text' href='/".LANG."/".$m2['url']."'>".$m2['name_'.LANG]."</a></li>";
			}
			$m2_html .= "</ul>";
			$m2_flag = 1;
		}
		
		$m_html .= "<li class='menu_item'><a class='menu_item_text ".($m2_flag==1?"menu_arrow":"")." ".(strstr($I['url'],$m['url'])?"current_page":"")."' href='".($m2_flag==1?"javascript:void(0)":"/".LANG."/".$m['url'])."'>".$m['name_'.LANG]."</a>
				".$m2_html."
				</li>";
	}
?>
		<nav class="menu">
			<ul class="menu_item_container">
				<?=$m_html?>
				<?/*<li class="menu_item"><a href="javascript:void(0)" class="menu_item_text">Про комплекс</a>
				</li>
				<li class="menu_item"><a class="menu_item_text" href="javascript:void(0)">Квартири</a></li>
				<li class="menu_item"><a href="javascript:void(0)" class="menu_item_text menu_arrow">Покупцям</a>
					<ul class="sub_menu">
						<li class="sub_menu_item"><a class="sub_menu_item_text" href="javascript:void(0)">Умови придбання</a></li>
						<li class="sub_menu_item"><a class="sub_menu_item_text" href="javascript:void(0)">Дозвільна документація</a></li>
					</ul>
				</li>
				<li class="menu_item"><a class="menu_item_text" href="javascript:void(0)">Прес-центр</a></li>
				<li class="menu_item"><a class="menu_item_text menu_arrow current_page" href="javascript:void(0)">Галерея</a>
					<ul class="sub_menu">
						<li class="sub_menu_item"><a class="sub_menu_item_text" href="javascript:void(0)">Хід будівництва</a></li>
						<li class="sub_menu_item"><a class="sub_menu_item_text" href="javascript:void(0)">Візуалізації</a></li>
					</ul>
				</li>
				<li class="menu_item"><a class="menu_item_text" href="javascript:void(0)" target="_blank">Забудовник</a></li>
				<li class="menu_item"><a class="menu_item_text" href="javascript:void(0)">Контакти</a></li>*/?>
			</ul>
		</nav>
<p class="copyright">&copy; <?=date('Y')?> ЖК "Варшавський мікрорайон". Усі права захищені. <a href="javascript:void(0)" class="room_details">Детальніше про Квартири</a></p>
<div id="dev"><a class="developer" href="https://realist.digital/" target="_blank"><span> </span></a></div>
