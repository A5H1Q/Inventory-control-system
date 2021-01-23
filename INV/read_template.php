<?php

  
// display the products if there are any
if($total_rows>0){
  
    echo "<table class='table table-hover table-responsive tb-e'>";
        echo "<tr class='no-hover'>";
            echo "<th id='t-name'>Product</th>";
            echo "<th id='t-price'>Price</th>";
            echo "<th id='t-desc'>Description</th>";
            echo "<th id='t-cat'>Category</th>";
            echo "<th id='t-act'>Actions</th>";
        echo "</tr>";
  
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  
            extract($row);
  
            echo "<tr class = 'items'>";
                echo "<td id='t-name'>{$name}</td>";
                echo "<td id='t-price'>{$price}</td>";
                echo "<td id='t-desc'>{$description}</td>";
                echo "<td id='t-cat'>";
                    $category->id = $category_id;
                    $category->readName();
                    echo $category->name;
                echo "</td>";
  
                echo "<td id='t-act'>";
  
                    // read product button
                    echo "<a href='read_one.php?id={$id}' class='btn btn-primary left-margin'>";
                        echo "View";
                    echo "</a>";
  
                    // edit product button
                    echo "<a href='update_product.php?id={$id}' class='btn btn-info left-margin'>";
                        echo "Edit";
                    echo "</a>";
  
                    // delete product button
                    echo "<a delete-id='{$id}' class='btn btn-danger delete-object'>";
                        echo "Delete";
                    echo "</a>";
  
                echo "</td>";
  
            echo "</tr>";
  
        }
  
    echo "</table>";
  
    // paging buttons
    include_once 'paging.php';
}
  
// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>No products found.</div>";
}
?>