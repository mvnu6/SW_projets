<?php

namespace App\Models;

use PDO;

class Brand extends CoreModel
{
    // Les propriétés propres à la table 'brand'
    protected string $name;

    // Méthode statique pour récupérer toutes les marques
    public static function findAll(): array
    {
        $pdo = self::getPDO();
        $sql = 'SELECT * FROM brand';
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    // Méthode statique pour récupérer une marque par son ID
    public static function find(int $id): ?self
    {
        $pdo = self::getPDO();
        $sql = 'SELECT * FROM brand WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchObject(self::class) ?: null;
    }

    // Méthode pour insérer une nouvelle marque dans la base de données
    public function save(): bool
    {
        // Si l'objet a un ID (modification)
        if ($this->id) {
            $sql = 'UPDATE brand SET name = :name WHERE id = :id';
            $stmt = self::getPDO()->prepare($sql);
            return $stmt->execute([
                'name' => $this->name,
                'id' => $this->id,
            ]);
        } else { // Si l'objet n'a pas d'ID (création)
            $sql = 'INSERT INTO brand (name) VALUES (:name)';
            $stmt = self::getPDO()->prepare($sql);
            return $stmt->execute([
                'name' => $this->name,
            ]);
        }
    }

    // Méthode pour supprimer une marque par son ID
    public static function delete(int $id): bool
    {
        $sql = 'DELETE FROM brand WHERE id = :id';
        $stmt = self::getPDO()->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    // Getter et setter pour la propriété 'name'
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
}
