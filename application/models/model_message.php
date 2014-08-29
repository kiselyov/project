<?php
class Model_Message extends Model{
    
    /**
     * 
     * @return boolean Сохранение сообщения от пользователя с темой Добовление товара
     * если сохранение успешно то TRUE
     */
    public function NewMessage(){
        
        $title = isset($_GET['title_new_tovar'])?$_GET['title_new_tovar']:FALSE;
        $url = isset($_GET['url_new_tovar'])?$_GET['url_new_tovar']:'пусто';
        $text = isset($_GET['text_new_tovar'])?$_GET['text_new_tovar']:'пусто';
        $model = isset($_GET['model_new_tovar'])?$_GET['model_new_tovar']:FALSE;
        
        $sabmit = isset($_GET['sabmit_new_tovar']);
        
        if($title != FALSE && $model != FALSE && $sabmit == TRUE){
            $config = new ConfigDB();
            $db = $config->Configdb();
            
            $prepare = $db->prepare("INSERT INTO table_message (column_theam, column_title, column_url, column_text, column_date, column_login, column_model) VALUES (:column_theam, :column_title, :column_url, :column_text, :column_date, :column_login, :column_model)");
            
            $array = array(
                'column_theam'=>'Добавить новый товар.',
                'column_title'=>$title,
                'column_model'=>$model,
                'column_url'=>$url,
                'column_text'=>$text,
                'column_date'=> date("y-m-d G:i:s"),
                'column_login'=>$_COOKIE['login']
                );
            return $prepare->execute($array);
        }
    }
    
    /**
     * 
     * @return Array массив всех сообщений с статусом Непрочитанные - null
     */
    public function Message(){
        $config = new ConfigDB();
        $db = $config->Configdb();
        $status = null;
        
        $query = $db->query("SELECT column_id, column_theam, column_title, column_model, column_url, column_text, column_status, column_date, column_login FROM table_message WHERE column_status = \"$status\"");
        foreach ($query as $value){
            $result[] = array(
                'id'=>$value['column_id'],
                'theam'=>$value['column_theam'],
                'title'=>$value['column_title'],
                'model'=>$value['column_model'],
                'url'=>$value['column_url'],
                'text'=>$value['column_text'],
                'status'=>$value['column_status'],
                'date'=>$value['column_date'],
                'login_user'=>$value['column_login']
            );
        }
        return $result;
    }
    
    /**
     * 
     * @param string $id_message сообщение на которое пользователь кликнул для просмотра
     * @return array Меняем статус сообщения как прочитанное т.е. = 1 и возвращаем
     * массив  с данными этого сообщения
     */
    public function OldPost($id_message){
        
        $id = isset($id_message)?$id_message:FALSE;
        $config = new ConfigDB();
        $db = $config->Configdb();
        
        if($id !=FALSE){
            $db->query("UPDATE table_message SET column_status = 1 WHERE column_id = \"$id\"");
            
            $query = $db->query("SELECT column_id, column_theam, column_title, column_model, column_url, column_text, column_status, column_date, column_login FROM table_message WHERE column_id = \"$id\"");
            foreach ($query as $value){

                $result = array(
                'id'=>$value['column_id'],
                'theam'=>$value['column_theam'],
                'title'=>$value['column_title'],
                'model'=>$value['column_model'],
                'url'=>$value['column_url'],
                'text'=>$value['column_text'],
                'status'=>$value['column_status'],
                'date'=>$value['column_date'],
                'login_user'=>$value['column_login']
                );
            }
        }
        return $result;
    }
    
    /**
     * 
     * @return boolean удаляем все сообщения которые отмеченны чекбоксом
     * в случае успеха возвращаем TRUE
     */
    public function DeleteMessage(){
        
        $checkbox = isset($_POST['checkbox_message'])?$_POST['checkbox_message']:FALSE;
        $sabmit = isset($_POST['del_mesage']);
        
        if($checkbox != FALSE && $sabmit == TRUE){
            
            $config = new ConfigDB();
            $db = $config->Configdb();
            foreach ($checkbox as $value){
                
                $db->query("DELETE FROM table_message WHERE column_id = \"$value\"");
                
            }
        }
    }
    
    /**
     * 
     * @return Array Массив всех сообщений с статусом Прочитанные
     */
    public function AllMessage(){
        
        $config = new ConfigDB();
        $db = $config->Configdb();
        $status = 1;
        
        $query = $db->query("SELECT column_id, column_theam, column_title, column_model, column_url, column_text, column_status, column_date, column_login FROM table_message WHERE column_status = \"$status\"");
        foreach ($query as $value){
            $result[] = array(
                'id'=>$value['column_id'],
                'theam'=>$value['column_theam'],
                'title'=>$value['column_title'],
                'model'=>$value['column_model'],
                'url'=>$value['column_url'],
                'text'=>$value['column_text'],
                'status'=>$value['column_status'],
                'date'=>$value['column_date'],
                'login_user'=>$value['column_login']
            );
        }
        return $result;
    }
}

