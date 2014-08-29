<?php
class Model_Authorization  extends Model{
    
    /**
     * 
     * @return array Возвращаем данные из БД в виде "логинпароль"
     */
    public function LoginPassword(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $query = $db->query("SELECT column_login, column_password FROM table_user");
            foreach ($query as $value) {
                $result[] = $value['column_login'] . $value['column_password'];
                
            }
            return $result;
    }

    /**
     * 
     * @return string/boolean сверяем все логины из БД с логином POST если успешно
     * возвращаем логин если нет FALSE
     */
    public function LoginPasswCheck(){
        
        $login_password_db = $this->LoginPassword();
        
        if(isset($_POST['login_auth']) && !empty($login_password_db) && isset($_POST['sabmit_auth'])){
            
            if(isset($_POST['passw_auth'])){
            
                $md_password = md5($_POST['passw_auth']);
                $str = $_POST['login_auth'] . $md_password;
                $result = in_array($str, $login_password_db);
                
                    if($result === TRUE){
                        return $_POST['login_auth'];
                    }else{
                        return FALSE;
                    }
            }
        }
    }
    
    /**
     * @return header()|cookie Если логин и пароль пользователя совпали с 
     * данными из БД то сохраняем куки и делаем перенаправление на страницу USER
     * если не совпали то возвращаем на страницу с которой пользователт пришел
     */
    public function Authorization(){

            $login_password = $this->LoginPasswCheck();

            if(!empty($login_password)){
                
                setcookie('login', $login_password, time()+3600*24*30, '/new-progect/progect/');
                header('location: /new-progect/progect/user/index');
                
            }else{
                $url = $_SERVER['HTTP_REFERER'];
                header('location:' . $url);
                
            }
    }
    
    /**
     * 
     * @return redirect Если нажата кнопка выход удаляем куки и перенаправляем 
     * страницу туда от куда пришел пользователь
     */
    public function ExitAuthorization(){
        
        if(isset($_POST['sabmit_exit'])){
            
            setcookie('login', $login_password, time()-3600, '/new-progect/progect/');
            $url = $_SERVER['HTTP_REFERER'];
            header('location:' . $url);
            die();
        }
        
    }
}

