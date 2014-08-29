<?php
class ConfigDB{
    /**
     * 
     * @return \PDO РџРѕРґРєР»СЋС‡Р°РµРјСЃСЏ Рє Р‘Р”
     */
    function Configdb(){
    
    $config = array(
        'host' => 'mysql.hostinger.ru',
        'user' => 'u147752636_admin',
        'password' => 'QJNQKdlTt2rM',
        'database' => 'u147752636_proj');
    
    $db = new PDO("mysql:host={$config ['host']}; dbname={$config ['database']}",
            $config ['user'], $config ['password']);
    return $db;
    
    }
}

