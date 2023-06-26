<?php

namespace App;

use PDO;
use App\Auth;

class App {

    public static $pdo;
    public static $auth;

    public static function getPDO(): PDO
    {
        if(!self::$pdo) {
            self::$pdo = new PDO('sqlite:../data.sqlite', null, null, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return self::$pdo;
    }

    public static function getAuth(): Auth
    {
        if(!self::$auth) {
            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }
            self::$auth = new Auth(self::getPDO(), '/login.php', $_SESSION);
        }

        return self::$auth;
    }
    
}