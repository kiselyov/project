<?php
$buy_product = $content_view['buy_product'];
if(!empty($buy_product)){
?>
<div id="mdsfsdfsdf">
<div id="main_block_buy">
    
    <div id="name_block_buy">Название выбранного товара</div>
    <div id="img_block_buy"><img src="dfsd" alt="название товара"></div>
    <div id="price_block_buy">Средняя стоимость: 550 у.е.</div>
    <div id="a_block_buy">Ссылка на описание</div>
    <div class="clear"></div>
    <div id="ul_block_buy">
            <h4>Список продавцов которые продают этот товар в Городе <?php echo $buy_product[$i]['city'];?></h4>
    </div>
    
<?php
    for($i=0;$i<count($buy_product);$i++){
        //echo $buy_product[$i]['name'];          
?>
    <!-- цикл фор -->
    <div class="main_block_user">

        <div class="img_block_user"><img src="dfsd" alt="Логотип"></div>
        <div class="name_block_user">УНП: <?php echo $buy_product[$i]['family'];?></div>
        <div class="clear"></div>
        <div class="price_block_user">Цена: 500 у.е.</div>
        <div class="contacts_block_user">контакты:</div>
        <div class="tel1_block_user"><strong>мтс:</strong><?php echo $buy_product[$i]['tel_1'];?></div>
        <div class="tel1_block_user"><strong>мтс:</strong><?php echo $buy_product[$i]['tel_2'];?></div>
        <div class="clear"></div>
        <div class="tel2_block_user"><strong>velcom:</strong><?php echo $buy_product[$i]['tel_3'];?></div>
        <div class="tel2_block_user"><strong>мтс:</strong><?php echo $buy_product[$i]['tel_4'];?></div>
        <div class="clear"></div>
        <div class="skype_block_user"><strong>skype:</strong><?php echo $buy_product[$i]['skype'];?></div>
        <div class="skype_block_user"><strong>e-mail:</strong><?php echo $buy_product[$i]['email'];?></div>
        <div class="info_block_user">
            Инфо о продавце:<br />
            Дата регистрации:<?php echo $buy_product[$i]['data'];?><br />
            <?php
            $info_user = $buy_product[$i]['info'];
                if(empty($info_user)){
                    echo '<i>Информация о продавце еще не заполнена</i>';
                }else{
                    echo $buy_product[$i]['info'];
                }
            ?>
        </div>

    </div>
<?php
    }
}
?>
</div>
</div>