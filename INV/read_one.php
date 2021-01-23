<?php
// get ID of the product to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
  
// include database and object files
include_once 'config/database.php';
include_once 'objects/product.php';
include_once 'objects/category.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare objects
$product = new Product($db);
$category = new Category($db);
  
// set ID property of product to be read
$product->id = $id;
  
// read the details of product to be read
$product->readOne();
$page_title = "View Details";
include_once "layout_header.php";
  
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Print";
    echo "</a>";
echo "</div>";
  // HTML table for displaying a product details
echo "<table class='table table-hover table-responsive tbl'>";
  
    echo "<tr>";
        echo "<td class='obRight'>Name</td>";
        echo "<td class='obLeft'>{$product->name}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td class='obRight'>Price</td>";
        echo "<td class='obLeft'>{$product->price}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td class='obRight'>Description</td>";
        echo "<td class='obLeft'>{$product->description}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td class='obRight'>Category</td>";
        echo "<td class='obLeft'>";
            // display category name
            $category->id=$product->category_id;
            $category->readName();
            echo $category->name;
        echo "</td>";
    echo "</tr>";
  
echo "</table>";
// set footer
include_once "layout_footer.php";
?>