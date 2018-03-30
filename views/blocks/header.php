<?
$query = "SELECT * FROM _main WHERE parent='0' AND visible_".LANG."='yes' ORDER BY position LIMIT 100";
$res = DB::query($query);
while($menu = DB::fetchAssoc($res)){
	$menu_html .="<div class='menu_ul'>
					<div class='menu_ul_dot'></div>";
	if($menu['type_tpl'] =='16'){				// контакты		
		if($I['id'] == 1){
			$menu_html .="<a href='/#map_block' class='menu_ul_a go_to_map'>".$menu['name_'.LANG]."</a>";	
		}else{
			$menu_html .="<a href='/".LANG."/#map_block' class='menu_ul_a '>".$menu['name_'.LANG]."</a>";		
		}
	}else{
		$menu_html .="<a href='/".LANG."/".$menu['url']."' class='menu_ul_a'>".$menu['name_'.LANG]."</a>";
	}
	$query_child = "SELECT * FROM _main WHERE parent='".$menu['id']."' AND visible_".LANG."='yes' ORDER BY position LIMIT 100";
		$res_child = DB::query($query_child);
		if($res_child !=''){
			$menu_html .="<div class='menu_li'>";   
			while($menu_child = DB::fetchAssoc($res_child)){
				if($menu['type_tpl'] !='6' && $menu['type_tpl'] !='16' ){					// расположение
						$menu_html .="<a href='/".LANG."/".$menu_child['url']."' class='menu_li_a'>".$menu_child['name_'.LANG]."</a>";
				}
			}
			$menu_html .="</div>";	
		}
	$menu_html .="</div>";	
	
	if($menu['type_tpl'] !=16){
		$menu_footer_html .="<div class='footer_st_li'><a href='/".LANG."/".$menu['url']."' class='footer_st_a'>".$menu['name_'.LANG]."</a></div>";
		$menu_footer_html .="<div class='footer_st_li'><div class='footer_st_dot'></div></div>";
	}
}

// main
$main = getGeneralInfo(1, array('*'), false);

// contacts
$project_ardess = getGeneralInfoCycle(array('type_tpl' => 32), array('*'), false, 1);

?>

<header>
	<div class="header_btn_wr">
		<div class="header_btn_lines">
			<div class="header_btn_line_1"></div>
			<div class="header_btn_line_6"></div>
			<div class="header_btn_line_2"></div>
			<div class="header_btn_line_5"></div>
			<div class="header_btn_line_3"></div>
			<div class="header_btn_line_4"></div>
		</div>
		<div class="header_btn_text">Меню</div>
	</div>
	<a href="/<?=LANG?>/" class="logo_wr">
		<img src="/public/img/logo.png" class="logo">
	</a>

	<div class="tel_wr">
		<div class="tel_left">
			<div class="tel_number_hide"><?=$main['tel']?></div>
			<div class="tel_number_hide"><?=$main['tel_2']?></div>
			<div class="tel_number"><?=$main['tel_3']?></div>
			<?if($I['id'] == 1){?>
				<a href="#map_block" class="tel_adress go_to_map"><?=$project_ardess[0]['anons_text_'.LANG]?></a>
			<?}else{?>
				<a href="/<?=LANG?>/#map_block" class="tel_adress"><?=$project_ardess[0]['anons_text_'.LANG]?></a>
			<?}?>
		</div>
		<div class="tel_right">
			<img src="/public/img/tel_arrow.png" class="tel_arrow"> 
		</div>
	</div>
	
	<!-- MENU -->
	<div class="menu_wrap">
		<div class="menu_scroll">
		<!-- LANGS -->
			<div class="langs_wr">
				<?
					/* LANGS */
					$url_ru = 'ru';	$url_ua = 'ua'; $url_en = 'en';
					$url_url=preg_replace("/http:\/\/$_SERVER[HTTP_HOST]\//","|/|",strtolower($_SERVER[REQUEST_URI])); 

					if (strstr($url_url, "/ua/")) {
						$url_ua = $url_url;
						$url_ru = preg_replace("/\/ua\//","/ru/", $url_url);
						$url_en = preg_replace("/\/ua\//","/en/", $url_url);
						
						}
					elseif(strstr($url_url, "/ru/"))  {
						$url_ru = $url_url;
						$url_ua = preg_replace("/\/ru\//","/ua/", $url_url);
						$url_en = preg_replace("/\/ru\//","/en/", $url_url);
						
					}elseif(strstr($url_url, "/en/"))  {
						$url_en = $url_url;
						$url_ua = preg_replace("/\/en\//","/ua/", $url_url);
						$url_ru = preg_replace("/\/en\//","/ru/", $url_url);
						
					}
					else { 
						$url_ua = '/ua/'; $url_ru = '/ru/'; $url_en = '/en/';  
					} 
					
					$langs_html ="<a href='".$url_ua."' class='lang ".(LANG=='ua'?"lang_active":"")."'>Укр</a>
					    			<a href='".$url_ru."' class='lang ".(LANG=='ru'?"lang_active":"")."'>Рус</a>";
				?>
				<?=$langs_html?>
				<!--<a href="javascript:void(0)" class="lang lang_active">УКР</a>
				<a href="javascript:void(0)" class="lang">Рус</a>-->
			</div>
			
			<div class="menu_wr">
				<div class="menu_line_wr">
					<div class="menu_line"></div>
				</div>
				<div class="menu_ul_wr">
					<?=$menu_html?>
					<!--<div class="menu_ul">
						<div class="menu_ul_dot"></div>
						<a href="javascript:void(0)" class="menu_ul_a">головна</a>
					</div>
					<div class="menu_ul">
						<div class="menu_ul_dot"></div>
						<a href="javascript:void(0)" class="menu_ul_a">Про комплекс</a>
						<div class="menu_li">                       
							<a href="javascript:void(0)" class="menu_li_a">концепція</a>
							<a href="javascript:void(0)" class="menu_li_a">переваги</a>
							<a href="javascript:void(0)" class="menu_li_a">забудовник</a>
							<a href="javascript:void(0)" class="menu_li_a">документація</a>
						</div>
					</div>
					<div class="menu_ul">
						<div class="menu_ul_dot"></div>
						<a href="javascript:void(0)" class="menu_ul_a">Розташування</a>
					</div>-->
				</div>
			</div>
		</div>
	</div>
	<!-- END MENU -->
	
</header>