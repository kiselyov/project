<?php
$menu = new NawMenu();
$out_left_menu = $menu->leftMenu();

if(count($out_left_menu) > 0){
?>

<!--<div class="left_naw_menu">-->
    <div class="h_naw-menu">КАТАЛОГ И ЦЕНЫ</div>
        <div class="b_naw_menu">
            <ul>
                <?php
                
                if(count($out_left_menu) !== 0){
                    foreach ($out_left_menu as $value){
                ?>
                <li><a href="#" class="li_a"><?php echo $value[1]?></a>
                    <?php
                    $catigories = $menu->leftCategoriesMenu($value[0]);
                    for($i=0;$i<count($catigories);$i++){
                    ?>
                    <ul id="ul_ul">
                        <li><a href=?section=<?php echo $catigories[$i][1];?> class="li_li_a"><?php echo $catigories[$i][0];?></a></li>
                        
                    </ul>
                    <?php
                    }
                    ?>
                </li>
                <?php
                    }
                }
                ?>
            </ul>
        </div>
   
<!--</div>-->
<?php
}
