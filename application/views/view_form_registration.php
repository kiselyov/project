<div>
    
    
    <form method="POST">
        <table id="table_reg">
            <tr class="tr_heder_footer">
                <td colspan="3">
                    <h2>Регистрация</h2>
                    
                        <?php
                        if(!empty($content_view['end_registration'][0])){
                            echo '<p id="p_table_header_2">'.$content_view['end_registration'][0].'</p>';
                        }else{
                            echo '<p id="p_table_header_1">Все поля обязательные для заполнения</p>';
                        }
                        ?>
                    
                </td>
            </tr>
            <tr>
                <td id="td_name"><label for="name_reg"><strong>Имя</strong></label><br />
                    <?php
                        echo($content_view['error'][0]);
                    ?>
                </td>
                <td id="td_input">
                    <input type="text" id="name_reg" required="required" name="name_reg"/>
                </td>
                <td class="td_error"  rowspan="3">
                    <p class="p_error">Первый символ в верхнем регистре<br />
                        Кол-во символов min-3 max-16<br />
                        Образец:<br />ИМЯ - Валерий<br />Фамилия - Киселев<br />Город - Брест</p>
                </td>
            </tr>
            <tr>
                <td><label for="family_reg"><strong>Фамилия</strong></label><br />
                    <?php
                        echo($content_view['error'][1]);
                    ?>
                </td>
                <td>
                    <input type="text" id="family_reg" required="required" name="family_reg"/>
                </td>
            </tr>
            <tr>
                <td><label for="city_reg"><strong>Город</strong></label><br />
                    <?php
                        echo($content_view['error'][2]);
                    ?>
                </td>
                <td>
                    <input type="text" id="city_reg" required="required" name="city_reg"/>
                </td>
            </tr>
            <tr>
                <td><label for="tel_reg"><strong>Телефон</strong></label><br />
                    <?php
                        echo($content_view['error'][3]);
                    ?>
                </td>
                <td>
                    <input type="text" id="tel_reg" required="required" name="tel_reg"/>
                </td>
                <td class="td_error">
                    <p class="p_error">Образец: <br />+37529 0000000<br />8029 0000000</p>
                </td>
            </tr>
            <tr>
                <td><label for="email_reg"><strong>E-mail</strong></label><br />
                    <?php
                        echo($content_view['error'][4]);
                        echo($content_view['error_email']['email']);
                    ?>
                </td>
                <td>
                    <input type="email" id="email_reg" required="required" name="email_reg"/>
                </td>
                <td class="td_error">
                    <p class="p_error">Образец: 1xvx1@mail.ru</p>
                </td>
            </tr>
            <tr>
                <td><label for="login_reg"><strong>Логин</strong></label><br />
                    <?php
                        echo($content_view['error'][5]);
                        echo($content_view['error_login']['login']);
                    ?>
                </td>
                <td>
                    <input type="text" id="login_reg" required="required" name="login_reg"/>
                </td>
                <td class="td_error" rowspan="2">
                    <p class="p_error">Логин и пароль<br />должны состоять только из символов<br />английского алфавита и цифр<br />min-6 max-18</p>
                </td>
            </tr>
            <tr>
                <td><label for="password_1_reg"><strong>Пароль</strong></label><br />
                    <?php
                        echo($content_view['error'][6]);
                    ?>
                </td>
                <td>
                    <input type="password" id="password_1_reg" required="required" name="password_1_reg"/>
                </td>
            </tr>
            <tr>
                <td><label for="password_2_reg"><strong>Повторите</strong></label><br />
                    <?php
                        echo($content_view['error'][7]);
                    ?>
                </td>
                <td>
                    <input type="password" id="password_2_reg" required="required" name="password_2_reg"/>
                </td>
                <td class="td_error">
                    <p class="p_error">Повторите пароль введенный выше</p>
                </td>
            </tr>
             <tr>
                <td><label for="capcha_reg"><strong>Капча</strong> 1 + 2 =</label></td>
                <td>
                    <input type="text" id="capcha_reg" required="required" name="capcha_reg"/>
                </td>
                <td class="td_error">
                    <p class="p_error">Введите ответ на вопрос из картинки капчи</p>
                </td>
            </tr>
            <tr class="tr_heder_footer">
                <td colspan="3" id="td_footer">
                    <input type="submit" id="submit_reg" value="Зарегестрироваться" name="submit_reg"/>
                </td>
            </tr>
        </table>
        
        
        
    </form>
</div>