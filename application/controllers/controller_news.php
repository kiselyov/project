<?php
class Controller_News extends Controller{
    
    public function __construct(){
        $this->view = new View();
        $this->model = new Model_News();
        $this->test = new Model_Pagination();
    }

    public function action_index(){
        $news = $this->model->OutNews();
        
        //Количество элементов выводимх на страницу новостей
        $count_element = $this->test->NumberElements($_POST['count_elem']);
        
        //Номер страницы которую выбрал пользователь
        $pages_number = $_GET['page'];
        
        //Выводи массив из всех новостей из БД
        $array_news = $this->model->DataNews();
        
        //Массив с конкретным количествой елементов(страница)
        $count_element_pages = $this->model->CountElementPages($array_news, $count_element, $pages_number);
        
        //Сохраняем в сессию номер страницы которую выбрал пользователь
        session_start();
        $_SESSION['pages_number']=$pages_number;
        
        //Пагинатор на страницу со всеми новостями сайта
        $pagination = $this->test->Pagination($array_news, $count_element);
        
        //Выводим подробную информация о выбранной новости по id
        if(isset($_GET['details_news'])){$id = $_GET['details_news'];}
        $details_id = $this->model->DetailsNews($id);
        
        //Выводим массив всех новостей выбранных по дате из БД
        if(isset($_GET['all_news'])){$date = $_GET['all_news'];}
        $array_date = $this->model->DateNews($date);
        
        
        
        
        $content_view = array(
            'news'=>$news, 'array_news'=>$count_element_pages, 'pagination'=>$pagination,
            'details'=>$details_id, 'details_date'=>$array_date, 'pages_number'=>$_SESSION['pages_number']
            );
         
        $this->view->generate($content_view, 'view_template.php');
    }
    
    
}

