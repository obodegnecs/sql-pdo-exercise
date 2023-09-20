<?php

namespace MEPDatabaseTask\repositories;

use \MEPDatabaseTask\models\Product;
use PDO;

class ProductRepository
{
    public PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(Product $product): bool
    {
        $sql = "INSERT INTO products ";
        $sql .= "(name, category, description) ";
        $sql .= "VALUES (?, ?, ?);";

        return $this->pdo->prepare($sql)->execute([
            $product->name,
            $product->category,
            $product->description
        ]);
    }

    public function update(Product $product): bool
    {
        $sql = "UPDATE products ";
        $sql .= "SET name = ?, category = ?, description = ? ";
        $sql .= "WHERE id = ?";

        return $this->pdo->prepare($sql)->execute([
            $product->name,
            $product->category,
            $product->description,
            $product->id]
        );
    }

    public function get(int $id): bool|\PDOStatement
    {
        $sql = "SELECT * ";
        $sql .= "FROM products WHERE id = ?;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);

        return $stmt;
    }

    public function getAll(int $page_number = 1): bool|\PDOStatement
    {
        $product_limit = 10;
        $limit_starting_point = $page_number * $product_limit - $product_limit;

        $sql = "SELECT * ";
        $sql .= "FROM products LIMIT ?, ?;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$limit_starting_point, $product_limit]);

        return $stmt;
    }
}