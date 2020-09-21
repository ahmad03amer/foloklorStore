<div id="bodyright">
    <h3>Add a new Product from here </h3>
    <br><br>

<form  method="post">

<table>
    <tr>
        <td>Enter Category Name :</td>
        <td><input type="text" name="cat_name"></td>

    </tr>
</table>
<center>
    <button name="add_cat">Add Category</button>

</center>
</form>

</div>


<?php

    include("inc/db.php");
    
    
    if(isset($_POST['add_cat'])){
        
        $cat_name=$_POST['cat_name'];
        $add_cat=$con->prepare("INSERT INTO main_cat (cat_name) VALUES ('$cat_name')");// تحضير الجمله لتنفيذ
       
       if( $add_cat->execute()){
           echo "<script>alert('category added successfully!');</script>";
       }else{
        echo "<script>alert('category not added successfully!');</script>";
       }

    }else{

    }
?>



















 





