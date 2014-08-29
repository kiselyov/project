<?php
require_once 'application/classes/naw_menu.php';
$s = new NawMenu();
$name = $s->DataUser();
?>
<form action="/new-progect/progect/authorization/index" method="POST">
    <fieldset id="fieldset_user_data">
    <legend>Личные данные</legend>
    <p><?php echo $name['name'].' '.$name['family'];?><br />Город: <?php echo $name['city'];?><br /></p>
    <?php
        $url_1 = 'user';
        $server_url = explode('/', $_SERVER['REQUEST_URI']);
        if(in_array($url_1, $server_url)){      
        }else{
    ?>
    <p><a href="/new-progect/progect/user/index">Кабинет пользов</a>
    <?php
        }
    ?>
        <input type="submit" id="sabmit_user_data" value="Выход" name="sabmit_exit" title="Выход из страницы пользователь"/></p>
    </fieldset>
</form>


