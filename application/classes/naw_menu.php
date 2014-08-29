<?php
class NawMenu{
    
    /**
     * 
     * @return type array Вывод главное навигационное меню в header
     */
    public function MainMenu(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $main_menu = $db->query("SELECT column_name, column_url, column_id FROM table_main_menu ORDER BY column_id");
        
        foreach ($main_menu as $value){
            $array[] = array($value['column_name'], $value['column_url'], $value['column_id']);         
        }
        return $array;
    }
    
    /**
     * @return type header если нажата ссылка в админ меню - перенаправляем на 
     * страницу этой ссылки
     */
    public function AdminMenu(){
        
        if(isset($_GET['admin'])){
            header('location: /new-progect/progect/admin/message');
            die();
        }
        if(isset($_GET['alladmin'])){
            header('location: /new-progect/progect/admin/allmessage');
        }
        if(isset($_GET['new_section'])){
            header('location: /new-progect/progect/admin/section');
            die();
        }
        if(isset($_GET['new_tovar'])){
            header('location: /new-progect/progect/admin/tovar');
            die();
        }
        if(isset($_GET['list'])){
            header('location: /new-progect/progect/admin/users');
            die();
        }
        if(isset($_GET['news'])){
            header('location: /new-progect/progect/admin/news');
        }
    }
    
    /**
     * 
     * @return Array массив - разделы левого навигационного меню
     */
    public function leftMenu(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $main_menu = $db->query("SELECT column_id, column_name FROM table_section ORDER BY column_id");
        
        foreach ($main_menu as $value){
            $array[] = array($value['column_id'], $value['column_name']);         
        }
        return $array;
    }
    
    /**
     * 
     * @return Array Массив катигории левого навигационного меню
     */
    
    public function leftCategoriesMenu($id){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $main_menu = $db->query("SELECT column_name, column_pk_section, column_id FROM table_categories WHERE column_pk_section = \"$id\"");
        
        foreach ($main_menu as $value){
            $array[] = array($value['column_name'], $value['column_id'], $value['column_pk_section']);         
        }
        return $array;
    }
    
    /**
     * 
     * @return type hesder Если нажали на ссылку в левом навигационном меню и 
     * если в URL не найденно "products" то перенаправляем на страницу "products"
     */
    public function RedirectLeftMenu(){
        
        $url = $_SERVER['REQUEST_URI'];
        $array_url = explode('/', $url);
        $rezulr = in_array('products', $array_url);
        
        if(isset($_GET['section']) && $rezulr === FALSE){
            
            $s = explode('?', $url);
            if(isset($s[1])){
                header("location: /new-progect/progect/products/?$s[1]");
                die();
            }
        }
    }
    
    
    /**
     * 
     * @return type header Если нажата кнопка "Регистряция" в меню авторизации 
     * то перенаправляем на страницу "Регистряции"
     */
    public function OutPagesRegistration(){
        
        if(isset($_GET['link'])){
            header('location: /new-progect/progect/registration/index/');
            die();
        }
    }
    
    /**
     * @return array Массив с данными пользователя ключи массива -
     * name_users, family_users, city_users, data_reg_user
     */
    public function DataUser(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $login = $_COOKIE['login'];
        
        if(!empty($login)){
            $query = $db->query("SELECT column_name, column_family, "
                    . "column_city, column_data FROM table_user WHERE column_login = \"$login\"");
            
            foreach ($query as $value){
                
                $result = array(
                    'name'=>$value['column_name'],
                    'family'=>$value['column_family'],
                    'city'=>$value['column_city'],
                    'data'=>$value['column_data']
                );
            }
            return $result;
        }
    }
    

}

$menu = new NawMenu();
$menu->RedirectLeftMenu();
$menu->OutPagesRegistration();