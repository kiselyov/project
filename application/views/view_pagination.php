<?php
    //Выводим пагинатор на странице всех новостей
    $pages = $content_view['pagination'];
    //Количество страниц в пагинаторе
    $count = count($pages);
    //Номер страницы которую выбрал пользователь
    $pages_number = $content_view['pages_number'];
    if($count>1){
?>

<div class="paginat_news">
    
    <?php
        if($pages_number > 1){
    ?>
    <a href=?page=<?php echo $pages_number-1;?>><< </a>
     
    <?php
        }
        
            for($i=0;$i<$count;$i++){
                if($pages_number != $pages[$i]){
                    $style = 'id="nomber_page_1"';
                }else{
                    $style = 'id="nomber_page_2"';
                }
                if(!isset($pages_number) && $i==0){
                    $style = 'id="nomber_page_2"';
                }
                echo '<a href=?page='.$pages[$i].' '.$style.'> '.$pages[$i].' </a>';
            }
        if($pages_number < $count && isset($pages_number)){
    ?>
    <a href=?page=<?php echo $pages_number+1;?>> >></a>
    <?php
        }
    ?>
</div> 
<?php
    }

