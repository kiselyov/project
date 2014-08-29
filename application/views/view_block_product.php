<?php
if(!empty($content_view['search'])){
    $product = $content_view['search'];
}
if(!empty($content_view['products'])){
    $product = $content_view['products'];
}
$count = count($product);

for($i=0;$i<$count;$i++){
   if($product[$i]['img'] !== null){
       $url_img = $product[$i]['img'];
   }else{
       $url_img = 'img/no-product/nophoto.gif';
   }
?>
<div class="mini_tovar_block">
    <div class="h_mini_tovar_block">
        <p><a href=?product=<?php echo $product[$i]['id'];?>><?php echo $product[$i]['name'];?></a></p>
    </div>
    <div class="img_mini_tovar_block"><p><a href="#"><img src="<?php echo '../'.$url_img;?>" alt="загрузка изображения"/></a></p></div>
    <div>
            <table class="collapse">
            <tr>
                <td class="b_mini_tovar-0"><p><a href="#">Форум</a></p></td>
                <td class="b_mini_tovar-1"><p>Цена</p></td>
                <td class="b_mini_tovar-1"><p><?php echo $product[$i]['price'];?></p></td>
            </tr>
        </table>
    </div>
    <div class="b_mini_tovar_text">
            <p><?php echo $product[$i]['min_text'];?></p>
    </div>
    <div>
        <table class="tadle_mini_sabmit">
            <tr>
                    <td class="mini_submit_1"><a href=?product=<?php echo $product[$i]['id'];?>><p>Подробнеее</p></a></td>
                    <td class="mini_submit_2"><a href="#" id="buy_tovar" class="buy_<?php echo $product[$i]['id'];?>"><p>Купить</p></a></td>
            </tr>
        </table>
    </div>
</div>

<!-- -------------------------------------------------------------  -->

<div id="div_city" class="div_city_<?php echo $product[$i]['id'];?>">
    <div id="header_city"><a href="#">x</a></div>
    <form method="POST" action="/new-progect/progect/products/index">
    <div id="body_city">
        <p>Выбрать ваш город:</p>
        <select name="sity_user">
        <option disabled="disabled" selected="selected">Выбрать</option>
        <option>Брест</option>
        <option>Минск</option>
        <option>Витебск</option>
        <option>Гомель</option>
        <option>Гродно</option>
        <option>Могилев</option>
    </select>
    <input type="hidden" name="id_tovar" value="<?php echo $product[$i]['id'];?>" />
    <input type="submit" value="Купить"/>
    </div>
    </form>
</div>

<!-- -------------------------------------------------------------  -->
<script type="text/javascript">
$(document).ready(function(){
    
    //По умолчанию блок div#div_city скрыт
    $("div#div_city").html(function(){
    $(this).fadeOut();
        
        //Если кликнули на блок a#a_buy_a
        var id = ".buy_"+"<?php echo $product[$i]['id'];?>";
        $(id).click(function (){
            
            //А блок div#div_city показываем
            var id = "div.div_city_"+"<?php echo $product[$i]['id'];?>";
            $(id).fadeIn(1000);
        
        });
        $("#header_city a").click(function (){
            var id = "div.div_city_"+"<?php echo $product[$i]['id'];?>";
            $(id).fadeOut(1000);
            
        });
    });
    
   
});
</script>
<?php
}



