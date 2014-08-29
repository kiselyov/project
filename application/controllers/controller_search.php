<?php
class Controller_Search extends Controller{
    
    public function __construct(){
        $this->view = new View();
        $this->model = new Model_Search();
        $this->product = new Model_Products();
    }
    
    public function action_index(){
        $search = $this->model->QuickSearch();
        $detalies = $this->product->Product();
        $url_image = $this->product->UrlBigImages();
        $buy_product = $this->product->BuyProduct();
        
        $content_view = array(
            'search'=>$search,
            'detalies'=>$detalies,
            'url_image'=>$url_image,
            'buy_product'=>$buy_product
        );
        
        $this->view->generate($content_view, 'view_template.php');
    }
}

