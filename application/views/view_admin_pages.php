<?php
require_once 'application/classes/naw_menu.php';
if($content_view['out_message'] === TRUE && !isset($_GET['details_message'])){
    $count_message = count($content_view['unread_messages']);
?>
<form method="POST">
    <table id="header_message">

        <tr>
            <td colspan="5" id="message_theam">
            <?php
            if($count_message>0){
                if($content_view['unread_messages'][0]['status'] == 1){
                    echo 'Прочитанных ';
                }elseif($content_view['unread_messages'][0]['status'] == 0){
                    echo 'Входящих ';
                }
                echo 'сообщений - '.$count_message;
            }else{
                echo 'Нет сообщений';
            }
            ?>
            </td>
        </tr>
        <tr>
            <td id="nomber_message">№</td>
            <td id="delete_message">
                <input type="submit" name="del_mesage" value="delete">
            </td>
            <td id="data_message">Дата</td>
            <td id="name_user_message">Логин<br /> пользователя</td>
            <td id="text_message">Тема сообщения</td>
        </tr>
    </table>
    
            <?php
            for($i=0;$i<$count_message;$i++){
            ?>
    <table class="body_message">
        <tr class="message_tr">
            <td class="nomber_message"><?php echo $i+1?></td>
            <td class="delete_message">
                <input type="checkbox" name="checkbox_message[]" value="<?php echo $content_view['unread_messages'][$i]['id'];?>">
            </td>
            <td class="data_message">
                <?php
                echo $content_view['unread_messages'][$i]['date'];
                ?>
            </td>
            <td class="name_user_message">
                <?php
                echo $content_view['unread_messages'][$i]['login_user'];
                ?>
            </td>
            <td class="text_message">
                <a href=?details_message=<?php echo $content_view['unread_messages'][$i]['id'];?>>
                <?php
                echo $content_view['unread_messages'][$i]['theam'];
                ?>
                </a>
            </td>       
        </tr>
        <tr>
            <td colspan="5" class="m_admin">
                <?php
                echo '<strong>Название товара: </strong>'.$content_view['unread_messages'][$i]['title'].' ';
                echo '<strong>Модель товара: </strong>'.$content_view['unread_messages'][$i]['model'].' ';
                ?>
            </td>
        </tr>
         <tr>
            <td colspan="5" class="m_admin"><a href=?details_message=<?php echo $content_view['unread_messages'][$i]['id'];?>>Подробнее...</a></td>
        </tr>
    </table>
            <?php
            }
            ?>
</form>


<!------------------------------------------------------------------->
<?php
}
if($content_view['out_message'] === TRUE && isset($_GET['details_message']) && !empty($content_view['old_post']['id'])){
    
?>
<form method="POST">
<table class="body_message">
    <tr>
        <td class="data_message">
            <?php
                echo $content_view['old_post']['date'];
            ?>
        </td>
        <td class="name_user_message">
            <?php
                echo $content_view['old_post']['login_user'];
            ?>
        </td>
        <td class="text_message">
            <?php
                echo $content_view['old_post']['theam'];
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="3" class="m_admin">
            <p><strong>Название товара: </strong>
            <?php
                echo $content_view['old_post']['title'];
            ?>
            </p>
            <p><strong>Модель товара: </strong>
            <?php
                echo $content_view['old_post']['model'];
            ?>
            </p>
            <p><strong>URL ссылка на источник: </strong>
            <?php
                echo $content_view['old_post']['url'];
            ?>
            </p>
            <p><strong>Текст сообщения: </strong>
            <?php
                echo $content_view['old_post']['text'];
            ?>
            </p>
        </td>
    </tr>
    <tr>
        <td colspan="3" class="m_admin">
            <input type="checkbox" name="checkbox_message[]" value="<?php echo $content_view['old_post']['id'];?>">
            <input type="submit" name="del_mesage" value="delete">
        </td>
    </tr>
</table>
</form>
<?php
}elseif($content_view['out_message'] === TRUE && isset($_GET['details_message']) && empty($content_view['old_post']['id'])){
    echo '<h2>Сообщешия нет! Возможно оно было удалено! :)</h2>';
}
?>
<!------------------------------------------------------------------->


