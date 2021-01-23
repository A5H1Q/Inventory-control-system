<?php
// get ID of the product to be edited
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
  
// set ID property of product to be edited
$product->id = $id;
  
// read the details of product to be edited
$product->readOne();  
// set page header
$page_title = "Update Product";
include_once "layout_header.php";
  

?>
<!-- post code will be here -->
<?php 
// if the form was submitted
if($_POST){
  
    // set product property values
    $product->name = $_POST['name'];
    $product->price = $_POST['price'];
    $product->description = $_POST['description'];
    $product->category_id = $_POST['category_id'];
  
    // update the product
    if($product->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Product was updated.";
        echo "</div>";
    }
  
    // if unable to update the product, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to update product.";
        echo "</div>";
    }
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post" class='container'>    
    <table class='table table-hover table-responsive tblEd'>
  
        <tr>
            <td class="upLeft">Name</td>
            <td class="upRight" id='upName'><input type='text' name='name' value='<?php echo $product->name; ?>' class='form-control' /></td>
        </tr>
  
        <tr>
            <td class="upLeft">Price</td>
            <td class="upRight" id='upPrice'><p>&#8377;</p><input type='text' name='price' value='<?php echo $product->price; ?>' class='form-control' /></td>
        </tr>
  
        <tr>
            <td class="upLeft">Description</td>
            <td class="upRight" id='upDesc'><textarea name='description' class='form-control'><?php echo $product->description; ?></textarea></td>
        </tr>
  
        <tr>
            <td class="upLeft">Category</td>
            <td class="upRight" id='upCat'>
                <?php
            
$stmt = $category->read();
  
// put them in a select drop-down
echo "<select class='form-control' name='category_id'>";
  
    echo "<option>Please select...</option>";
    while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
        $category_id=$row_category['id'];
        $category_name = $row_category['name'];
  
        // current category of the product must be selected
        if($product->category_id==$category_id){
            echo "<option value='$category_id' selected>";
        }else{
            echo "<option value='$category_id'>";
        }
  
        echo "$category_name</option>";
    }
echo "</select>";
?>
            </td>
        </tr>
    </table>
    <div class="btnsUp">
        <button type="submit" class="btn btn-primary btnUp">Update</button> 
        <a href="index.php" class='btn btn-default btnUp'>Cancel</a>
    </div>

</form>
