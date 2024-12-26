<?php

namespace App\Models;

use PDO;
use App\Utils\Database;

class Product
{
    private int $id;
    private string $name;
    private ?string $picture;
    private string $color;
    private float $price;
    private int $rate;
    private int $status;
    private string $created_at;
    private ?string $updated_at;
    private int $brand_id;
    private ?int $category_id;
    private int $type_id;

    // Méthode pour récupérer un produit par son ID
    public static function find(int $id): ?Product
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM product WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchObject(self::class);

        return $result ?: null;
    }

    // Méthode pour récupérer tous les produits
    public static function findAll(): array
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM product';
        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    // Getters et setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): void
    {
        $this->picture = $picture;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getRate(): int
    {
        return $this->rate;
    }

    public function setRate(int $rate): void
    {
        $this->rate = $rate;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function getBrandId(): int
    {
        return $this->brand_id;
    }

    public function setBrandId(int $brand_id): void
    {
        $this->brand_id = $brand_id;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(?int $category_id): void
    {
        $this->category_id = $category_id;
    }

    public function getTypeId(): int
    {
        return $this->type_id;
    }

    public function setTypeId(int $type_id): void
    {
        $this->type_id = $type_id;
    }

    public static function findByCategory(int $categoryId): array
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM product WHERE category_id = :categoryId';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}
