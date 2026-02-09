<?php
namespace app\database;

use PDO;
use PDOException;
    // LOGIN = ETU003955;
    // MDP = ZkRvFN0a;
    // BASE_NAME = db_s2_ETU003955;
class Database
{
    private static $instance = null;
    
    public static function getConnection()
    {
        if (self::$instance === null) {
            $config = include __DIR__ . '/../config/config.php';
            $dbConfig = $config['database'];
            
            try {
                $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset={$dbConfig['charset']}";
                
                self::$instance = new PDO(
                    $dsn,
                    $dbConfig['user'],
                    $dbConfig['password'],
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false
                    ]
                );
                
            } catch (PDOException $e) {
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }
        
        return self::$instance;
    }
}