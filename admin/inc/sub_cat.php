<div id="bodyright">

<h3>View All sub Categories </h3>
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <th>Number</th>
                    <th> sub Category Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                
                    <?php
                      include("inc/function.php");
                       echo viewall_sub_categories();
                    ?>
                
            </table>
        </form>

    <h3>Add a new Sub category from here </h3>
    <br><br>

<form  method="post">
<table>
       <tr>
        <td>Enter  Category Name :</td>
        <td>
            <select name="main_cat" >
            <?php
                
               
                echo viewall_cat();
            ?>
           </select>
        </td>

    </tr>
    <tr>
        <td>Enter Sub Category Name :</td>
        <td><input type="text" name="sub_cat_name"></td>

    </tr>
</table>
<center>
    <button name="add_sub_cat">Add sub Category</button>

</center>
</form>

</div>


<?php

   echo add_sub_cat();
?>

