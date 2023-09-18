<?php
session_start();

use MEPDatabaseTask\models\Product;
use MEPDatabaseTask\models\ProductForm;
use MEPDatabaseTask\repositories\ProductRepository;

require __DIR__ . '/vendor/autoload.php';
require 'functions.php';

$pdo = dbConnect();

if (!empty($_POST)) {
    $product_form = new ProductForm();

    if ($product_form->validate(
        $_POST['productName'], $_POST['productCategory'],
        $_POST['description']
    )
    ) {

        $product = new Product(
            $_POST['productName'], $_POST['productCategory'],
            $_POST['description']
        );

        $product_repository = new ProductRepository();
        $product_repository->save($product);
    } else {
        $_SESSION['error_msg'] = "Unsuccessful save!";
    }
}

header('Location: index.php', true, 301);
exit();
