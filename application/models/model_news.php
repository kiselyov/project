<?php
class Model_News extends Model{
    
    /**
     * @param array $array_url_img
     * $array_url_img[0] - это URL новое изображение
     * $array_url_img[1] - это URL оригинальное изображение
     * @return boolean Если данные сохранены успешно - TRUE
     */
    public function SaveNews($array_url_img){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        if(isset($_POST['submit_news'])){
            
            if(isset($_POST['h_news']) && isset($_POST['min_news']) && isset($_POST['max_news'])){
                
                $prepare = $db->prepare("INSERT INTO table_news (column_title, column_min_text, column_max_text, column_date, column_img_1, column_img_2) VALUES (:column_title, :column_min_text, :column_max_text, :column_date, :column_img_1, :column_img_2)");
                
                $array = array(
                    'column_title'=>$_POST['h_news'],
                    'column_min_text'=>$_POST['min_news'],
                    'column_max_text'=>$_POST['max_news'],
                    'column_date'=>date("Y,m,d"),
                    'column_img_1'=>$array_url_img[0],
                    'column_img_2'=>$array_url_img[1],
                    );
                
                return $prepare->execute($array);
            }
        }
    }
    
    /**
     * 
     * @return boolean Выводим сообщения только на ГЛАВНОЙ странице
     */
    public function OutNews(){
        $url = $_SERVER['REQUEST_URI'];
        $array_url = explode('/', $url);
        
        if(in_array('news', $array_url)){
            return TRUE;
        }
    }
    
    /**
     * @param Integer $size_array количество элементов выводимых на страницу
     * @param Integer $pages_nomber номер страницы
     * @return $array_chank[0] Массив данными новостей, разбытый на части 
     * с кол-вом элементов указанным в $size_array
     * @return $result[1] Массив с данными о всех сообщениях
     */
    public function DataNews(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        $query = $db->query("SELECT column_id, column_title, column_min_text, column_max_text, column_date, column_img_1, column_img_2 FROM table_news");
        
        foreach ($query as $value){
            $result[] = array(
                'id'=>$value['column_id'],
                'header'=>$value['column_title'],
                'min_news'=>$value['column_min_text'],
                'max_news'=>$value['column_max_text'],
                'date'=>$value['column_date'],
                'url_1'=>$value['column_img_1'],
                'url_2'=>$value['column_img_2']
            );
        }
        return $result;
    }
    
    public function CountElementPages($array, $size_array, $pages_nomber = null){
        
        if(!empty($size_array)){
            define('SIZE_ARRAY', $size_array);
        }else{
            //Количество элементов на странице по умолчанию
            define('SIZE_ARRAY', 12);
        }
        
        if($array>0){
                $array_chank = array_chunk($array, SIZE_ARRAY);
            }
        if($pages_nomber == null){
            $pages = 0;
        }else{
            $pages = $pages_nomber-1;
        }
        return $array_chank[$pages];
    }

        /**
     * @return array Массив с со всеми данными, сообшения которое было выбранно по ID
     */
    public function DetailsNews($id_news){
        
        if(!empty($id_news)){
            $id = $id_news;
            
            $config = new ConfigDB();
            $db = $config->Configdb();
            
            $query = $db->query("SELECT column_title, column_max_text, column_date, column_img_1, column_img_2 FROM table_news WHERE column_id = \"$id\"");
            
            foreach ($query as $value){
                $result = array(
                    'header'=>$value['column_title'],
                    'max_news'=>$value['column_max_text'],
                    'date'=>$value['column_date'],
                    'url_1'=>$value['column_img_1'],
                    'url_2'=>$value['column_img_2']
                    );
            }
            return $result;
        }
    }
    
    /**
     * @return array $result -  массив всех новостей выбранных по дате
     */
    public function DateNews($date){
        
        if(!empty($date)){
            
            $config = new ConfigDB();
            $db = $config->Configdb();
            
            $query = $db->query("SELECT column_id, column_title, column_min_text, column_date, column_img_1, column_img_2 FROM table_news WHERE column_date = \"$date\"");
            
            foreach ($query as $value){
                $result[] = array(
                    'id'=>$value['column_id'],
                    'header'=>$value['column_title'],
                    'min_news'=>$value['column_min_text'],
                    'date'=>$value['column_date'],
                    'url_1'=>$value['column_img_1'],
                    'url_2'=>$value['column_img_2']
                );
            }
            return $result;
        }
    }
    
    
}

