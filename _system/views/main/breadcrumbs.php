<!-- Breadcrumbs -->
<div id="scroll-bread">
    <a href="javascript:void(0)" title="Scroll to the end" class="prev-end"></a>
    <a href="javascript:void(0)" title="Scroll animation" class="prev"></a>
    <a href="javascript:void(0)" title="Scroll to the end" class="next-end"></a>
    <a href="javascript:void(0)" title="Scroll animation" class="next"></a>
</div>
<div id="breadcrumbs">
    <?  if($breadcrumbs_data != ""): 
        $count_br = count($breadcrumbs_data); //Количество эл. навигации
    ?>
        <ul>
            <li><span class="left-bread-bg"></span><a href="<?=URL_ADMIN?>">Главная</a></li>
            <? $i=0; foreach($breadcrumbs_data as $k_br => $v_br): $i++; ?>
                <li <?=$curr_br = $i == $count_br ? 'class="current-bread"' : NULL; ?>>
                    
                    <?php 
                        $namePage = $v_br['name_'.LANG];                         
                        if (strlen($namePage) > 30) { 
                            $namePage = Lib_system::subString($namePage, 40) . '... ';                             
                        }                                                
                    ?>
                
                    <span class="left-bread-bg"></span>
                    <a <? if($i != $count_br): ?> href="<?=URL_ADMIN?>edit/<?=$v_br['id']?>/"<? endif; ?>><?=$namePage?></a>
                    <?=$end_current_br = $i == $count_br ? '<span class="right-bread-bg"></span>' : NULL; ?>
                </li>
            <? endforeach; ?>
        </ul>
    <? endif; ?>
</div>
