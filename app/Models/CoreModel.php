<?php

namespace App\Models;
use PDO;
use App\Utils\Database;

// Modele de base : c'est la classe mère dont vont hériter TOUS les models
// Cette classe n'est pas destinée à être instancié, mais seulement à être héritée
class CoreModel
{
    // Ici on veut éviter de répéter les propriétés présentes dans tous les Models
    // On factorise dans la classe "parent" de tous les Models => donc ici meme CoreModel
    // Les propriétés doivent être en protected car on veut pouvoir les utiliser dans les classe enfant (avant ça, elles etaient en private)

    protected ?int $id;
    protected ?string $created_at;
    protected ?string $updated_at;
    protected  static $pdo;
  
    protected static function getPDO()
    {
        if (is_null(self::$pdo)) {
            self::$pdo = Database::getPDO();
        }
        return self::$pdo;
    }
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the value of updated_at
     */ 
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */ 
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }
    public static function find(int $id)
    {
        $pdo = self::getPDO();
        $sql = 'SELECT * FROM ' . strtolower(get_called_class()) . ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchObject(get_called_class());
    }
}