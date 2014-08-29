<form action="/new-progect/progect/authorization/index" method="POST">
    <fieldset id="fieldset_authorization">
    <legend>Личный кабинет</legend>
        <input type="text" class="input_authorization" id="log_a" required="required" name="login_auth"/> 
            <label for="log_a">логин</label><br />
            <input type="password" class="input_authorization" id="pas_a" required="required" name="passw_auth"/> 
            <label for="pas_a">пароль</label> 
        <input type="submit" id="sabmit_authorization" value="Вход" name="sabmit_auth"/> 
        <?php
            $url_1 = 'registration';
            $server_url = explode('/', $_SERVER['REQUEST_URI']);
            if(in_array($url_1, $server_url)){      
            }else{
        ?>
        
        <a href=?link=registration id="a_authorization">Регистрация</a>
        
        <?php
            }
        ?>
    </fieldset>
</form>


