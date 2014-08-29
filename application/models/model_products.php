<?php
class Model_Products extends Model{
    
    /**
     * 
     * @return array Выводим массив с данными товаров которые выбираются по URL товара и ID
     */
    public function OutProducts(){
        
        $url = $_SERVER['REQUEST_URI'];
        
        $s = explode('?', $url);
        $name = explode('=', $s[1]);
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $query = $db->query("SELECT column_id FROM table_categories WHERE column_id = \"$name[1]\"");
        foreach ($query as $value){
            $id = $value['column_id'];
        }
        
        $products = $db->query("SELECT * FROM table_tovar WHERE column_pk_categories = \"$id\"");
        foreach ($products as $value){
            $rezult[] = array(
                'id'=>$value['column_id'],
                'img'=>$value['column_img'],
                'name'=>$value['column_name'],
                'price'=>$value['column_price'],
                'min_text'=>$value['column_min_text'],
                'max_text'=>$value['column_max_text'],
                'pk_categories'=>$value['column_pk_categories']
            );
        }
        
        if(count($rezult) !== 0){
            return $rezult;
        }
    }
    
    /**
     * 
     * @return Array Массив товара с конкретным id
     */
    public function Product(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $id = !empty($_GET['product'])?$_GET['product']:FALSE;
        
        if($id != FALSE){
            
            $product = $db->query("SELECT * FROM table_tovar WHERE column_id = \"$id\"");
            
            foreach ($product as $value){
                
                $rezult = array(
                    'id'=>$value['column_id'],
                    'img'=>$value['column_img'],
                    'name'=>$value['column_name'],
                    'price'=>$value['column_price'],
                    'min_text'=>$value['column_min_text'],
                    'max_text'=>$value['column_max_text'],
                    'pk_categories'=>$value['column_pk_categories']
                );
            }
            return $rezult;
        }
    }
    
    
    /**
     * 
     * @return Array массив совсеми именами товаров и их id
     */
    public function AllProducrs(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $query = $db->query("SELECT column_id, column_name FROM table_tovar");
        
        foreach ($query as $value){
            $result[] = array(
                'id'=>$value['column_id'],
                'name'=>$value['column_name']
            );
        }
        return $result;
    }
    
    /**
     * 
     * @return Array массив url-ов всех больших картинок конкретного пользователя
     */
    public function UrlBigImages(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $id = $_GET['product'];
        
        if(isset($id)){
            $query = $db->query("SELECT column_url FROM table_images WHERE column_pk_tovar = \"$id\"");
            foreach ($query as $value){
                $array[] = $value['column_url'];
            }
            if(count($array)>0){
                return $array;
            }
            
        }
    }
    
    /**
     * Выводим массив с пользователями которые продают товар с этим id
     */
    public function BuyProduct(){
        //ID товара
        $id = isset($_POST['id_tovar'])?$_POST['id_tovar']:FALSE;
        //Город пользователя
        $sity_user = isset($_POST['sity_user'])?$_POST['sity_user']:FALSE;
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        if($id !== FALSE && $sity_user !== FALSE){
            $query =$db->query("SELECT column_pk_user FROM table_buy WHERE column_pk_tovar = \"$id\"");
            foreach ($query as $value){
                $id_user[] = $value['column_pk_user'];
            }
        }
        
        for($i=0;$i<count($id_user);$i++){

            $db_user = $db->query("SELECT * FROM table_user WHERE column_id = \"$id_user[$i]\" AND column_city = \"$sity_user\"");
            foreach ($db_user as $value){
                $array[] = array(
                    'name'=>$value['column_name'],
                    'family'=>$value['column_family'],
                    'city'=>$value['column_city'],
                    'tel_1'=>$value['column_tel_1'],
                    'tel_2'=>$value['column_tel_2'],
                    'tel_3'=>$value['column_tel_3'],
                    'tel_4'=>$value['column_tel_4'],
                    'skype'=>$value['column_skype'],
                    'email'=>$value['column_email'],
                    'info'=>$value['column_info'],
                    'data'=>$value['column_data']
                    );
            }
        }
        if(count($id_user)>0){
            return $array;
        }
    }
    
    
    /**
     * 
     * @return boolean Сохраняем новый товар
     */
    public function SaveProduct($url_img){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $name_categories = $_POST['categories'];
        if(isset($name_categories) && isset($_POST['new_product']) && 
                isset($_POST['price_product']) && isset($_POST['min_text']) &&
                isset($_POST['max_text'])){
            
            
            $query = $db->query("SELECT column_id FROM table_categories WHERE column_name = \"$name_categories\"");
            
            foreach ($query as $value){
                $rezult = $value['column_id'];
            }
            
            $prepare = $db->prepare("INSERT INTO table_tovar (column_name, column_price, column_min_text, column_max_text, column_pk_categories, column_img) VALUES (:column_name, :column_price, :column_min_text, :column_max_text, :column_pk_categories, :column_img)");
            
            $array = array(
                'column_name'=>$_POST['new_product'],
                'column_price'=>$_POST['price_product'],
                'column_pk_categories'=>$rezult,
                'column_min_text'=>$_POST['min_text'],
                'column_max_text'=>$_POST['max_text'],
                'column_img'=>$url_img
            );
            
            return $prepare->execute($array);
        }
    }
    
    /**
     * @return header Если сохранение товара прошло успешно перезагружаем страницу
     */
    public function RedirectSaveProduct($boolean){
        if($boolean == TRUE){
            header('location: /new-progect/progect/admin/tovar');
            die();
        }
    }
}

