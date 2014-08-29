<?php
require_once 'application/classes/naw_menu.php';
$header = new NawMenu();
$header->AdminMenu();

session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT']?>/new-progect/progect/styles/all_styles.php" />
<script src="<?php $_SERVER['DOCUMENT_ROOT']?>/new-progect/progect/application/js/jquery-1.11.1.min.js"></script>
<script src="<?php $_SERVER['DOCUMENT_ROOT']?>/new-progect/progect/application/js/zoom_img.js"></script>
    
<title>new-progect</title>
</head>

<body>
    <div id="header_all">
        <div id="header_header">
            <?php
                require_once 'view_header_menu.php';
            ?>
        </div>
        <div id="header_body">
            <div id="header_form_user">
                <?php
                    if(empty($_COOKIE['login'])){
                        require_once 'view_form_authorization.php';
                    }else{
                        require 'view_user_data.php';
                    }
                ?>
            </div>
            <div id="header_logotip">логотип</div>
            <div id="header_search">
                <?php
                    require_once 'view_quick_search.php';
                ?>
            </div>
        </div>
        <div id="header_footer">
            <?php
                require_once 'view_header_mainmenu.php';
            ?>
        </div>
    </div>
    <div id="body_all">
        <div id="body_center">
            <div id="body_center_left">
                <?php
                    require_once 'view_menu_admin.php';
                    require_once 'view_left_nawmenu.php';
                ?>
            </div>
            <div id="body_center_right">
                <?php
                
                    if($content_view['form_registration'] === TRUE){
                        //Выводим HTML форму авторизации
                        require_once 'view_form_registration.php';
                    }
                    if($content_view['pages_user'] === TRUE){
                        //Вывод HTML данных на странице пользователя
                        require_once 'view_user_pages.php';
                    }
                    
                    //Вывод новостей
                    require_once 'view_block_news.php';
                    
                    //Вывод форма регистрации админа
                    require_once 'view_form_admin.php';
                    
                    //Выыод товар на главную страницу
                    require_once 'view_block_product.php';
                    
                    //Подробно о товаре
                    require_once 'view_detalies_product.php';
                    
                    //Список пользователей которые продают товар
                    require_once 'view_buy_product.php';
                ?>
                
            </div>
        </div>
    </div>
    <div id="footer_all">
        <div id="footer_header">UL список связь с админом</div>
        <div id="footer_body">что нибудь когда нибудь может быть</div>
    </div>
</body>
</html>