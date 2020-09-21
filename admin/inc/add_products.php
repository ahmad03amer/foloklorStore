<div id="bodyright">
    <h3>Add a new Product from here </h3>
    <br><br>

<form  method="post" enctype="multipart/form-data"><!--  بضيفها لما بدي اضيف ميديا عالموقع-->

<table>
    <tr>
        <td>Enter Product Name :</td>
        <td><input type="text" name="pro_name"></td>

    </tr>
    <tr>
        <td>select category Name :</td>
        <td>
            <select name="cat_name" >
                <?php
                    include("inc/function.php");
                    echo viewall_cat();
                
                ?>
            </select>    
    </td>

    </tr>
    <tr>
        <td>select sub category Name :</td>
        <td>
            <select name="sub_cat_name">
                <?php
                  
                    echo viewall_sub_cat();
                
                ?>
            </select>    
    </td>

    </tr>
    <tr>
        <td>select Product image1 :</td>
        <td><input type="file" name="pro_img1" ></td>

    </tr>
    <tr>
        <td>select Product image2 :</td>
        <td><input type="file" name="pro_img2"></td>

    </tr>
    <tr>
        <td>select Product image3 :</td>
        <td><input type="file" name="pro_img3"></td>

    </tr>
    <tr>
        <td>select Product image4 :</td>
        <td><input type="file" name="pro_img4"></td>

    </tr>
    <tr>
        <td>Enter  descreption  :</td>
        <td><input type="text" name="pro_descreption"></td>

    </tr>
    <tr>
        <td>Enter the Price :</td>
        <td><input type="text" name="pro_price"></td>

    </tr>
    <tr>
        <td>enter size :</td>
        <td><input type="text" name="pro_size"></td>

    </tr>
    <tr>
        <td>enter keyword :</td>
        <td><input type="text" name="pro_keyword"></td>

    </tr>
</table>
<center>
    <button name="add_product">Add Product</button>

</center>
</form>

</div>


<?php
    echo add_pro();
?>

