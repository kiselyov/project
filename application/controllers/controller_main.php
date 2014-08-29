<?php
class Controller_Main extends Controller{
    
    public function __construct(){
        $this->view = new View();
        $this->model = new Model_Main();
    }
    
    public function action_index(){
        
        $this->view->generate($content_view, 'view_template.php');
        
    }
}
