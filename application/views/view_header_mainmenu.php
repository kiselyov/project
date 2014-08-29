<?php
require_once 'application/classes/naw_menu.php';
?>
<ul id="ul_nawmenu">
    <!--
    
    -->
    <?php
    $naw = new NawMenu();
    $out_naw_menu = $naw->MainMenu();
    if(count($out_naw_menu) !== 0){
        foreach ($out_naw_menu as $value){
       
    ?>
       <li class="li_nawmenu"><a href="<?php echo $value[1]?>" class="a_nawmenu"><?php echo $value[0];?></a></li>
    <?php
        }
    }
    ?>
</ul>
    

