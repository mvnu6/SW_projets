<?php

namespace App\Models;

use App\Utils\Database;

class Category extends CoreModel
{
    protected string $name;
    protected ?string $subtitle;
    protected ?string $picture;
    protected int $home_order;

    // Cette méthode est statique pour correspondre à CoreModel
    public static function findAll(): array
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM category';
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    // Cette méthode est statique pour correspondre à CoreModel
    public static function find(int $id): ?self
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM category WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchObject(static::class);
    }

    // Méthode personnalisée pour la page d'accueil
    public static function findAllForHomePage(): array
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM category WHERE home_order > 0 ORDER BY home_order';
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    // Getters and Setters...
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(?string $subtitle): void
    {
        $this->subtitle = $subtitle;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): void
    {
        $this->picture = $picture;
    }

    public function getHomeOrder(): int
    {
        return $this->home_order;
    }

    public function setHomeOrder(int $home_order): void
    {
        $this->home_order = $home_order;
    }
}

