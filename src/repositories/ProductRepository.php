<?php

namespace MEPDatabaseTask\repositories;

use \MEPDatabaseTask\models\Product;

class ProductRepository
{
    public function save(Product $product): void
    {
        global $pdo;

        $sql = "INSERT INTO products ";
        $sql .= "(name, category, description) ";
        $sql .= "VALUES (?, ?, ?);";

        $pdo->prepare($sql)->execute(
            [$product->name, $product->category, $product->description]
        );
    }

    public function update(Product $product): void
    {
        global $pdo;

        $sql = "UPDATE products ";
        $sql .= "SET name = ?, category = ?, description = ? ";
        $sql .= "WHERE id = ?";

        $pdo->prepare($sql)->execute(
            [$product->name,
            $product->category, $product->description, $product->id]
        );

    }

    public function get(int $id): bool|\PDOStatement
    {
        global $pdo;

        $sql = "SELECT * ";
        $sql .= "FROM products WHERE id = ?;";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        return $stmt;
    }

    public function getAll(int $page_number = 1): bool|\PDOStatement
    {
        global $pdo;

        $product_limit = 10;
        $limit_starting_point = $page_number * $product_limit - $product_limit;

        $sql = "SELECT * ";
        $sql .= "FROM products LIMIT ?, ?;";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$limit_starting_point, $product_limit]);

        return $stmt;
    }
}