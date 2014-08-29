<?php

class Controller_Registration extends Controller{
    
     public function __construct(){
        $this->view = new View();
        $this->model = new Model_Registration();
    }
    
    public function action_index(){
        
        
        //Вывод формы регистрации
        $form_registration = $this->model->OutFormRegistration();
        
        //Вывод ошибок если поле заполнено не корректно
        $error = $this->model->OutErrorInFormReg();
        
        //Вывод ошибки если Email пользователя совпал с email из БД
        $error_email = $this->model->ErrorEmail();
        
        //Вывод ошибки если Логин пользователя совпал с Логином из БД
        $error_login = $this->model->ErrorLogin();
        
        //Вывод сообщения об успешной регистрации
        $end_registration = $this->model->EndRegistration();
        
        //Заносим все переменные в массив
        $content_view = array(
            'form_registration'=>$form_registration,
            'error'=>$error,
            'error_email'=>$error_email,
            'error_login'=>$error_login,
            'end_registration'=>$end_registration);
        
        //Выводим шаблон и подставляем данные
        $this->view->generate($content_view, 'view_template.php');
        
    }
    
}

