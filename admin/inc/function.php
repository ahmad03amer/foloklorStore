<?php
        //to add the categoties in the data base 
    function add_cat(){
            
        include("inc/db.php");//include the data base connection
        
        
        if(isset($_POST['add_cat'])){//when click add category botton
            
            $cat_name=$_POST['cat_name'];
            $add_cat=$con->prepare("INSERT INTO main_cat (cat_name) VALUES ('$cat_name')");// تحضير الجمله لتنفيذ
        
        if( $add_cat->execute()){
            echo "<script>alert('category added successfully!');</script>";
            echo"<script>window.open('index.php?viewall_cat','_self');</script>";
        }else{
            //message to say that the result of transaction
            echo "<script>alert('category not added successfully!');</script>";
            echo"<script>window.open('index.php?viewall_cat','_self');</script>";
        }

        }else{

        }
     }
     //to add the sub categoties in the data base 
     function add_sub_cat(){
         
        include("inc/db.php");
        
        
        if(isset($_POST['add_sub_cat'])){//when click add sub category botton
            
        
            $cat_id=$_POST['main_cat'];
            $sub_cat_name=$_POST['sub_cat_name'];
            $add_sub_cat=$con->prepare("INSERT INTO sub_cat (sub_cat_name,cat_id) VALUES ('$sub_cat_name','$cat_id')");// تحضير الجمله لتنفيذ
        
        if( $add_sub_cat->execute()){
             //message to say that the result of transaction
            echo "<script>alert('sub category added successfully!');</script>";
            echo"<script>window.open('index.php?viewall_sub_cat','_self');</script>";
        }else{
            echo "<script>alert('sub category not added successfully!');</script>";
            
        }

        }else{

        }
     }
     //to display all categories in the data base as a list
    function viewall_cat(){
       
        include("inc/db.php");
        $fetch_cat=$con->prepare("SELECT * FROM main_cat");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);//بنعرف fetch من نوع اري
        $fetch_cat->execute();

        while( $row=$fetch_cat->fetch()):
            //set the categories name as an option value
            echo "<option value='".$row['cat_id']."'>".$row['cat_name']."</option>";
        endwhile;     
    }

    //to display all products in the database as a table
    function viewall_product(){

        include("inc/db.php");
        //to fetch all rows in the table of products
        $fetch_cat=$con->prepare("SELECT * FROM products");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();
        $i=1;

        //fetch row by row
        while( $row=$fetch_cat->fetch()):
            //dynamically make the table of products info
            echo "<tr>
                <td>".$i++."</td>
                <td>".$row['pro_name']." </td>
                <td> 
                
                    <img alt='No photo ' src='../imgs/pro_img/".$row['pro_img1']."'/>
                    <img alt='No photo 'src='../imgs/pro_img/".$row['pro_img2']."'/>
                    <img alt='No photo 'src='../imgs/pro_img/".$row['pro_img3']."'/>
                    <img alt='No photo 'src='../imgs/pro_img/".$row['pro_img4']."'/>
                
                </td>
                <td> ".$row['pro_descreption']." </td>
                <td> ".$row['pro_price']."</td>
                <td> ".$row['pro_size']."</td>
                <td> ".$row['pro_keyword']."</td>
                <td> ".$row['pro_added_date']."</td>
                
                <td><a href='index.php?edit_pro=".$row['pro_id']."'>Edit</a></td>
                <td><a href='delete_cat.php?delete_pro=".$row['pro_id']."'>Delete</a></td>
        </tr>";
        endwhile;     


    }
    //print all categories in the database as an table
    function viewall_categories(){
        include("inc/db.php");

        $fetch_cat=$con->prepare("SELECT * FROM main_cat  ORDER BY cat_name");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);//بنعرف fetch من نوع اري
        $fetch_cat->execute();
        $i=1;
        while( $row=$fetch_cat->fetch())://بعرف تحت عند الاي دي عشان اعدل عالعنصر الي كبست عليه مش ع كلهن
            echo "<tr><td>".$i++."</td>
                    <td>".$row['cat_name']."</td>
                    <td><a href='index.php?edit_cat=".$row['cat_id']."'>Edit</a></td>
                    <td><a href='delete_cat.php?delete_cat=".$row['cat_id']."'>Delete</a></td>
                    </tr>";
        endwhile;     

    }

    //to display all sub categories as a table 
    function viewall_sub_categories(){
        include("inc/db.php");
        $fetch_cat=$con->prepare("SELECT * FROM sub_cat ORDER BY sub_cat_name");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();
        $i=1;
        //display the sub cat in table
        while( $row=$fetch_cat->fetch()):
            echo "<tr><td>".$i++."</td>
                    <td>".$row['sub_cat_name']."</td>
                    <td><a href='index.php?edit_sub_cat=".$row['sub_cat_id']."'>Edit</a></td>
                    <td><a href='delete_cat.php?delete_sub_cat=".$row['sub_cat_id']."'>Delete</a></td>
                    </tr>";
        endwhile;     

    }

    //to display all sub categories as a list of options
    function viewall_sub_cat(){
        include("inc/db.php");

        $fetch_sub_cat=$con->prepare("SELECT * FROM sub_cat");
        $fetch_sub_cat->setFetchMode(PDO:: FETCH_ASSOC);//بنعرف fetch من نوع اري
        $fetch_sub_cat->execute();

        while( $row=$fetch_sub_cat->fetch()):
            echo "<option value='".$row['cat_id']."'>".$row['sub_cat_name']."</option>";
        endwhile;     
    }

    //to add a new product to the database
    function add_pro(){
        
        include("inc/db.php");
        
        
        if(isset($_POST['add_product'])){

            $pro_name=$_POST['pro_name'];
            $cat_id=$_POST['cat_name'];
            $sub_cat_id=$_POST['sub_cat_id'];//edited from sub_cat_name

            $pro_img1=$_FILES['pro_img1']['name'];
            $pro_img1_tmp=$_FILES['pro_img1']['tmp_name'];
            
            $pro_img2=$_FILES['pro_img2']['name'];
            $pro_img2_tmp=$_FILES['pro_img2']['tmp_name'];
            
            $pro_img3=$_FILES['pro_img3']['name'];
            $pro_img3_tmp=$_FILES['pro_img3']['tmp_name'];
            
            $pro_img4=$_FILES['pro_img4']['name'];
            $pro_img4_tmp=$_FILES['pro_img4']['tmp_name'];
            //عشان اخزن الصور الي بتحملن في ملف 
            //../ عشان ارجع لورا بالدايركتوري
            move_uploaded_file($pro_img1_tmp,"../imgs/pro_img/$pro_img1");
            move_uploaded_file($pro_img2_tmp,"../imgs/pro_img/$pro_img2");
            move_uploaded_file($pro_img3_tmp,"../imgs/pro_img/$pro_img3");
            move_uploaded_file($pro_img4_tmp,"../imgs/pro_img/$pro_img4");
            $pro_descreption=$_POST['pro_descreption'];

            $pro_price=$_POST['pro_price'];
            
            $pro_size=$_POST['pro_size'];
            
            $pro_keyword=$_POST['pro_keyword'];
            
            //query to prepare the product details to add to the database
            $add_cat=$con->prepare("INSERT INTO products
                                     (pro_name,cat_id,sub_cat_id,pro_img1,pro_img2,pro_img3,pro_img4,
                                     pro_descreption,pro_price,pro_size,pro_keyword,pro_added_date)
                                     VALUES 
                                     ('$pro_name','$cat_id','$sub_cat_id','$pro_img1',
                                     '$pro_img2','$pro_img3','$pro_img4','$pro_descreption',
                                     '$pro_price','$pro_size','$pro_keyword',NOW())");// تحضير الجمله لتنفيذ
        
        if( $add_cat->execute()){//when the query excuted successfully , the alert appeare
            echo "<script>alert('Product added successfully!');</script>";
        }else{
            echo "<script>alert('Product not added successfully!');</script>";
        }

        }else{

        }
    }
    //to edit the category name 
    function edit_cat(){
        include("inc/db.php");

        if(isset($_GET['edit_cat'])){//when click on the edit button 
            $cat_id=$_GET['edit_cat'];

                
                $fetch_cat_name=$con->prepare("SELECT * FROM main_cat WHERE cat_id='$cat_id'");
                $fetch_cat_name->setFetchMode(PDO:: FETCH_ASSOC);
                $fetch_cat_name->execute();
                $row=$fetch_cat_name->fetch();
                //show a new page form that use to update cat details-name-
                echo "
                        <form  method='post'>
                        <table>
                            <tr>
                                <td>Update Category Name :</td>
                                <td><input type='text' name='up_cat_name' value='".$row['cat_name']."'></td>
                            </tr>
                        </table>
                        <center>
                            <button name='update_cat'>Update Category</button>
                        </center>
                        </form>
                ";

                if(isset($_POST['update_cat'])){//when click on the update cat button excute the query and add to database

                    $up_cat_name=$_POST['up_cat_name'];
 
                    $update_cat=$con->prepare("UPDATE  main_cat SET cat_name='$up_cat_name' WHERE cat_id='$cat_id'");
                    $update_cat->setFetchMode(PDO:: FETCH_ASSOC);

                    if(  $update_cat->execute()){
                        echo "<script>alert('Category updated successfully');</script>";
                        //here a trick to redirect the user into the main cat page to see the edited operation 
                        //without make a refresh
                        echo "<script>window.open('index.php?viewall_cat','_self');</script>";//self عن طريق الكبسة مش الرابط الي هو تارجيت
                    }

                    //$row=$update_cat->fetch();

                }
        }


    }
    //edit sub category details
    function edit_sub_cat(){
        include("inc/db.php");
        
        if(isset($_GET['edit_sub_cat'])){//when click on the edit button 
            $sub_cat_id=$_GET['edit_sub_cat'];
    
            /*
                to find the exact sub cat element
            */
            $fetch_sub_cat=$con->prepare("SELECT * FROM sub_cat WHERE sub_cat_id='$sub_cat_id'");
            $fetch_sub_cat->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_sub_cat->execute();
            $row=$fetch_sub_cat->fetch();
            //echo $row['sub_cat_name'];
            /*
                to find the exact cat info that related to the exact sub cat
            */
            $cat_id=$row['cat_id'];
            $fetch_cat=$con->prepare("SELECT * FROM main_cat WHERE cat_id='$cat_id'");
            $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_cat->execute();
            $row_cat=$fetch_cat->fetch();
            
            //show a new form that contains the cat list and sub cat input
            echo "
                <form  method='post'>
                <table>
                    <tr>
                        <td> select the main category name : </td> 
                        <td><select name='main_cat'>
                       <option value='".$row_cat['cat_id']."'>".$row_cat['cat_name']."</option>";
                       echo viewall_cat();
                       echo" </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Update sub Category Name :</td>
                        <td><input type='text' name='up_sub_cat' value='".$row['sub_cat_name']."'/></td>
                    </tr>
                </table>
                <center>
                    <button name='update_sub_cat'>Update sub Category</button>
                </center>
                </form> 
            
                ";

                if(isset($_POST['update_sub_cat'])){ //when click on update sub cat apply the new query
                    $cat_name=$_POST['main_cat'];
                    $sub_cat_name=$_POST['up_sub_cat'];


                    $update_cat=$con->prepare("UPDATE sub_cat SET sub_cat_name='$sub_cat_name',
                                                cat_id='$cat_name' WHERE sub_cat_id='$sub_cat_id'");
                    $update_cat->setFetchMode(PDO:: FETCH_ASSOC);
                    $update_cat->execute();
                    $row=$update_cat->fetch();
                    
                    
                    if(  $update_cat->execute()){//show a result of the operation as an alert
                        echo "<script>alert('sub Category updated successfully');</script>";
                        echo "<script>window.open('index.php?viewall_sub_cat','_self');</script>";//self عن طريق الكبسة مش الرابط الي هو تارجيت
                    }

                }
        }

    }


    //to view  products info and to edit and update it
    function viewall_pro(){
        include("inc/db.php");

        if(isset($_GET['edit_pro'])){//when click on edit pro button
            $pro_id=$_GET['edit_pro'];

            /*
                get all info about this product iam click to edit it using its id
            */
            $fetch_pro=$con->prepare(" SELECT * FROM products WHERE pro_id='$pro_id'");
            $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_pro->execute();

            $row=$fetch_pro->fetch();
            $cat_id=$row['cat_id'];
            $sub_cat_id=$row['sub_cat_id'];

            //to make the list of cat point to the original value before click on edit
            $fetch_cat=$con->prepare(" SELECT * FROM main_cat WHERE cat_id='$cat_id'");
            $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_cat->execute();
            $row_cat=$fetch_cat->fetch();
            $cat_name=$row_cat['cat_name'];

            //to make the list of sub cat point to the original value before click on edit
            $fetch_sub_cat=$con->prepare(" SELECT * FROM sub_cat WHERE sub_cat_id='$sub_cat_id'");
            $fetch_sub_cat->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_sub_cat->execute();
            $row_sub_cat=$fetch_sub_cat->fetch();
            $sub_cat_name=$row_sub_cat['sub_cat_name'];//check the list of sub cat if run corect

            //display a new form to fill it with updated details
            echo "
                

                <form  method='post' enctype='multipart/form-data'><!--  بضيفها لما بدي اضيف ميديا عالموقع-->

                <table>
                    <tr>
                        <td>Update Product Name :</td>
                        <td><input type='text' name='pro_name' value='".$row['pro_name']."'></td>

                    </tr>
                    <tr>
                        <td>select category Name :</td>
                        <td>
                            <select name='cat_name'>
                            <option value='".$row['cat_id']."'>".$cat_name."</option>
                            ";
                                    echo viewall_cat();
                               
                            echo"</select>    
                    </td>

                    </tr>
                    <tr>
                        <td>select sub category Name :</td> 
                        <td>
                            <select name='sub_cat_name' >
                            <option value='".$row['cat_id']."'>".$sub_cat_name."</option>
                            
                            ";
                                    echo viewall_sub_cat();                         
                            echo"</select>    
                    </td>

                    </tr>
                    <tr>
                        <td>Update Product image1 :</td>
                        <td>
                        <input type='file' name='pro_img1'>
                        <img src='../imgs/pro_img/".$row['pro_img1']."' style=' width: 60px; height: 60px;'>
                        </td>
                    </tr>
                    <tr>
                        <td>Update Product image2 :</td>
                        <td>
                        <input type='file' name='pro_img2'>
                        <img src='../imgs/pro_img/".$row['pro_img2']."' style=' width: 60px; height: 60px;'>
                        </td>

                    </tr>
                    <tr>
                        <td>Update Product image3 :</td>
                        <td>
                        <input type='file' name='pro_img3'>
                        <img src='../imgs/pro_img/".$row['pro_img3']."' style=' width: 60px; height: 60px;'>
                        </td>

                    </tr>
                    <tr>
                        <td>Update Product image4 :</td>
                        <td>
                        <input type='file' name='pro_img4'>
                        <img src='../imgs/pro_img/".$row['pro_img4']."' style=' width: 60px; height: 60px;'>
                        </td>

                    </tr>
                    <tr>
                        <td>Update  descreption  :</td>
                        <td><input type='text' name='pro_descreption'  value='".$row['pro_descreption']."'></td>

                    </tr>
                    <tr>
                        <td>Update the Price :</td>
                        <td><input type='text' name='pro_price' value='".$row['pro_price']."'></td>

                    </tr>
                    <tr>
                        <td>Update size :</td>
                        <td><input type='text' name='pro_size' value='".$row['pro_size']."'></td>

                    </tr>
                    <tr>
                        <td>Update keyword :</td>
                        <td><input type='text' name='pro_keyword' value='".$row['pro_keyword']."'></td>

                    </tr>
                </table>
                <center>
                    <button name='up_product'>Update Product</button>

                </center>
                </form>


                ";
            if(isset($_POST['up_product'])){//when click on the update the product info
                
                    $pro_name=$_POST['pro_name'];
                    $cat_id=$_POST['cat_name'];
                    $sub_cat_id=$_POST['sub_cat_name'];

                    if($_FILES['pro_img1']['tmp_name']==""){
                        //when update the product info without update the images
                    }else{ 
                    $pro_img1=$_FILES['pro_img1']['name'];
                    $pro_img1_tmp=$_FILES['pro_img1']['tmp_name'];
                    move_uploaded_file($pro_img1_tmp,"../imgs/pro_img/$pro_img1");
                    $up_img1=$con->prepare("UPDATE products SET pro_img1='$pro_img1' WHERE  pro_id='$pro_id' ");
                    $up_img1->execute();
                    }
                    

                    if($_FILES['pro_img2']['tmp_name']==""){
                        //when update the product info without update the images
                    }else{ 
                    $pro_img2=$_FILES['pro_img2']['name'];
                    $pro_img2_tmp=$_FILES['pro_img2']['tmp_name'];
                    move_uploaded_file($pro_img2_tmp,"../imgs/pro_img/$pro_img2");
                    $up_img2=$con->prepare("UPDATE products SET pro_img2='$pro_img2' WHERE  pro_id='$pro_id' ");
                    $up_img2->execute();
                    }
                    

                    if($_FILES['pro_img3']['tmp_name']==""){
                        //when update the product info without update the images
                    }else{ 
                    $pro_img3=$_FILES['pro_img3']['name'];
                    $pro_img3_tmp=$_FILES['pro_img3']['tmp_name'];
                    move_uploaded_file($pro_img3_tmp,"../imgs/pro_img/$pro_img3");
                    $up_img3=$con->prepare("UPDATE products SET pro_img3='$pro_img3' WHERE  pro_id='$pro_id' ");
                    $up_img3->execute();
                    }
                    

                    if($_FILES['pro_img4']['tmp_name']==""){
                        //when update the product info without update the images
                    }else{ 
                    $pro_img4=$_FILES['pro_img4']['name'];
                    $pro_img4_tmp=$_FILES['pro_img4']['tmp_name'];
                    move_uploaded_file($pro_img4_tmp,"../imgs/pro_img/$pro_img4");
                    $up_img4=$con->prepare("UPDATE products SET pro_img4='$pro_img4' WHERE  pro_id='$pro_id' ");
                    $up_img4->execute();
                    }
                    

                    $pro_descreption=$_POST['pro_descreption'];

                    $pro_price=$_POST['pro_price'];
                    
                    $pro_size=$_POST['pro_size'];
                    
                    $pro_keyword=$_POST['pro_keyword'];
                    
                         //update the product info using this query 
                        $up_pro=$con->prepare(" UPDATE  products SET 
                                            pro_name='$pro_name',
                                            cat_id='$cat_id',
                                            sub_cat_id='$sub_cat_id',
                                            pro_descreption='$pro_descreption',
                                            pro_price='$pro_price',
                                            pro_size='$pro_size',
                                            pro_keyword='$pro_keyword'
                                              WHERE pro_id='$pro_id'");
                      //  $up_pro->setFetchMode(PDO:: FETCH_ASSOC);
                      //  $up_pro->execute();
                    
                    if($up_pro->execute()){
                        echo"<script>alert('Product Updated Successfully!!');</script>";
                        echo"<script>window.open('index.php?viewall_products','_self');</script>";//عشان اعمل ريدايركت بيج
                    }
            }

        }

    }
    //delete the category from the database
    function delete_cat(){
       
            include("inc/db.php");
            $delete_cat_id=$_GET['delete_cat'];
            $delete_cat=$con->prepare(" DELETE  FROM main_cat WHERE cat_id='$delete_cat_id'");

            if($delete_cat->execute()){
                echo"<script>alert('cat Deleted Successfully!!');</script>";
                 echo"<script>window.open('index.php?viewall_cat','_self');</script>";
            }
        
    }
    //delete the sub cat from the data base
    function delete_sub_cat(){
        include("inc/db.php");  

        $delete_sub_cat_id=$_GET['delete_sub_cat'];//get the id of the element we need to delete it 

        $delete_sub_cat=$con->prepare(" DELETE FROM sub_cat WHERE sub_cat_id='$delete_sub_cat_id'");

        if($delete_sub_cat->execute()){
            echo"<script>alert('sub cat Deleted Successfully!!');</script>";
             echo"<script>window.open('index.php?viewall_sub_cat','_self');</script>";
        }


    }

    function delete_product(){
        include("inc/db.php");  
        
        $delete_product_id=$_GET['delete_pro'];//get the id of the element we need to delete it 

        $delete_pro=$con->prepare(" DELETE FROM products WHERE pro_id='$delete_product_id'");

        if($delete_pro->execute()){
            echo"<script>alert('Product Deleted Successfully!!');</script>";
             echo"<script>window.open('index.php?viewall_products','_self');</script>";
        }
    }

?>