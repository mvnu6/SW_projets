<?php

// Retenir son utilisation : Database::getPDO()
// Design Pattern : Singleton

namespace App\Utils;

use PDO;

class Database
{
    private $pdo;
    private static $_instance = null;
    private $host = 'localhost';
    private $db = 'ecom';
    private $user = 'mvnu';
    private $password = 'Af32lr77*&';
    private $charset = 'utf8mb4';

    // Constructeur privé pour empêcher une instanciation directe
    private function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->password, $options);
        } catch (\PDOException $e) {
            echo 'Erreur de connexion...<br>';
            echo $e->getMessage() . '<br>';
            echo '<pre>';
            echo $e->getTraceAsString();
            echo '</pre>';
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    // Méthode pour obtenir l'instance unique de la classe
    public static function getPDO()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance->pdo;
    }
}
