<?php
    require_once 'update-process.php';
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
                <a class="nav-link active" aria-current="page" href="index.php">List Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="add-product-page.php">Add new Product</a>
            </li>
        </ul>
    </div>

    <div class="shadow-lg p-3 mb-5 bg-body rounded">
        <h2>Update product</h2>
        <hr>
        <div id="products">
            <form id="product-form" method="POST" action="update-process.php">
                <div class="mb-3">
                    <label for="productIdShowed" class="form-label">Product ID</label>
                    <?php
                        echo '<input type="text" class="form-control" name="productIdShowed" 
                        value="' . $_GET['productId'] . '" id="productIdShowed" disabled>';
                        echo '<input type="hidden" class="form-control" name="productId" 
                        value="' . $_GET['productId'] . '" id="productId">';
                    ?>
                </div>
                <div class="mb-3">
                    <label for="productName" class="form-label">Product Name</label>
                    <?php
                        echo '<input type="text" class="form-control" name="productName" 
                        value="' . ($product->name ?? "") . '" id="productName">';
                    ?>
                </div>
                <div class="mb-3">
                    <label for="productCategory" class="form-label">Product Category</label>
                    <?php
                        echo '<input type="text" class="form-control" name="productCategory" 
                        value="' . ($product->category ?? "") . '" id="productCategory">';
                    ?>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <?php
                        echo '<textarea class="form-control" id="description" rows="3" 
                        name="description">' . ($product->description ?? "") . '</textarea>';
                    ?>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>
