<ul id="ul_menu">
    <?php
    if(!empty($content_view['header_menu'])){
        foreach ($content_view['header_menu'] as $value){
    ?>
    <li class="li_menu"><a href="#" class="a_menu"><?php echo $value;?></a></li>
    <?php
        }
    }
    ?>
</ul>

