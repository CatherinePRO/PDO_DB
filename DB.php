<?php
/**
 * PDO Database connection
 */

class DB{  

    public static $dsn = 'mysql:host=localhost;
                        dbname=nameDatabase;
                        charset=utf8';
    
    public static $user = 'userNameDB';
    public static $pass = 'userPasswordDB';
    
    
    public static $driverOpts = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    
    private static $db;

    final private function __construct() {}
    final private function __clone() {}
  
    /**
     * 
     * connection DB
     */
    public static function connect() {
        try {
                if(is_null(self::$db)){        
                    self::$db = new PDO(self::$dsn,
                                self::$user,
                                self::$pass,
                                self::$driverOpts);
                }

                self::$db->exec("set names utf8");

                return self::$db;
        }
        catch (PDOException $e){
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    } 
    
/**
 * 
 *     принимает (string) sql запрос на выбоку данных возвращает массив
 * 
 */
    public static function query($sql) {
        
        $db = DB::connect();
        
        $sth = $db->query($sql);
        $result = $sth->fetchAll();
        
        //закрытие подключения
        $sth = null;
        $db = null;
        
        return $result;
    }
 }
