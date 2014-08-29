<?php
class Controller_Authorization extends Controller{
    
    public function __construct() {
        $this->view = new View();
        $this->model = new Model_Authorization();
    }
    
    public function action_index() {
        
        $this->model->Authorization();
        
        $this->model->ExitAuthorization();
        
    }

}