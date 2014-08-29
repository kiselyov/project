<?php
$detalies = $content_view['detalies'];

if(!empty($detalies)){
?>

<div id="tovar_detalies">
    <div id="tovar_name">
        <?php echo $detalies['name']; ?>
    </div>
    <div id="tovat_img">
        <?php
        $url_img = $content_view['url_image'];
        for($i=0;$i<count($url_img);$i++){     
        ?>
        <img src="<?php echo '../'.$url_img[$i]; ?>" class="tovar_img" title="<?php echo $detalies['name']; ?>" alt="<?php echo $detalies['name']; ?>" />
        <?php
        }
        ?>
    </div>
    <div id="tovar_sabmit"><a href="#" class="buy_<?php echo $detalies['id'];?>">Купить...</a></div>
    <div id="tovar_price">Цена: <?php echo $detalies['price'];?></div>
    <div id="tovar_none"></div>
    <div id="tovar_text"><?php echo $detalies['max_text'];?></div>
</div>
<!------------------------------->

<div id="div_city" class="div_city_<?php echo $detalies['id'];?>">
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
    <input type="hidden" name="id_tovar" value="<?php echo $detalies['id'];?>" />
    <input type="submit" value="Купить"/>
    </div>
    </form>
</div>

<!------------------------------>

<script type="text/javascript">
$(document).ready(function(){
    
    //По умолчанию блок div#div_city скрыт
    $("div#div_city").html(function(){
    $(this).fadeOut();
        
        //Если кликнули на блок .buy_$id
        var id = ".buy_"+"<?php echo $detalies['id'];?>";
        $(id).click(function (){
            
            //А блок div#div_city показываем
            var id = "div.div_city_"+"<?php echo $detalies['id'];?>";
            $(id).fadeIn(1000);
        
        });
        $("#header_city a").click(function (){
            var id = "div.div_city_"+"<?php echo $detalies['id'];?>";
            $(id).fadeOut(1000);
            
        });
    });
    
   
});
</script>
<?php
}
