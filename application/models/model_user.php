<?php
class Model_User extends Model{
    
    /**
     * @return boolean Если в ссылке присутствует слово 'user' выводим TRUE 
     */
    public function OutPagesUser(){
        
        $text_in_url = 'user';
        $server_url = explode('/', $_SERVER['REQUEST_URI']);
        if(in_array($text_in_url, $server_url) && !empty($_COOKIE['login'])){
            return TRUE;
        }
    }
    
    /**
     * @return array Массив с данными пользователя ключи массива -
     * id_users, name_users, family_users, city_users, tel_users, tel_users2,
     * tel_users3, tel_users4, skype_users, email_users, login_users, info_users,
     * data_reg_user
     */
    public function ArrayDataUser(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $login = $_COOKIE['login'];
        
        if(!empty($login)){
            $query = $db->query("SELECT column_id, column_name, column_family, "
                    . "column_city, column_tel_1, column_tel_2, column_tel_3, column_tel_4, "
                    . "column_skype, column_email, column_login, column_info, column_data FROM table_user WHERE column_login = \"$login\"");
            
            foreach ($query as $value){
                
                $result = array(
                    'id_users'=>$value['column_id'],
                    'name_users'=>$value['column_name'],
                    'family_users'=>$value['column_family'],
                    'city_users'=>$value['column_city'],
                    'tel_users'=>$value['column_tel_1'],
                    'tel_users2'=>$value['column_tel_2'],
                    'tel_users3'=>$value['column_tel_3'],
                    'tel_users4'=>$value['column_tel_4'],
                    'skype_users'=>$value['column_skype'],
                    'email_users'=>$value['column_email'],
                    'login_users'=>$value['column_login'],
                    'info_users'=>$value['column_info'],
                    'data_reg_user'=>$value['column_data']
                );
            }
            return $result;
        }
    }
    
    /**
     * @return rederect Если изменение данных произашло успешно перенаправляем страницу
     */
    public function SaveTextInfoUser(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $id_user = $this->ArrayDataUser();
        $id = $id_user['id_users'];
        
        if(!empty($_POST['sumbit_textarea']) && !empty($_POST['info_user'])){
            $text = $_POST['info_user'];
            
            
            $query = $db->query("UPDATE table_user SET column_info = '$text' WHERE column_id = $id"); 
            
            if ($query){ 
                header('location: /new-progect/progect/user/index');
            }
        }elseif(!empty($_POST['sumbit_delete'])){
            
            $text = '';
            
            $query = $db->query("UPDATE table_user SET column_info = '$text' WHERE column_id = $id"); 
            
            if ($query){ 
                header('location: /new-progect/progect/user/index');
            }
        }
    }
    
