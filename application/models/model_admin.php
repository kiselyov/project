<?php
class Model_Admin  extends Model{
    
    /**
     * 
     * @return boolean Если в URL есть слово "admin" - TRUE если нет FALSE
     */
    public function OutFormAdmin(){
        
        $url = $_SERVER['REQUEST_URI'];
        $array_url = explode('/', $url);
        
        if(in_array('admin', $array_url)){
            return TRUE;
        }else{
            return FALSE;
        }
        
    }
    /**
     * 
     * @return string Если имя и пароль в форме авторизации админа введены 
     * верно, то возвращяем ИМЯ
     */
    public function ValidationAuthoriz(){
        
        if(isset($_POST['name_admin']) && isset($_POST['password_admin'])&& isset($_POST['sabmit_admin_autoriz'])){

            $config = new ConfigDB();
            $db = $config->Configdb();
            
            $l_p = $db->query("SELECT column_id, column_login, column_password, column_status FROM table_admin");
            
            foreach ($l_p as $value){
                $array[] = $value['column_login'].$value['column_password'];
            }
            
            $form_data = $_POST['name_admin'].$_POST['password_admin'];
            
            if(!empty($array)){
                $rezult = in_array($form_data, $array);

                if($rezult === TRUE){
                    return $_POST['name_admin'];
                }
            }
        }  
    }
    
    /**
     * 
     * @param type $model_action - "контроллер/экшэн"
     * @return boolean если в URL есть "контроллер/экшэн" возвращаем TRUE 
     * если нету то FALSE
     */
    public function CheckURL($model_action){
        
        $url = $_SERVER['REQUEST_URI'];
        $array = explode('/', $url);
        $string = $array[3].$array[4];
        
        $array_m_a = explode('/', $model_action);
        $string_m_a = $array_m_a[0].$array_m_a[1];
        
        if(preg_match("/^$string_m_a/", $string)){
            if(isset($_SESSION['admin'])){
                return TRUE;
            }
        }else{
            return FALSE;
        }
    }
   //------------------РАБОТА С КАРТИНКАМИ-------------------------------------
    /**
     * 
     * @return array Сохранение картинки для конкретного товара и выводит массив
     * array[0] - это новое изображение
     * array[1] - это оригинальное изображение
     */
    public function SaveImageProduct(){
        $file = $_FILES['file']['name'];
        
        if(!empty($file)){
           
            $path = 'img/product/'.$file;
            
            if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)|(gif)|(GIF)|(png)|(PNG)$/',$file)){
                move_uploaded_file($_FILES['file']['tmp_name'], $path);
                
                if(preg_match('/[.](GIF)|(gif)$/', $file)) {
                    $im = imagecreatefromgif($path);
                }
                if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/', $file)) {
                    $im = imagecreatefromjpeg($path);
                }
                if(preg_match('/[.](PNG)|(png)$/', $file)) {
                    $im = imagecreatefrompng($path);
                }   
                return array($im, $file);
            }
        }
        
    }
    
    /**
     * 
     * @return string Выводим URL - нового изображения
     * делаем новое изображение, сохраняем его и удоляем оригинал старого изображения. 
     */
    public function NewImagesProduct(){
        
        $array = $this->SaveImageProduct();
        $im = $array[0];
        
        if(isset($im)){
            
            $size_w = 180;
            $size_h = 120;
            $width = imagesx($im);
            $height = imagesy($im);
            $coordinate_w = round((max($width,$height)-min($width,$height))/2);
            $min = min($width,$height);
            $new_img = imagecreatetruecolor($size_w, $size_h);
        
            if ($width > $height){
                imagecopyresampled($new_img, $im, 0, 0, 0, 0, $size_w, $size_h, $width, $height);
            }
            if ($width < $height){
                imagecopyresampled($new_img, $im, 0, 0, 0, 0, $size_w, $size_h, $min, $min);
            }
            if ($width == $height){
                imagecopyresampled($new_img, $im, 0, 0, 0, $coordinate_w, $size_w, $size_h, $min, $min);
            }

            $time = time();
            $path_directory = 'img/product/'.$time.".jpg";
            imagejpeg($new_img, $path_directory);
            $directory = 'img/product/'.$array[1];
            unlink($directory);
            
            return $path_directory;
        }
    }
    
    /**
     * 
     * @return boolean TRUE если URL и картинка успешно сохранена
     */
    public function SaveBigImages(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $file = $_FILES['img_big']['name'];
        $time = time();
        $path = 'img/product/'.$time.'.jpg';
        
        if(!empty($file)){
            if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)|(gif)|(GIF)|(png)|(PNG)$/',$file)){
                move_uploaded_file($_FILES['img_big']['tmp_name'], $path);
            }
            if(file_exists($path) && isset($_POST['id_products'])){
                $prepare = $db->prepare("INSERT INTO table_images (column_url, column_pk_tovar) VALUES (:column_url, :column_pk_tovar)");
                
                $array = array(
                    'column_url'=>$path,
                    'column_pk_tovar'=>$_POST['id_products']
                );
                
                return $prepare->execute($array);
            }
        }
    }
    
    //------------------Сохранение удаление изменение раздела Новостей-----------
    
    /**
     * 
     * @return array Сохранение картинки для конкретного НОВОСТИ и выводит массив
     * array[0] - это новое изображение
     * array[1] - это оригинальное изображение
     */
    public function SaveImgNews(){
        $file = $_FILES['img_news']['name'];
        
        if(!empty($file)){
           
            $path = 'img/news/'.$file;
            
            if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)|(gif)|(GIF)|(png)|(PNG)$/',$file)){
                move_uploaded_file($_FILES['img_news']['tmp_name'], $path);
                
                if(preg_match('/[.](GIF)|(gif)$/', $file)) {
                    $im = imagecreatefromgif($path);
                }
                if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/', $file)) {
                    $im = imagecreatefromjpeg($path);
                }
                if(preg_match('/[.](PNG)|(png)$/', $file)) {
                    $im = imagecreatefrompng($path);
                }   
                return array($im, $file);
            }
        }
        
    }
    
    /**
     * 
     * @return array URL - уменьшенной картинки и URL оригинальной картинки 
     * array[0] - это URL новое изображение
     * array[1] - это URL оригинальное изображение
     */
    public function NewImgNews(){
        
        $array = $this->SaveImgNews();
        $im = $array[0];
        
        if(isset($im)){
            
            $size_w = 260;
            $size_h = 135;
            $width = imagesx($im);
            $height = imagesy($im);
            $coordinate_w = round((max($width,$height)-min($width,$height))/2);
            $coordinate_h = ($size_w - $width)/2;
            $min = min($width,$height);
            $new_img = imagecreatetruecolor($size_w, $size_h);
        
            $white = imagecolorallocate($new_img, 255, 255, 255);
            imagefilltoborder($new_img, $size_w, $size_h, $white, $white);
            
            if ($width > $height){
                imagecopyresampled($new_img, $im, 0, 0, 0, 0, $size_w, $size_h, $width, $height);
            }
            if ($width < $height){
                imagecopyresampled($new_img, $im, $coordinate_h, 0, 0, 0, $min, $size_h, $width, $height);
            }
            if ($width == $height){
                imagecopyresampled($new_img, $im, 0, 0, 0, $coordinate_w, $size_w, $size_h, $min, $min);
            }
            
            $time = time();
            $path_directory = 'img/news/'.$time.".jpg";
            imagejpeg($new_img, $path_directory);
            $directory = 'img/news/'.$array[1];
            
            return array($path_directory, $directory);
        }
    }
    
    
    
}