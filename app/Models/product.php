<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Product extends CoreModel
{
    private ?int $type_id;    // Identifiant du type
    private string $name;     // Nom du produit
    private ?string $picture; // URL de l'image
    private string $color;    // Couleur du produit
    private float $price;     // Prix du produit
    private int $rate;        // Note (1 à 5)
    private int $status;      // Statut du produit
    private int $brand_id;    // Identifiant de la marque
    private ?int $category_id; // Identifiant de la catégorie


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

    public function getType_Id(): int
    {
        return $this->type_id;
    }

    public function setType_Id(int $type_id): void
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

    public static function findByType(int $typeId): array{
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM product WHERE type_id = :typeId';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':typeId', $typeId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);

    }

    public static function findByBrand(int $brandId): array{
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM product WHERE brand_id = :brandId';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':brandId', $brandId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);

    }

    
    public static function findAll(): array
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM product';
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}
