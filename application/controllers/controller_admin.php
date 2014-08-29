<?php
class Controller_Admin extends Controller{
    
    public function __construct(){
        $this->view = new View();
        $this->model = new Model_Admin();
        $this->mainmenu = new Model_MainMenu();
        $this->leftmenu = new Model_LeftMenu();
        $this->product = new Model_Products();
        $this->message = new Model_Message();
        $this->news = new Model_News();
    }

    public function action_index(){
        $login_admin = $this->model->ValidationAuthoriz();
        
        if(isset($login_admin)){
            $_SESSION['admin'] = $login_admin;
        }
        
        $form = $this->model->OutFormAdmin();
        
        
        $content_view = array('form'=>$form);
        $this->view->generate($content_view, 'view_template.php');
    }
    
    public function action_message(){
        //Удаление сообщения
        $this->message->DeleteMessage();
        
        $out_message = $this->model->CheckURL('admin/message');
        $old_post = $this->message->OldPost($_GET['details_message']);
        
        //Получаум массив с данными сообщений выбранных по статусу 0 - т.е. непрочитанные сообщения
        $unread_messages = $this->message->Message();
        
        $content_view = array(
            'out_message'=>$out_message,
            'unread_messages'=>$unread_messages,
            'old_post'=>$old_post
            );
        
        
        $this->view->generate($content_view, 'view_template.php');
        
       
    }
    
    public function action_allmessage(){
        //Удаление сообщения
        $this->message->DeleteMessage();
        
        $all_message = $this->message->AllMessage();
        
        $old_post = $this->message->OldPost($_GET['details_message']);
        
        $out_message = $this->model->CheckURL('admin/allmessage');
        
        $content_view = array(
            'out_message'=>$out_message,
            'unread_messages'=>$all_message,
            'old_post'=>$old_post
        );
        
        $this->view->generate($content_view, 'view_template.php');
    }
    
    public function action_section(){
        
        if($this->mainmenu->Save() || $this->mainmenu->Delete() || $this->mainmenu->Update()){
            header('location: /new-progect/progect/admin/section');
            die();
        }
        if($this->leftmenu->DeleteSection() || $this->leftmenu->DeleteCategories()){
            header('location: /new-progect/progect/admin/section');
            die();
        }
        if($this->leftmenu->UpdateCategories() || $this->leftmenu->UpdateSection()){
            header('location: /new-progect/progect/admin/section');
            die();
        }
        if($this->leftmenu->SaveSection() || $this->leftmenu->SaveCategories()){
            header('location: /new-progect/progect/admin/section');
            die();
        }
        
        $out_section = $this->model->CheckURL('admin/section');
        $categories = $this->leftmenu->Categories();
        
        $content_view = array('out_section'=>$out_section, 'categories'=>$categories);
        $this->view->generate($content_view, 'view_template.php');
        
    }
    
    public function action_tovar(){
        
        $save_images = $this->model->SaveBigImages();
        
        $url_img = $this->model->NewImagesProduct();
        $save_product = $this->product->SaveProduct($url_img);
        $this->product->RedirectSaveProduct($save_product);
        
        if($save_images == TRUE){
            header('location: /new-progect/progect/admin/tovar');
            die();
        }
        
        $out_tovar = $this->model->CheckURL('admin/tovar');
        $categories = $this->leftmenu->Categories();
        $tovars = $this->product->AllProducrs();
        
        
        $content_view = array(
            'out_tovar'=>$out_tovar, 
            'categories'=>$categories,
            'tovars'=>$tovars,
            'save_images'=>$save_images
            );
        
        $this->view->generate($content_view, 'view_template.php');
    }
    
    public function action_users(){
        
        //session_start();
        
        $out_users = $this->model->CheckURL('admin/users');
        
        $content_view = array('out_users'=>$out_users);
        $this->view->generate($content_view, 'view_template.php');
    }
    
    public function action_news(){
        
        $out_news = $this->model->CheckURL('admin/news');
        
        $urls_img = $this->model->NewImgNews();
        if($this->news->SaveNews($urls_img)){
            header('location: /new-progect/progect/admin/news');
        }
        
        $content_view = array('out_news'=>$out_news);
        $this->view->generate($content_view, 'view_template.php');
    }
}