    /**
     * @return rederect срабатывает перенаправление если пользователь меняет логин или город
     */
    public function UpdateDataUser(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $id_user = $this->ArrayDataUser();
        $id = $id_user['id_users'];
        
        $reg_email = '/^[\w._%+-]{2,15}+@[\w._%+-]{2,15}.[\w]{2,10}$/';
        $new_email = $_POST['email'];
        $email = preg_match($reg_email, $new_email);
        
        
        if(!empty($new_email) && isset($_POST['submit_data_user']) && $email == TRUE){
            
            $query_email = $db->query("UPDATE table_user SET column_email = '$new_email' WHERE column_id = $id"); 
        }
        if(!empty($_POST['select_city']) && isset($_POST['submit_data_user'])){
            
            $city = $_POST['select_city'];
            $query_sity = $db->query("UPDATE table_user SET column_city = '$city' WHERE column_id = $id"); 
        }
        if($query_email || $query_sity){
            header('location: /new-progect/progect/user/index');
        }
        
    }
    
    
     /**
     * @return rederect срабатывает перенаправление если пользователь меняет контакты
     */
    public function UpdateContactsUser(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $id_user = $this->ArrayDataUser();
        $id = $id_user['id_users'];
        
        $regs_tel ='/^(\+?)([0-9]{4,5})\s[0-9]{7}$/';
        
        if(!empty($_POST['tel_1']) && preg_match($regs_tel, $_POST['tel_1'])){$tel1 = $_POST['tel_1'];}
        if(!empty($_POST['tel_2']) && preg_match($regs_tel, $_POST['tel_2'])){$tel2 = $_POST['tel_2'];}
        if(!empty($_POST['tel_3']) && preg_match($regs_tel, $_POST['tel_3'])){$tel3 = $_POST['tel_3'];}
        if(!empty($_POST['tel_4']) && preg_match($regs_tel, $_POST['tel_4'])){$tel4 = $_POST['tel_4'];}
        $skype = $_POST['skype'];
        
        if(!empty($tel1) && isset($_POST['submit_red_contacts'])){
            
            $query_tel1 = $db->query("UPDATE table_user SET column_tel_1 = '$tel1' WHERE column_id = $id"); }
            
        if(!empty($tel2) && isset($_POST['submit_red_contacts'])){
            
            $query_tel2 = $db->query("UPDATE table_user SET column_tel_2 = '$tel2' WHERE column_id = $id"); }
            
        if(!empty($tel3) && isset($_POST['submit_red_contacts'])){
            
            $query_tel3 = $db->query("UPDATE table_user SET column_tel_3 = '$tel3' WHERE column_id = $id"); }
            
        if(!empty($tel4) && isset($_POST['submit_red_contacts'])){
            
            $query_tel4 = $db->query("UPDATE table_user SET column_tel_4 = '$tel4' WHERE column_id = $id"); }
            
        if(!empty($skype) && isset($_POST['submit_red_contacts'])){
            
            $query_skype = $db->query("UPDATE table_user SET column_skype = '$skype' WHERE column_id = $id"); }
            
        if($query_tel1 || $query_tel2 || $query_tel3 || $query_tel4 || $query_skype){
            header('location: /new-progect/progect/user/index');
        }
        
    }
    
    
    /**
     * @return rederect перенаправление после удаления контакта
     */
    public function DeleteContactsUser(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $id_user = $this->ArrayDataUser();
        $id = $id_user['id_users'];
        $text = '';
        
        if(isset($_POST['tel2_del'])){
            
            $del1= $db->query("UPDATE table_user SET column_tel_2 = '$text' WHERE column_id = $id"); 
        }
        if(isset($_POST['tel3_del'])){
            
            $del2 = $db->query("UPDATE table_user SET column_tel_3 = '$text' WHERE column_id = $id"); 
        }
        if(isset($_POST['tel4_del'])){
            
            $del3 = $db->query("UPDATE table_user SET column_tel_4 = '$text' WHERE column_id = $id"); 
        }
        if(isset($_POST['skype_del'])){
            
            $del4 = $db->query("UPDATE table_user SET column_skype = '$text' WHERE column_id = $id"); 
        }
        if($del1 || $del2 || $del3 || $del4){
            header('location: /new-progect/progect/user/index');
        }
    }
    
    
    /**
     * 
     * @return array Сохраняем оригинальную картинку и создаем новую
     * array[0] - новая картинка
     * array[1] - оригинал картинка
     */
    public function SaveAvatar(){
        $file = $_FILES['file_img']['name'];
        
        if(!empty($file)){
           
            $path_directory_file = 'img/user-avatar/'.$file;
            
            if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)|(gif)|(GIF)|(png)|(PNG)$/',$file)){
                move_uploaded_file($_FILES['file_img']['tmp_name'], $path_directory_file);
                
                if(preg_match('/[.](GIF)|(gif)$/', $file)) {
                    $im = imagecreatefromgif($path_directory_file);
                }
                if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/', $file)) {
                    $im = imagecreatefromjpeg($path_directory_file);
                }
                if(preg_match('/[.](PNG)|(png)$/', $file)) {
                    $im = imagecreatefrompng($path_directory_file);
                }   
                return array($im, $file);
            }
        }
        
    }
    
    /**
     * 
     * @return string создаем картинку нужного размера, накладываем оригинальное 
     * изображение на новое, сохраняем, удаляем оригинал и 
     * выводимодим URL - новой картинки 
     */
    public function NewImagesAvatar(){
        
        $array = $this->SaveAvatar();
        $im = $array[0];
        
        if(isset($im)){
            
            $size = 150;
            $width = imagesx($im);
            $height = imagesy($im);
            $coordinate_w = round((max($width,$height)-min($width,$height))/2);
            $min = min($width,$height);
            $new_img = imagecreatetruecolor($size, $size);
        
            if ($width > $height){
                imagecopyresampled($new_img, $im, 0, 0, $coordinate_w, 0, $size, $size, $min, $min);
            }
            if ($width < $height){
                imagecopyresampled($new_img, $im, 0, 0, 0, 0, $size, $size, $min, $min);
            }
            if ($width == $height){
                imagecopyresampled($new_img, $im, 0, 0, 0, 0, $size, $size, $width, $height);
            }

            $time = time();
            $path_directory = 'img/user-avatar/'.$time.".jpg";
            imagejpeg($new_img, $path_directory);
            $directory = 'img/user-avatar/'.$array[1];
            unlink($directory);
            
            return $path_directory;
        }
    }
    
    /**
     * 
     * @return boolean Сохраняем URL нужного нам изображения в БД
     * если перезаписываем. Старое изображение удаляем
     */
    public function SaveImgAvatarDB(){
        
        $id = $this->ArrayDataUser();
        $id_user = $id['id_users'];
        
        $url_avatar = $this->NewImagesAvatar();
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $query = $db->query("SELECT column_pk_user, column_url FROM table_avatar WHERE column_pk_user = \"$id_user\"");
        
        foreach ($query as $value){
            $pk_user = $value['column_pk_user'];
            $delete_url = $value['column_url'];
        }
        if(empty($pk_user[0])){
            if(!empty($id_user) && !empty($url_avatar)){
                $prepsre = $db->prepare("INSERT INTO table_avatar (column_pk_user, column_url) VALUES (:column_pk_user, :column_url)");

                $array = array(
                    'column_pk_user'=>$id_user,
                    'column_url'=>$url_avatar
                );
                return $prepsre->execute($array);
            }
            
        }elseif(!empty($pk_user[0])){
            if(!empty($url_avatar)){
                
                $query = $db->query("UPDATE table_avatar SET column_url = '$url_avatar' WHERE column_pk_user = $id_user"); 
                unlink($delete_url);
                return $query;
            }
        }  
    }
    
    /**
     * @return rederect Если сохранение картинки прошло успешно - редерект
     */
    public function RedirectSaveAvatar(){
        if($this->SaveImgAvatarDB()){
            header('location: /new-progect/progect/user/index');
        }
    }
    
    /**
     * 
     * @return string Выводим URL аватарки пользователя если она существует и
     * выводим картинку "нет_авы" - если картинки нет или адрес не существуют 
     */
    public function OutAvatar(){
        $id = $this->ArrayDataUser();
        $id_user = $id['id_users'];
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $query = $db->query("SELECT column_url FROM table_avatar WHERE column_pk_user = \"$id_user\"");
        foreach ($query as $value){
            $delete_url = $value['column_url'];
        }
        
        $no_ava = './../img/no-avatar/no-avatar.jpg';
        $new_ava = './../'.$delete_url;
        
        
        if(!empty($delete_url[0])){
            return $new_ava;
            
        }elseif(empty($delete_url[0])){
            return $no_ava;
        }
        if(file_exists($new_ava)){
            return $no_ava;
        }
    }
    
    
}