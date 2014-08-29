<?php
class Controller_User extends Controller{
    
    public function __construct() {
        $this->view = new View();
        $this->model = new Model_User();
        $this->message = new Model_Message();
    }
    
    public function action_index() {
        $this->model->SaveTextInfoUser();
        $this->model->UpdateDataUser();
        $this->model->UpdateContactsUser();
        $this->model->DeleteContactsUser();
        $this->model->RedirectSaveAvatar();
        
        $save_message = $this->message->NewMessage();
        if($save_message){
            header('location: /new-progect/progect/user/index');
            die();
        }
        
        $pages_user = $this->model->OutPagesUser();
        $data_user_array = $this->model->ArrayDataUser();
        $url_avatar = $this->model->OutAvatar();
        
        $content_view = array(
            'pages_user'=>$pages_user, 
            'data_user'=>$data_user_array,
            'url_ava'=>$url_avatar);
        
        $this->view->generate($content_view, 'view_template.php');
    }
}

