<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Type extends CoreModel
{
    // Changer de 'private' à 'protected'
    protected ?string $name; // Pas de type explicite
    protected ?string $created_at; // Pas de type explicite
    protected ?string $updated_at; // Pas de type explicite

    public static function findAll(): array
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM type';
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    // Getter pour $id
    public function getId(): int
    {
        return $this->id;
    }

    // Getter pour $name
    public function getName(): string
    {
        return $this->name;
    }

    // Getter pour $created_at
    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    // Getter pour $updated_at
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    // Méthode pour récupérer tous les types

    // Méthode pour récupérer un type par son ID
    public static function find(int $id): ?Type
    {
        $pdo = Database::getPDO(); // Récupérer l'objet PDO
        $sql = 'SELECT * FROM type WHERE id = :id'; // Requête SQL avec paramètre
        $stmt = $pdo->prepare($sql); // Préparer la requête
        $stmt->execute(['id' => $id]); // Exécuter la requête avec l'ID
        $type = $stmt->fetchObject(self::class); // Récupérer le résultat sous forme d'objet Type
        return $type ?: null; // Retourner l'objet trouvé ou null si non trouvé
    }

    // Méthode pour insérer un nouveau type
    public function insert(): bool
    {
        $pdo = Database::getPDO(); // Récupérer l'objet PDO
        $sql = 'INSERT INTO type (name, created_at, updated_at) VALUES (:name, :created_at, :updated_at)'; // Requête SQL d'insertion
        $stmt = $pdo->prepare($sql); // Préparer la requête
        $stmt->execute([
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]); // Exécuter l'insertion
        return $stmt->rowCount() > 0; // Retourner true si l'insertion a réussi
    }

    // Méthode pour mettre à jour un type
    public function update(): bool
    {
        $pdo = Database::getPDO(); // Récupérer l'objet PDO
        $sql = 'UPDATE type SET name = :name, updated_at = :updated_at WHERE id = :id'; // Requête SQL de mise à jour
        $stmt = $pdo->prepare($sql); // Préparer la requête
        $stmt->execute([
            'name' => $this->name,
            'updated_at' => $this->updated_at,
            'id' => $this->id,
        ]); // Exécuter la mise à jour
        return $stmt->rowCount() > 0; // Retourner true si la mise à jour a réussi
    }

    // Méthode pour supprimer un type
    public function delete(): bool
    {
        $pdo = Database::getPDO(); // Récupérer l'objet PDO
        $sql = 'DELETE FROM type WHERE id = :id'; // Requête SQL de suppression
        $stmt = $pdo->prepare($sql); // Préparer la requête
        $stmt->execute(['id' => $this->id]); // Exécuter la suppression
        return $stmt->rowCount() > 0; // Retourner true si la suppression a réussi
    }
}
