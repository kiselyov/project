<?php
class Controller_Products{
    public function __construct(){
        $this->view = new View();
        $this->model = new Model_Products();
    }
    
    public function action_index(){
        
        $products = $this->model->OutProducts();
        $detalies = $this->model->Product();
        $url_image = $this->model->UrlBigImages();
        $buy_product = $this->model->BuyProduct();
        
        
        $content_view = array(
            'products'=>$products,
            'detalies'=>$detalies,
            'url_image'=>$url_image,
            'buy_product'=>$buy_product
            );
        
        $this->view->generate($content_view, 'view_template.php');
    }
}

