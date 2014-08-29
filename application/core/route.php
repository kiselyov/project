<?php
class Route{
    
    static function start(){
        session_start();
        //Определяем свойства по умолчанию 
        //т.е. контроллер и действия по умолчанию
        $controller_name = 'Main';
        $action_name = 'index';
        
        
        $url = explode('?', $_SERVER['REQUEST_URI']);
        //Разделяем URL знаком - '/'
        $routes = explode('/', $url[0]);
        
        //Получаем имя контроллера
        if(!empty($routes[3])){//поменять 3 на 1
            //Присваиваем имя контроллера
            $controller_name = $routes[3];//поменять 3 на 1
        }
        
        //Получаем имя экшэна
        if(!empty($routes[4])){//поменять 4 на 2
            $action_name = $routes[4];//поменять 4 на 2
        }
        
        //Добовляем префиксы
        $model_name = 'Model_' . $controller_name;
        $controller_name = 'Controller_' . $controller_name;
        $action_name = 'action_' . $action_name;
        
         // подцепляем файл с классом модели (файла модели может и не быть)
        $model_file = strtolower($model_name) . '.php';
        $model_path = "application/models/" . $model_file;
        
        if(file_exists($model_path)){
            include $model_path;
        }
        
        // подцепляем файл с классом контроллера
        $controller_file = strtolower($controller_name) . '.php';
        $controller_path = "application/controllers/" . $controller_file;
        
        if(file_exists($controller_path)){
            include $controller_path;
        }
        
        // создаем контроллер
        if(class_exists($controller_name)){
        $controller = new $controller_name;
        $action = $action_name;
        
            //Вызываем метод контроллера
            if(method_exists($controller, $action)){
                $controller->$action();
            }
        }
    }
}
