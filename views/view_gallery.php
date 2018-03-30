<?php if ($deviceTouch) : ?>
<!--если мобильная версия-->
	<?require_once URL_VIEWS.'view_gallery_mob.php'; ?>
<?php else : ?>
<?
$query_gal = "SELECT * 
		FROM 
			_main as gallery,
			_main as gal_child
		WHERE 
			gallery.id = ".$I['id']."
			AND gallery.visible_".LANG."='yes' 
			AND gal_child.parent = gallery.id
			AND gal_child.visible_".LANG."='yes' 
			ORDER BY gal_child.position 
			LIMIT 100";
			
$res_gal = DB::query($query_gal);
while($gal_child = DB::fetchAssoc($res_gal)){
	$gallery_html .="<a href='/".LANG."/".$gal_child['url']."' class='gal_p_link' style='background-image: url(/".$gal_child['img'].")'>
					 <div class='gal_p_titl_second'>".$gal_child['name_'.LANG]."</div>
				  </a>";
}
?>
<div class="gallery_parent_wrap small_logo">
	<!-- HEADER -->
	<? require_once (URL_BLOCKS . 'header.php');?>
	<!-- END HEADER -->
	
	<div class="gal_p_wrap">
		<h1 class="gal_p_tittle"><?=$I['name_'.LANG]?></h1>
		<div class="gal_p_wr">
			<?=$gallery_html?>
			<!--<a href="javascript:void(0)" class="gal_p_link">
				<div class="gal_p_titl_second">Архітектура</div>
			</a>-->
		</div>
	</div>
</div>
<?endif?>