<?php
class Model_Search extends Model{
    
    /**
     * @return Array Поиск совпанений товаров в БД с данными пользователя 
     */
    public function QuickSearch(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        if(!empty($_POST['quick_search']) && isset($_POST['sabmit_quick_search'])){
            $name = $_POST['quick_search'];
            
            $search = $db->query("SELECT * FROM table_tovar WHERE column_name LIKE '%$name%'");
            
            foreach ($search as $value){
                $result[] = array(
                    'id'=>$value['column_id'],
                    'img'=>$value['column_img'],
                    'name'=>$value['column_name'],
                    'price'=>$value['column_price'],
                    'min_text'=>$value['column_min_text'],
                    'max_text'=>$value['column_max_text'],
                    'pk_user'=>$value['column_pk_user'],
                    'pk_categories'=>$value['column_pk_categories']
                );
            }
            return $result;
        }
        
    }
    
    
}

