<?php if ($deviceTouch) : ?>
<!--если мобильная версия-->
	<?require_once URL_VIEWS.'view_docs_mob.php'; ?>
<?php else : ?> 


	<div class="body_wrapper bg_purchase">

		<div class="tel">
			<p><span>(063)</span> 693 88 26</p>
		</div>
				
		<a href="index.html" class="varshavsky_logo_small"></a>

		<a href="javascript:void(0)" class="fb"><img src="/public/img/Facebook+Logo.png" alt="Facebook"></a>
		
		<section class="info_container">
			<h1 class="info_title"><?=$I['name_'.LANG]?></h1>
			<div class="info_scroll">
				<?=$I['text_'.LANG]?>
				<?/*<div class="info_block">
					<h3 class="info_block_title">Купівля квартири при 100% оплаті:</h3>
					<ul>
						<li><span>10% знижка</span> (ІV черга, VІ черга)</li>
						<li>термін здійснення платежу становить 3 банківських дні з моменту укладення договору;</li>
						<li>вартість квартири лишається незмінною, крім випадків зміни її площі за паспортом БТІ.</li>
					</ul>
					<div class="info_download">
						<a href="javascript:void(0)" class="info_download_doc">Договір купівлі-продажу деривативу</a>
						<a href="javascript:void(0)" class="info_download_doc">Договір купівлі-продажу майнових прав</a>
					</div>
				</div>
				<div class="info_block">
					<h3 class="info_block_title">Купівля квартири в розстрочку:</h3>
					<ul>
						<li>розстрочка не діє на квартири I, II, III черги;</li>
						<li>вартість квартири уточнюйте у менеджерів відділу продажів;</li>
						<li><span>мінімальний перший внесок</span> складає 30% від вартості квартири;</li>
						<li>розстрочка на <span>3 РОКИ</span>;</li>
						<li>0% річних з прив'язкою до курсу долара згідно НБУ.</li>
					</ul>
					<div class="info_download">
						<a href="javascript:void(0)" class="info_download_doc" target="_blank">Договір купівлі-продажу деривативу</a>
						<a href="javascript:void(0)" class="info_download_doc" target="_blank">Договір купівлі-продажу майнових прав</a>
					</div>
				</div>
				<div class="info_block">Введення в експлуатацію: <span>І черга - введена в експлуатацію, ІІ черга - IV квартал 2017 року, ІІІ черга - ІІ квартал 2018 року, ІV черга - ІІІ квартал 2018 року, VI черга - ІІІ квартал 2019 року</span>.</div>
				*/?>
			</div>
		</section>

		<nav class="main_menu texture_menu">
			<ul>
				<li class="menu_item"><a href="javascript:void(0)" class="menu_arrow">Мікрорайон</a>
					<ul class="sub_menu">
						<li><a href="javascript:void(0)">Сучасний</a></li>
						<li><a href="javascript:void(0)">Стильний</a></li>
						<li><a href="javascript:void(0)">Свіжий</a></li>
						<li><a href="javascript:void(0)">Спокійний</a></li>
						<li><a href="javascript:void(0)">Retroville</a></li>
						<li><a href="javascript:void(0)">Розташування</a></li>
					</ul>
				</li>
				<li><a href="javascript:void(0)">Квартири</a></li>
				<li class="menu_item"><a href="javascript:void(0)" class="menu_arrow current_page">Покупцям</a>
					<ul class="sub_menu">
						<li><a href="javascript:void(0)">Умови придбання</a></li>
						<li><a href="javascript:void(0)">Дозвільна документація</a></li>
					</ul>
				</li>
				<li><a href="javascript:void(0)">Прес-центр</a></li>
				<li class="menu_item"><a href="javascript:void(0)" class="menu_arrow">Галерея</a>
					<ul class="sub_menu">
						<li><a href="javascript:void(0)">Хід будівництва</a></li>
						<li><a href="javascript:void(0)">Візуалізації</a></li>
						<li><a href="javascript:void(0)">Інвестори про нас</a></li>
					</ul>
				</li>
				<li><a href="javascript:void(0)">Забудовник</a></li>
				<li><a href="javascript:void(0)">Контакти</a></li>
			</ul>
		</nav>
				
		<div id="dev"><a class="developer" href="https://realist.digital/" target="_blank"><span> </span></a></div>

	</div>	

<?endif?>