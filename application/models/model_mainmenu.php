<?php
class Model_MainMenu extends Model{
    
    /**
     * 
     * @return boolean Сохраняем в БД раздел и URL главного навигационного меню
     */
    public function Save(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        if(isset($_POST['main_menu']) && isset($_POST['url_main_menu']) && isset($_POST['sabmit_main_menu'])){
            $prepare = $db->prepare("INSERT INTO table_main_menu (column_name, column_url) VALUES (:column_name, :column_url)");
            
            $array = array(
                'column_name'=>$_POST['main_menu'],
                'column_url'=>$_POST['url_main_menu']
            );
            
            return $prepare->execute($array);
        }
    }
    
    /**
     * 
     * @return boolean удаляем стороку из БД которая соответствует выбранному разделу
     */
    public function Delete(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        if(isset($_POST['selection_delete_main_menu']) && isset($_POST['sabmit_delete_main_menu'])){
           
            $name = $_POST['selection_delete_main_menu'];
            
            return $db->query("DELETE FROM table_main_menu WHERE column_name = \"$name\"");
        }
        
    }
    
    /**
     * 
     * @return boolean изменение названия раздела или изменение URL раздела
     */
    public function Update(){ 
        
        $config = new ConfigDB();
        $db = $config->Configdb();
           
        if(isset($_POST['selection_update_main_menu']) && isset($_POST['update_main_menu']) && isset($_POST['sabmit_update_main_menu'])){
            
            $name = $_POST['selection_update_main_menu'];
            $new_name = $_POST['update_main_menu'];
            
            return $db->query("UPDATE table_main_menu SET column_name = '$new_name' WHERE column_name = \"$name\"");
        }
        if(isset($_POST['update_url']) && isset($_POST['new_url']) && isset($_POST['sabmit_new_url'])){
            
            $name = $_POST['update_url'];
            $url = $_POST['new_url'];
            
            return $db->query("UPDATE table_main_menu SET column_url = '$url' WHERE column_name = \"$name\"");
        }
    }
}

