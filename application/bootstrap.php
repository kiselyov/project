<?php
require_once 'config/config.php';
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';


spl_autoload_register ('autoload');
function autoload ($className) {
  $fileName = 'models/'.strtolower($className) . '.php';
  include  $fileName;
}

echo Route::start();//Запускаем маршрутизатор


