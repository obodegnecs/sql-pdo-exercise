<?php
session_start();

use MEPDatabaseTask\models\Product;
use MEPDatabaseTask\models\ProductForm;
use MEPDatabaseTask\repositories\ProductRepository;

require __DIR__ . '/vendor/autoload.php';
require 'functions.php';

$pdo = dbConnect();
$product_repository = new ProductRepository($pdo);

if (!empty($_POST)) {
    $product_form = new ProductForm(
        $_POST['productName'],
        $_POST['productCategory'],
        $_POST['description'],
        $_POST['productId']
    );

    if ($product_form->validate()) {

        $product = new Product(
            $_POST['productName'],
            $_POST['productCategory'],
            $_POST['description'],
            $_POST['productId']
        );

        $product_repository->update($product);
    } else {
        $_SESSION['error_msg'] = "Unsuccessful update!";
    }
    header('Location: index.php', true, 301);
    exit();
} elseif (isset($_GET['productId'])) {
    $row = $product_repository->get($_GET['productId']);
    if ($row = $row->fetch()) {
        $product = new Product(
            $row['name'],
            $row['category'],
            $row['description'] ?? '', $row['id']
        );
    } else {
        header('Location: update-product-page.php?productId=1');
        exit();
    }
} else {
    header('Location: index.php?noId=true', true, 301);
    exit();
}
