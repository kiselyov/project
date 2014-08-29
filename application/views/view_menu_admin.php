<?php
    if(!isset($_SESSION['admin'])){

    }elseif(isset($_SESSION['admin'])){
?>
<div id="menu_admin">
    <h3>Панель управления сайтом</h3>
        <ul>
            <li><a href=?admin=message>Входящие сообщения</a></li>
            <li><a href=?alladmin=allmessage>Прочитанные сообщения</a></li>
            <li><a href=?new_section=section>Создать раздел</a></li>
            <li><a href=?new_tovar=tovar>Создать товар</a></li>
            <li><a href=?news=news>Создать новость</a></li>
            <li><a href=?list=users>Список пользователей</a></li>
        </ul>
    <form method="POST">
        <input type="submit" name="exit_admin" value="выход" id="exit_admin">
    </form>
</div>
<?php
    } 

