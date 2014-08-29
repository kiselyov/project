<?php
class Model_Pagination{
    
    /**
     * 
     * @param Integer $count_element данные пользователя из формы
     * @return Integer количество элементов выводимых на странице сохраняем в 
     * куки и редерект
     */
    public function NumberElements($count_element){
        
        if(!empty($count_element)){
            setcookie('count_elem', $count_element);
            header('location: /new-progect/progect/news/index');
        }
        
        $rezult = $_COOKIE['count_elem'];
        return $rezult;
    }
    

    /**
     * 
     * @param Array $array_news массив новостей
     * @param Integer $size_array количество выводимых элементов на страницу
     * @param Integer $nomber_srt номер нужной страницы
     */
    public function Pagination($array_news, $size_array){
        
        
        if(!empty($size_array)){
            define('SIZE_ARRAY', $size_array);
        }else{
            //Количество элементов на странице по умолчанию
            define('SIZE_ARRAY', 12);
        }
        
        if(!empty($array_news)){
            
            if($array_news>0){
                $array_chank = array_chunk($array_news, SIZE_ARRAY);
            }
            
            
            //Выводим количество страниц
            $count_str = count($array_chank);
            for($i=0;$i<$count_str;$i++){
                $pages_number[] = $i+1;
            }
            
            
            return $pages_number;
        }
        
    }
    
    
    
    
}