<?php
if($content_view['out_section'] === TRUE){
?>
<div class="block_admin">
<h2>Создать новый раздел в главном навигационном меню сайта</h2>

    <fieldset><legend>Создать новый раздел</legend>
    <form method="POST">
        Название раздела главного меню<br /><input type="text" name="main_menu" required="required" class="admin_text"><br />
        URL <br /><input type="text" name="url_main_menu" required="required" class="admin_text"><br />
        <input type="submit" value="создать" name="sabmit_main_menu" class="admin_submit"><br />
        <br /><hr><br />
    </form>
    <fieldset><legend>Выберите раздел что бы изменить или удалить</legend>
        <form method="POST">
            <select name="selection_delete_main_menu" class="admin_select">
                <option>Выбрать раздел</option>
                <?php
                
                $naw_menu = new NawMenu();
                $name = $naw_menu->MainMenu();
                
                foreach ($name as $value){
                ?>
                <option><?php echo $value[0]?></option>
                <?php
                }
                ?>
            </select>
            <input type="submit" value="удалить" name="sabmit_delete_main_menu" class="admin_submit"><br /><br />
        </form>

        <form method="POST">
            Изменить название<br />
            <select name="selection_update_main_menu" class="admin_select">
                <option>Выбрать раздел</option>
                <?php
                
                foreach ($name as $value){
                ?>
                <option><?php echo $value[0]?></option>
                <?php
                }
                ?>
            </select><br />
            <input type="text" name="update_main_menu" required="required" class="admin_text" placeholder="Веедите новое название раздела"><br />
            <input type="submit" value="изменить" name="sabmit_update_main_menu" class="admin_submit">
        </form>
        
        
        <form method="POST">
            Изменить URL<br />
            <select name="update_url" class="admin_select">
                <option>Выбрать раздел</option>
                <?php
                
                foreach ($name as $value){
                ?>
                <option><?php echo $value[0]?></option>
                <?php
                }
                ?>
            </select><br />
            <input type="text" name="new_url" required="required" class="admin_text" placeholder="Веедите новый URL раздела"><br />
            <input type="submit" value="изменить" name="sabmit_new_url" class="admin_submit">
        </form>
        
        
    </fieldset>
</fieldset>
</div>
<!------------------------------------------------------------------->

<div class="block_admin">
<h2>Создать новый раздел с товарми в левом навигационном меню</h2>
<fieldset><legend>Создать новый раздел с товарами</legend>
    <form method="POST">
        Название раздела<br /> 
        <input type="text" name="new_section" required="required" class="admin_text"><br />
        <input type="submit" value="создать" name="sabmit_new_section" class="admin_submit"><br />
    </form>
    <form method="POST">
        Выбрать раздел<br />
        <select name="name_left_section" class="admin_select">
            <option>Выбрать раздел</option>
            <?php
            $name_left_menu = $naw_menu->leftMenu();

            foreach ($name_left_menu as $value){
            ?>
            <option><?php echo $value[1]?></option>
            <?php
            }
            ?>
        </select><br />
        Название катигории<br /> 
        <input type="text" name="new_categories" required="required" class="admin_text"><br />
        <input type="submit" value="создать" name="sabmit_new_categories" class="admin_submit"><br />
    </form>
    <br /><hr><br />
    
    <fieldset><legend>изменить/удалить раздел либо категорию</legend>
        <form method="POST">Удалить раздел<br />
            <select name="delete_name_section" class="admin_select">
                <option>Выбрать раздел</option>
                <?php
                foreach ($name_left_menu as $value){
                ?>
                <option><?php echo $value[1]?></option>
                <?php
                }
                ?>
            </select>
            <input type="submit" value="удалить" name="sabmit_name_section" class="admin_submit"><br />
        </form>
        <form method="POST">Удалить категорию<br />
            <select name="delete_name_categories" class="admin_select">
                <option>Выбрать категорию</option>
                <?php
                foreach ($content_view['categories'] as $value){
                ?>
                <option><?php echo $value?></option>
                <?php
                }
                ?>
            </select>
            <input type="submit" value="удалить" name="sabmit_name_categories" class="admin_submit"><br />
        </form>
        
        <form method="POST">
            Изменить название раздела<br />
            <select name="name_section" class="admin_select">
                <option>Выбрать раздел</option>
                <?php
                
                foreach ($name_left_menu as $value){
                ?>
                <option><?php echo $value[1]?></option>
                <?php
                }
                ?>
            </select><br />
            <input type="text" name="new_name_section" required="required" class="admin_text" placeholder="Веедите новое название раздела"><br />
            <input type="submit" value="изменить" name="update_section" class="admin_submit">
        </form>
        <form method="POST">
            Изменить название категории<br />
            <select name="name_categories" class="admin_select">
                <option>Выбрать категорию</option>
                <?php
                foreach ($content_view['categories'] as $value){
                ?>
                <option><?php echo $value?></option>
                <?php
                }
                ?>
            </select><br />
            <input type="text" name="new_name_categories" required="required" class="admin_text" placeholder="Веедите новое название раздела"><br />
            <input type="submit" value="изменить" name="update_categories" class="admin_submit">
        </form>
        <form method="POST">
            Изменить URL категории<br />
            <select name="name_categories" class="admin_select">
                <option>Выбрать категорию</option>
                <?php
                foreach ($content_view['categories'] as $value){
                ?>
                <option><?php echo $value?></option>
                <?php
                }
                ?>
            </select><br />
            <input type="text" name="url_categories" required="required" class="admin_text" placeholder="Веедите новый URL раздела"><br />
            <input type="submit" value="изменить" name="update_url_categories" class="admin_submit">
        </form>
    </fieldset>
    
</fieldset>
</div>
<?php 
}
if($content_view['out_tovar'] === TRUE){
?>
<div class="block_admin">
    <h2>Создать новый товар</h2>
    
    <form method="POST" enctype="multipart/form-data">
        
            <p>*Выбрать категорию в котором создать товар</p>
            <select name="categories" class="admin_select">
                <option>Выбрать категорию</option>
                <?php
                foreach ($content_view['categories'] as $value){
                ?>
                <option><?php echo $value?></option>
                <?php
                }
                ?>
            </select><br />
        <p>*Загрузить картинку</p>
        <input type="file" name="file" accept="image/*" class="admin_submit"><br />
        <p>*Заголовок (название, модель) max-40 символов</p>
            <input type="text" name="new_product" required="required" class="admin_text"><br />
        <p>*Средняя стоимость товара</p>
            <input type="text" name="price_product" required="required" class="admin_text"><br />
        <p>*Краткое описание max-80 символов</p>
        <textarea name="min_text" class="admin_textarea_min"></textarea>
        <p>*Подробное описание</p>
            <textarea name="max_text" class="admin_textarea_max"></textarea><br />
        
            <input type="submit" value="создать" class="admin_submit">
    </form>
    <hr />
    <form method="POST" enctype="multipart/form-data">
        <p>Для загрузки изображения нужно выбрать товар</p>
        <select name="id_products" class="admin_select">
            <option>Выбрать товар</option>
            <?php
            foreach ($content_view['tovars'] as $value){
            ?>
            <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
            <?php
            }
            ?>
        </select>
        <p>Выбрать изображение</p>
        <input type="file" name="img_big" accept="image/*" class="img_big" ><br />
        <input type="submit" value="создать" class="admin_submit">
    </form>
</div>


<?php
}
if($content_view['out_news'] === TRUE){
            
?>
<div class="block_admin">
    <h2>Создать новость</h2>
    <form method="POST" enctype="multipart/form-data">
        <p>Заголовок новости</p>
        <input type="text" name="h_news" required="required" class="admin_text">
        <p>Загрузить картинку</p>
        <input type="file" name="img_news" accept="image/*">
        <p>min - описание новости. max - количество символов 100</p>
        <textarea required="required" maxlength="100" name="min_news" class="admin_textarea_min"></textarea>
        <p>max - описание новости</p>
        <textarea required="required" name="max_news" class="admin_textarea_min"></textarea><br />
        <input type="submit" name="submit_news" value="создать новость" class="admin_submit">
    </form>
</div>
<?php
}