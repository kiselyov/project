<?php
if($content_view['news'] === TRUE && (!isset($_GET['details_news']) && !isset($_GET['all_news']))){
?>
<form method="POST">
    <div class="head_news">
        <div class="head_news_left">Количество 
            <select name="count_elem">
                <option disabled="disabled" selected="selected"> новостей</option>
                <option>12</option>
                <option>24</option>
                <option>36</option>
                <option>48</option>
            </select>
            <input type="submit" value="изменить" id="submit_head_news">
        </div>
        <div class="head_news_right">
            <a href="#">ВСЕ НОВОСТИ</a>
        </div>
    </div>
</form> 

<?php
    $count_arr = $content_view['array_news'];
    for($i=0;$i<count($count_arr);$i++){
?>
<table class="table_news">
    <tr>
        <td class="news_image" id="img_<?php echo $i;?>">
            <a href=?details_news=<?php echo $content_view['array_news'][$i]['id'];?>><?php echo $content_view['array_news'][$i]['header'];?></a>
        </td><style>#img_<?php echo $i;?>{background: <?php echo 'url(../'.$content_view['array_news'][$i]['url_1'].')';?> no-repeat;}</style>
        
    </tr>
    <tr>
        <td class="news_text">
            <div>
                <?php echo $content_view['array_news'][$i]['min_news'];?>
            </div>
            <a href=?details_news=<?php echo $content_view['array_news'][$i]['id'];?>>читать...</a> 
            <a href=?all_news=<?php echo $content_view['array_news'][$i]['date'];?> class="date_news">Все новости <?php echo $content_view['array_news'][$i]['date']; ?></a>
        </td>
    </tr>
</table>


<?php
    }
    //Выводи пагинатор
    require 'view_pagination.php';
}
//-----------------------------------------------------------------------------

//Подробно о новости-----------------------------------------------------------
$count_detalies = count($content_view['details']);
if(isset($_GET['details_news']) && !empty($count_detalies)){
    
?>

<div id="div_max_text">
<table id="table_max_text">
    <tr>
        <td class="max_text_h"><h3 class="max_h"><?php echo $content_view['details']['header'];?></h3></td>
        <td class="max_date_h">Все новости <a href=?all_news=<?php echo $content_view['details']['date'];?> class="details_date"><?php echo $content_view['details']['date'];?></a></td>
    </tr>
    <tr>
        <td colspan="2" class="max_text_b">
            <p>
                <img src="../<?php echo $content_view['details']['url_2'];?>" alt="картинка отсутствует" align="left">
                <h4 class="max_h"><?php echo $content_view['details']['header'];?></h4>
                <?php echo $content_view['details']['max_news'];?>
            </p>
        </td>
    </tr>
</table>
</div>

<?php
}
//-----------------------------------------------------------------------------

//Новости за конкретное число--------------------------------------------------
$count_arr = $content_view['details_date'];
$count = count($count_arr);

if(isset($_GET['all_news']) && $count>0){
    $date = $_GET['all_news'];
?>

<div class="head_news"><a href="#">ВСЕ НОВОСТИ ЗА <?php echo $date;?></a></div> 

<?php
    
    for($i=0;$i<$count;$i++){
?>

<table class="table_news">
    <tr>
        <td class="news_image" id="img_<?php echo $i;?>">
            <a href=?details_news=<?php echo $content_view['details_date'][$i]['id'];?>><?php echo $content_view['details_date'][$i]['header'];?></a>
        </td><style>#img_<?php echo $i;?>{background: <?php echo 'url(../'.$content_view['details_date'][$i]['url_1'].')';?> no-repeat;}</style>
        
    </tr>
    <tr>
        <td class="news_text">
            <div>
                <?php echo $content_view['details_date'][$i]['min_news'];?>
            </div>
            <a href=?details_news=<?php echo $content_view['details_date'][$i]['id'];?>>читать...</a>
        </td>
    </tr>
</table>

<?php
    }
}