
<table class="tadle" id="tadle_header">  
    <tr>  
        <td>  
            <font>
                <?php
                echo 'Добрый день! '.$content_view['data_user']['name_users'];
                echo $content_view['data_user']['family_users'];
                ?>
            </font>  
        </td>  
    </tr>  
</table>  
   
<table class="tadle">  
    <tr>  
        <!--Левый-->  
        <td class="avatar" rowspan="7">
            
            <div class="ava"><img src="<?php echo $content_view['url_ava'];?>"></div>
        </td>
        <!--Левый_конец-->  
        <td class="center_left_block">Никнейм:</td>  
        <td class="center_right_block">
            <?php
                echo $content_view['data_user']['login_users'];
            ?>
        </td>  
        <!--Правый-->  
        <td rowspan="7" valign="top">  
            <table id="table_activ">  
                <tr>  
                    <td class="td_activ">Контакты</td>  
                </tr>
                <tr>  
                    <td class="center_right_block" >
                        <?php
                            $tel_user = $content_view['data_user']['tel_users'];

                            if(!empty($tel_user)){
                                echo $tel_user;

                            }elseif(empty($tel_user)){
                                echo '<i><strong>тел:</strong> пусто</i>';
                            }
                        ?>
                    </td>
                </tr>
                <tr>  
                    <td class="center_right_block" >
                        <?php
                            $tel_user2 = $content_view['data_user']['tel_users2'];

                            if(!empty($tel_user2)){
                        ?>
                                <form method="POST">
                                    <input type="submit" name="tel2_del" value="x" class="delete_tel" title="Нажмите что бы удалить">
                                </form>
                        <?php
                                echo $tel_user2;

                            }elseif(empty($tel_user2)){
                                echo '<i><strong>тел:</strong> пусто</i>';
                            }
                        ?>
                    </td>
                </tr> 
                <tr>  
                    <td class="center_right_block">
                        
                        <?php
                            $tel_user3 = $content_view['data_user']['tel_users3'];

                            if(!empty($tel_user3)){
                        ?>
                                <form method="POST">
                                    <input type="submit" name="tel3_del" value="x" class="delete_tel" title="Нажмите что бы удалить">
                                </form>
                        <?php
                                echo $tel_user3;

                            }elseif(empty($tel_user3)){
                                echo '<i><strong>тел:</strong> пусто</i>';
                            }
                        ?>
                    </td>
                </tr>
                <tr>  
                    <td class="center_right_block">
                        
                        <?php
                            $tel_user4 = $content_view['data_user']['tel_users4'];

                            if(!empty($tel_user4)){
                        ?>
                                <form method="POST">
                                    <input type="submit" name="tel4_del" value="x" class="delete_tel" title="Нажмите что бы удалить">
                                 </form>
                        <?php
                                echo $tel_user4;

                            }elseif(empty($tel_user4)){
                                echo '<i><strong>тел:</strong> пусто</i>';
                            }
                        ?>
                    </td>
                </tr>
                <tr>  
                    <td class="center_right_block">
                        
                        <?php
                            $skype_user = $content_view['data_user']['skype_users'];

                            if(!empty($skype_user)){
                        ?>
                                <form method="POST">
                                    <input type="submit" name="skype_del" value="x" class="delete_tel" title="Нажмите что бы удалить">
                                </form>
                        <?php
                                echo $skype_user;

                            }elseif(empty($skype_user)){
                                echo '<i><strong>Skype:</strong> пусто</i>';
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </td>  
        <!--Правый_конец-->  
    </tr>  
    <tr>  
        <td class="center_left_block">Имя:</td>  
        <td class="center_right_block">
            <?php
                echo $content_view['data_user']['name_users'];
                
            ?>
        </td>  
    </tr>  
    <tr>  
        <td class="center_left_block">Фамилия:</td>  
        <td class="center_right_block">
            <?php
                echo $content_view['data_user']['family_users'];
            ?>
        </td>  
    </tr>  
    <tr>  
        <td class="center_left_block">Город:</td>  
        <td class="center_right_block">
            <?php
                echo $content_view['data_user']['city_users'];
            ?>
        </td>  
    </tr>  
    <tr>  
        <td class="center_left_block">E-mail:</td>  
        <td class="center_right_block">
            <?php
                echo $content_view['data_user']['email_users'];
            ?>
        </td>  
    </tr>  
      
    <tr>  
        <td class="center_left_block">Регистрация</td>  
        <td class="center_right_block">
            <?php
                echo $content_view['data_user']['data_reg_user'];
            ?>
        </td>  
    </tr>
</table>
<table id="table_redactor">
    <tr>
        <form method="POST" enctype="multipart/form-data">
            <td id="td_image">
                Загрузить аватарку:<br />
                <input type="file" name="file_img" accept="image/*"><br />
                <input type="submit" name="submit_file" value="ok!">
                <!--
                <input type="submit" name="submit_delete_file" value="delete">
                <input type="submit" name="submit_delete_file" value="delete">
                -->

            </td>
        </form>
        <td id="td_redact_user">
            <a href=?link_contacts=contacts>Ред. контакты</a><br />
            <a href=?link_data=data_user>Ред. Данные</a>
        </td>
        
    </tr>
</table>



<?php
    if(isset($_GET['link_data'])){
?>
<table class="redactor_contacts">
    <tr>
        <td>
            <form>
                <input type="submit" value="X" id="exit">
            </form>
            <form method="POST" id="s">
                <fieldset><legend>Радактор данных</legend>
                    <input type="text" name="email"> e-mail <br />
                    <select name="select_city">
                    <option disabled="disabled" selected="selected">невыбран</option>
                    <option>Брест</option>
                    <option>Минск</option>
                    <option>Витебск</option>
                    <option>Гомель</option>
                    <option>Гродно</option>
                    <option>Могилев</option>
                </select> Ваш Город <br />
                
                </fieldset>
                <input type="submit" name="submit_data_user" value="изменить" class="submit_redactor" title="Нажмите что бы измененить данные">
            </form>
        </td>
    </tr>
</table>
<?php
    }

    if(isset($_GET['link_contacts'])){
?>
<table class="redactor_contacts">
    <tr>
        <td>
            <form>
                <input type="submit" value="X" id="exit">
            </form>
            <form method="POST">
                <fieldset><legend>Радактор контактов</legend>
                1. <input type="text" name="tel_1"> тел <br />
                2. <input type="text" name="tel_2"> тел <br />
                3. <input type="text" name="tel_3"> тел <br />
                4. <input type="text" name="tel_4"> тел <br />
                5. <input type="text" name="skype"> Skype <br />
                </fieldset>
                <input type="submit" name="submit_red_contacts" value="сохранить" class="submit_redactor" title="Нажмите что бы сохранить или измененить данные">
            </form>
            
        </td>
    </tr>
</table>
<?php
    }
?>

<hr>

<table class="tadle">
    <tr>
        <td class="td_activ">Информация о себе - эта информация будет отображаться в разделе товаров которые вы выбрали</td>
    </tr>
    <tr>
        <td class="activ_left">
            <table id="info_user">
                <tr>
                    <td>
                        <?php
                            $info_user = $content_view['data_user']['info_users'];
                            
                            if(!empty($info_user)){
                                echo $info_user;
                                
                            }elseif(empty($info_user)){
                                echo '<strong><i>Вы еще ничего о себе не написали</i></strong>';
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
    <form method="POST">
            <td class="activ_left">
                <textarea name="info_user" id="textarea_info_user"></textarea><br />
                <?php
                    $info_user = $content_view['data_user']['info_users'];
                    if(!empty($info_user)){
                ?>
                    
                <input type="submit" name="sumbit_textarea" value="изменить">
                <input type="submit" name="sumbit_delete" value="delete">
                <?php
                    }elseif(empty($info_user)){
                ?>
                <input type="submit" name="sumbit_textarea" value="опубликовать">
                <?php
                    }
                ?>
            </td>
        </form>
    </tr>
</table>  
    
<hr>

<table class="tadle">  
    <tr>  
        <td class="td_activ">Название</td> 
        <td class="td_activ">Действие</td>  
    </tr>  
    <tr>
        <td class="activ_left"><a href="m_new_tovar">Если Вашего товара нет в нашем каталоге то Вы можете написать нам сообщение с названием товара и по возможности с максимальными техническими характеристиками. Нажмите кнопку добавить или на это текст.</a></td>
        <td class="activ_right"><a href="m_new_tovar">Добавить</a></td>  
    </tr>
</table>
<table class="tadle">
    <tr>
        <td colspan="2" class="activ_left">
            <form>
                <p>Название товара<br />
                <input type="text" name="title_new_tovar" placeholder="Название товара" required="required"></p>
                <p>Модель<br />
                <input type="text" name="model_new_tovar" placeholder="Точная модель товара Samsung USH27G510T" required="required"></p>
                <p>URL адрес официального сайта<br />
                <input type="url" name="url_new_tovar" placeholder="www.URL.ru"></p>
                <p>Описание товара<br />
                <textarea name="text_new_tovar"></textarea></p>
                <input type="submit" name="sabmit_new_tovar" value="отправить">
            </form>
        </td>
    </tr>
</table>
<table class="tadle">
    <tr>
        <td class="activ_left">Связь с администратором -></td>
        <td class="activ_right"><a href="#">Связь</a></td>  
    </tr>  
    <tr>
        <td class="activ_left">Заметили не точность? -></td>
        <td class="activ_right"><a href="#">Сообщение</a></td>  
    </tr>  
    <tr>
        <td class="activ_left">Установить метку -></td>
        <td class="activ_right"><a href="#">Товары</a></td>  
    </tr>  
</table>


