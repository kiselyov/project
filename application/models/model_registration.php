<?php
class Model_Registration extends Model{
    
    
    /**
     * Проверяем присетствует ли в ссылке слово "registration"
     * Проверяем и есть ли что-либо в куки "login"
     * @return boolean Если слово есть а куки нет - TRUE
     */
    public function OutFormRegistration(){
        
        $text_in_url = 'registration';
        $server_url = explode('/', $_SERVER['REQUEST_URI']);
        if(in_array($text_in_url, $server_url) && empty($_COOKIE['login'])){
            return TRUE;
        }
    }
    
    
    /**
     * @params $regs регулярное выражение
     * @params $data_user данные POST из формы
     * @return boolean TRUE если данные POST совпали с регулярным выражением
     */
    public function ValidationFormReg($regs, $data_user){
        
        if(preg_match($regs, $data_user)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    
    /**
     * @params $regex регулярное выражение
     * @params $post_user - POST данные из формы регистрации полей
     * @params $post_sabmit - POST данные из формы регистрации кнопки
     * @return string - Выводит ошибку если валидация неуспешна
     */
    public function ErrorPostFormReg($regex, $post_user, $post_sabmit){
        
        if(isset($post_sabmit)){
            if($this->ValidationFormReg($regex, $post_user) !== TRUE){
                $result = 'НЕ корректно введены данные';
                return $result;
            }else{
                
            }
        }
    }
    
    
    /**
     * @return Array возвращаем массив с данными логина и email из БД
     * array[0] - массив с email
     * array[1] - массив с login
     */
    public function ArrayLoginEmailInDb(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $query = $db->query("SELECT column_email, column_login FROM table_user");
            foreach ($query as $value) {
                $array_email[] = $value['column_email'];
                $array_login[] = $value['column_login'];
            }
            $result = array($array_email, $array_login);
            return $result;
    }
    
    
    /**
     * @return Array - array['login'] если в данных POST - login что то есть и 
     * если эти данные совпали с данными из БД то выводим массив 
     * @return boolean В другом случае TRUE
     */
    public function ErrorLogin(){
        
        $login = $_POST['login_reg'];
        $array = $this->ArrayLoginEmailInDb();
        
        if(!empty($login) && !empty($array[1])){
            if(in_array($login, $array[1])){
                
                $login_error = $login .  ' уже существует';
                $result = array('login'=>$login_error);
                
                return $result;
                
            }else{
                return TRUE;
            }
        }
    }
    
    
    /**
     * @return Array - array['email'] если в данных POST - Email что то есть и 
     * если эти данные совпали с данными из БД то выводим массив 
     * @return boolean В другом случае TRUE
     */
    public function ErrorEmail(){
        
        $email = $_POST['email_reg'];
        $array = $this->ArrayLoginEmailInDb();
        
        if(!empty($email) && !empty($array[0])){
            if(in_array($email, $array[0])){
                
                $login_error = 'Вы уже зарегестрированы - авторизируйтесь';
                $result = array('email'=>$login_error);
                
                return $result;
                
            }else{
                return TRUE;
            }
        }
    }
    
    
    /**
     * @return $array - массив с ошибками полей, значения которых НЕ прошли валидацию
     * $array[0] - Ошибка: поля ИМЯ.
     * $array[1] - Ошибка: поля Фамилия.
     * $array[2] - Ошибка: поля Город.
     * $array[3] - Ошибка: поля Телефон.
     * $array[4] - Ошибка: поля Email.
     * $array[5] - Ошибка: поля Логин.
     * $array[6] - Ошибка: поля Пароль.
     * $array[7] - Ошибка: поля Повторите пароль.
     */
    public function OutErrorInFormReg(){
        
        if(isset($_POST['password_1_reg']) && isset($_POST['password_2_reg'])){
            if($_POST['password_1_reg'] !== $_POST['password_2_reg']){
                $duble_password = 'Пароль несовпал';
            }
        }
        
        $regs = '/^([A-ZА-Я]{1})([а-яa-z]{2,16})$/u';
        $regs_tel ='/^(\+?)([0-9]{4,5})\s[0-9]{7}$/';
        $regs_log_pas = '/^[A-Za-z0-9]{6,18}$/';
        $reg_email = '/^[\w._%+-]{2,15}+@[\w._%+-]{2,15}.[\w]{2,10}$/';
        
        $sabmit = $_POST['submit_reg'];
        
        $result = array(
            $this->ErrorPostFormReg($regs, $_POST['name_reg'], $sabmit),
            $this->ErrorPostFormReg($regs, $_POST['family_reg'], $sabmit),
            $this->ErrorPostFormReg($regs, $_POST['city_reg'], $sabmit),
            $this->ErrorPostFormReg($regs_tel, $_POST['tel_reg'], $sabmit),
            $this->ErrorPostFormReg($reg_email, $_POST['email_reg'], $sabmit),
            $this->ErrorPostFormReg($regs_log_pas, $_POST['login_reg'], $sabmit),
            $this->ErrorPostFormReg($regs_log_pas, $_POST['password_1_reg'], $sabmit),
            $duble_password);
            //Дописать сюда вывод капчи и ошибка если не верно
            

        return $result;  
    }

    
    /**
     * @params $regex регулярное выражение
     * @params $post_user - POST данные из формы регистрации полей
     * @params $post_sabmit - POST данные из формы регистрации кнопки
     * @return string - Выводит ошибку если валидация УСПЕШНА
     */
    public function PostDataOfFormReg($regex, $post_user, $post_sabmit){
        
        if(isset($post_sabmit)){
            if($this->ValidationFormReg($regex, $post_user) === TRUE){
                
                return $post_user;
            }
        }
    }
    
    
    /**
     * @return array - массив с данными из формы - значения которые прошли валидацию
     * $array[0] - Массив со значением ИМЯ.
     * $array[1] - Массив со значением Фамилия.
     * $array[2] - Массив со значением Город.
     * $array[3] - Массив со значением Телефон.
     * $array[4] - Массив со значением Email.
     * $array[5] - Массив со значением Логин.
     * $array[6] - Массив со значением Пароль.
     * $array[7] - Массив со значением Пароль-повтор.
     */
    public function ArrDataOfFormReg(){
        
        if($_POST['password_1_reg'] === $_POST['password_2_reg']){
        
        $regs = '/^([A-ZА-Я]{1})([а-яa-z]{2,16})$/u';
        $regs_tel ='/^(\+?)([0-9]{4,5})\s[0-9]{7}$/';
        $regs_log_pas = '/^[A-Za-z0-9]{6,18}$/';
        $reg_email = '/^[\w._%+-]{2,15}+@[\w._%+-]{2,15}.[\w]{2,10}$/';
        
        $sabmit = $_POST['submit_reg'];
            
            $array = array(
               $this->PostDataOfFormReg($regs, $_POST['name_reg'], $sabmit),
               $this->PostDataOfFormReg($regs, $_POST['family_reg'], $sabmit),
               $this->PostDataOfFormReg($regs, $_POST['city_reg'], $sabmit),
               $this->PostDataOfFormReg($regs_tel, $_POST['tel_reg'], $sabmit),
               $this->PostDataOfFormReg($reg_email, $_POST['email_reg'], $sabmit),
               $this->PostDataOfFormReg($regs_log_pas, $_POST['login_reg'], $sabmit),
               $this->PostDataOfFormReg($regs_log_pas, $_POST['password_1_reg'], $sabmit),
               $_POST['password_2_reg']
               );
        }
        return $array;
    }
    
    
    /**
     * @return boolean  TRUE - Если все данные в массиве прошли валидацию. 
     * Если логин и email не существуют в БД
     */
    public function CheckPostDataUser(){
        $array = $this->ArrDataOfFormReg();
        $login_db = $this->ErrorLogin();
        $email_db = $this->ErrorEmail();
        
        if(!empty($array[0]) && !empty($array[1]) && !empty($array[2])){
            if(!empty($array[3]) && !empty($array[4]) && !empty($array[5])){
                if(!empty($array[6]) && ($array[6] == $array[7])){
                    if($login_db === TRUE && $email_db === TRUE){
                        return TRUE;
                    }
                }
            }
        }
    }

    
    /**
     * 
     * @return boolean - Сохранение в БД - данные из формы регистрации 
     * если успешно TRUE если не null
     */
    public function SavePostDataUser(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $array = $this->ArrDataOfFormReg();
        
        if($this->CheckPostDataUser() === TRUE){
           
            $prepare = $db->prepare(
                    "INSERT INTO table_user (column_name, column_family, column_city, "
                    . "column_tel_1, column_email, column_login, column_password, "
                    . "column_data) VALUES (:column_name, :column_family, "
                    . ":column_city, :column_tel_1, :column_emails, :column_login, "
                    . ":column_password, :column_data)");
        
        
            $array_save = array(
                    'column_name'=>$array[0],
                    'column_family'=>$array[1],
                    'column_city'=>$array[2],
                    'column_tel_1'=>$array[3],
                    'column_email'=>$array[4],
                    'column_login'=>$array[5],
                    'column_password'=>md5($array[6]),
                    'column_data'=>date('Y-m-d'));

                
            return $prepare->execute($array_save);
        }
    }
    
    /**
     * 
     * @return string Если регистрация прошла успешно выводим сообщение об 
     * успешной регистрации
     */
    public function EndRegistration(){
        
        if($this->SavePostDataUser()=== TRUE){
            $result = array('Поздравляем! Вы успешно зарегестрировались');
            return $result;
        }
    }
}
