<?php
class Model_LeftMenu extends Model{
    
    /**
     * 
     * @return boolean Сохраняем в БД Новый Раздел левого навигационного меню
     */
    public function SaveSection(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        if(isset($_POST['new_section']) && isset($_POST['sabmit_new_section'])){
            $prepare = $db->prepare("INSERT INTO table_section (column_name) VALUES (:column_name)");
            
            $array = array(
                'column_name'=>$_POST['new_section']
            );
            
            return $prepare->execute($array);
        }
    }
    
    /**
     * 
     * @return boolean Сохраняем в БД Новую категорию в разделе левого 
     * навигационного меню
     */
    public function SaveCategories(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        
        
        if(isset($_POST['name_left_section']) && isset($_POST['new_categories']) && isset($_POST['sabmit_new_categories'])){
            
            $name = $_POST['name_left_section'];
            
            $id = $db->query("SELECT column_id FROM table_section WHERE column_name = \"$name\"");
                foreach ($id as $value){
                    $string_id = $value['column_id'];
                }
        
            $prepare = $db->prepare("INSERT INTO table_categories (column_name, column_pk_section) VALUES (:column_name, :column_pk_section)");

            $array = array(
                'column_name'=>$_POST['new_categories'],
                'column_pk_section'=>$string_id
            );

            return $prepare->execute($array);

            
        }
    }
    
    /**
     * 
     * @return Array Массив все категории левого навигационного меню
     */
    public function Categories(){
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $query = $db->query("SELECT column_name FROM table_categories");
        foreach ($query as $value){
            $array[] = $value['column_name'];
        }
        return $array;
    }
    
    /**
     * 
     * @return boolean Удаление раздела из левого меню
     */
    public function DeleteSection(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $name = $_POST['delete_name_section'];
        
        if(isset($name) && isset($_POST['sabmit_name_section'])){
           
            return $db->query("DELETE FROM table_section WHERE column_name = \"$name\"");
        }
    }
    
    /**
     * 
     * @return boolean Удаление категории из левого меню
     */
    public function DeleteCategories(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $name = $_POST['delete_name_categories'];
        
        if(isset($name) && isset($_POST['sabmit_name_categories'])){
           
            return $db->query("DELETE FROM table_categories WHERE column_name = \"$name\"");
        }
    }
    
    /**
     * 
     * @return boolean Изменение названия раздела
     */
    public function UpdateSection(){ 
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        $name = $_POST['name_section'];
        $new_name = $_POST['new_name_section'];
        $sabmit = $_POST['update_section'];
        if(isset($name) && isset($new_name) && isset($sabmit)){
            
            return $db->query("UPDATE table_section SET column_name = '$new_name' WHERE column_name = \"$name\"");
        }
    }
    
    /**
     * 
     * @return boolean Изменение названия категории или изменение URL категории
     */
    public function UpdateCategories(){ 
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        $name = $_POST['name_categories'];
        $new_name = $_POST['new_name_categories'];
        $sabmit = $_POST['update_categories'];
        $new_url = $_POST['url_categories'];
        $sabmit_url = $_POST['update_url_categories'];
        
        if(isset($name) && isset($new_name) && isset($sabmit)){
            
            return $db->query("UPDATE table_categories SET column_name = '$new_name' WHERE column_name = \"$name\"");
        }
        if(isset($name) && isset($new_url) && isset($sabmit_url)){
            
            
            return $db->query("UPDATE table_categories SET column_url = '$url' WHERE column_name = \"$name\"");
        }
    }
}