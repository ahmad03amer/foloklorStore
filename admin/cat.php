<div id="bodyright">
        <h3>View All Categories </h3>
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <th>Number</th>
                    <th>Category Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>   
                
                    <?php
                      include("inc/function.php");
                       echo viewall_categories();
                    ?>
                
            </table>
        </form>
        <h3>Add a new category from here </h3>
        <br><br>

    <form id="add_cat"  method="post">

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
  
    echo add_cat();
   
?>


