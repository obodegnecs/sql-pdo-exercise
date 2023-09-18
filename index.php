<?php
session_start();
use \MEPDatabaseTask\repositories\ProductRepository;

require __DIR__ . '/vendor/autoload.php';
require 'functions.php';

$pdo = dbConnect();
$product_repository = new ProductRepository();

$pages = numberOfPages();
$current_page = $_GET['currentPage'] ?? 1;

$products = $product_repository->getAll($current_page);
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
          crossorigin="anonymous">
    <title>PHP Mentored Education Program, Module 10: SQL, PDO</title>
</head>
<body class="pt-5">
<div class="container">
    <div class="shadow-lg p-3 mb-5 bg-body rounded">
        <h1>PHP Mentored Education Program, Module 10: SQL, PDO</h1>
    </div>

    <div class="shadow-lg p-3 mb-5 bg-body rounded">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active disabled" aria-current="page"
                   href="index.php">List Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add-product-page.php">Add new Product</a>
            </li>
        </ul>
    </div>

    <div class="shadow-lg p-3 mb-5 bg-body rounded">
        <h2>
            Products
        </h2>
        <hr>
        <div id="error_msg">
            <?php
                echo "<p>" . ($_SESSION['error_msg'] ?? '') . "</p>";
                session_unset();
            ?>
        </div>
        <div id="products">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th></th>
                </tr>
            <?php
            while ($product = $products->fetch()) {
                echo "<tr>";
                echo "<th>" . $product['name'] . "</th>" ;
                echo "<th>" . $product['category'] . "</th>";
                echo "<th>" . $product['description'] . "</th>";
                echo "<th>" . $product['created_at'] . "</th>";
                echo "<th>" . $product['updated_at'] . "</th>";
                echo "<th><a href='update-product-page.php?productId=" . $product['id'] . "'>Edit</a></th>";
                echo "</tr>";
            }
            ?>
            </table>
            <?php
            for ($i = 1; $i <= $pages; $i++) {
                echo "<a href='index.php?currentPage=$i'>" . $i . "  </a>";
            }
            ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>