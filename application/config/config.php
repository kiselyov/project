<?php
class ConfigDB{
    /**
     * 
     * @return \PDO Подключаемся к БД
     */
    function Configdb(){
    
    $config = array(
        'host' => 'localhost',
        'user' => 'project-user',
        'password' => 'ywEtvBwSaMGqJrDc',
        'database' => 'project_final');
    
    $db = new PDO("mysql:host={$config ['host']}; dbname={$config ['database']}",
            $config ['user'], $config ['password']);
    return $db;
    
    }
}