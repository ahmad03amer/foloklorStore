    <?php
 session_start();
    //Get visitors IP address with PHP
    function getIp() {
        $ip = $_SERVER['REMOTE_ADDR'];
    
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    
        return $ip;
    }
    //function add the products to the cart
    function add_cart(){
           
            include("inc/db.php"); 
           
            if(isset($_POST['cart_btn'])){
                if(isset($_SESSION['u_email'])){

                $u_email=$_SESSION['u_email'];//store the email from session into variable
                 $get_user_num=$con->prepare(" SELECT * FROM users WHERE u_email='$u_email'");//query to get the u_num 
                 $get_user_num->setFetchMode(PDO:: FETCH_ASSOC);
                 $get_user_num->execute();
                 $row_num=$get_user_num->fetch();
                 $u_num=$row_num['u_num'];//store the user number into var
                //when click on the cart botton
                $pro_id=$_POST['pro_id'];//store the id by the input hidden using post methode
            
                $ip=getIp();//get ip address using this function
                
                        $add_cart=$con->prepare("INSERT INTO cart (pro_id,qty,ip_add,u_num) VALUES('$pro_id','1','$ip','$u_num')");
                    


                        $check_cart=$con->prepare("SELECT * FROM cart WHERE pro_id='$pro_id' AND ip_add='$ip' AND u_num='$u_num' ");
                        $check_cart->execute();
                        
                        $row_check=$check_cart->rowCount();
                        
                    if($row_check == 1){
                        echo"<script>alert('Product already in the cart!');</script>";
                        
                    }else{
                        
                        if($add_cart->execute()){
                            echo"<script>alert('Product Added in the cart successfully!');</script>";

                            echo"<script>window.open('cart.php','_target');</script>";

                        }else{
                            echo"<script>alert('Faild To add to the cart Please Try again!');</script>";
                        }
                        
                    }

                }else{
                    echo"<script>alert('Please Login First!');</script>";
                    //echo"<script>window.open('../login.php','_target');</script>";
                }
            }//end of isset btn
    }

    //find the number of products added to the cart dynamically
    function cart_count(){
        
        include("inc/db.php");
        $ip=getIp();
        $get_cart_item=$con->prepare(" SELECT * FROM cart WHERE ip_add=' $ip' AND u_num='$u_num'");
    
        $get_cart_item->execute();

        $count_cart=$get_cart_item->rowCount();
        echo $count_cart;


    }

    //display all product details that in the cart
    function cart_display(){
        include("inc/db.php");

        if(isset($_SESSION['u_email'])){
        $ip=getIp();
        
        $u_email=$_SESSION['u_email'];//store the email from session into variable
        $get_user_num=$con->prepare(" SELECT * FROM users WHERE u_email='$u_email'");//query to get the u_num 
        $get_user_num->setFetchMode(PDO:: FETCH_ASSOC);
        $get_user_num->execute();
        $row_num=$get_user_num->fetch();
        $u_num=$row_num['u_num'];//store the user number into var
        $_SESSION['u_num']=$u_num;
        $get_cart=$con->prepare(" SELECT * FROM cart WHERE ip_add='$ip'  AND u_num='$u_num' ");
        $get_cart->setFetchMode(PDO:: FETCH_ASSOC);
        $get_cart->execute();

        $cart_empty=$get_cart->rowCount();//when cart is empty ! keep shopping message
        $net_total=0;

        if($cart_empty==0){
            echo"<center>
            
                <h2>No product found in your cart ! keep shopping ^_^</h2>
                <a href='index.php'>Keep Shopping</a>
                </center>";
        }else{

            if(isset($_POST['up_qty'])){
                $quantity=$_POST['qty'];

                foreach($quantity as $key => $value){
                        
                    $update_qty=$con->prepare(" UPDATE  cart SET qty='$value' WHERE cart_id='$key'");
                if( $update_qty->execute()){
                    echo"<script> window.open('cart.php','_self')</script>";
                }
                }
            }
            echo"
            <table cellpadding='0'>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Remove</th>
                <th>Sub Total</th>
            </tr>
            ";
        while($row=$get_cart->fetch()):
            $pro_id=$row['pro_id'];
            
            $get_pro=$con->prepare(" SELECT * FROM products WHERE pro_id='$pro_id'");
            $get_pro->setFetchMode(PDO:: FETCH_ASSOC);
            $get_pro->execute();

            $row_pro=$get_pro->fetch(); 
            echo "<tr>
                    <td><img src='imgs/pro_img/".$row_pro['pro_img1']."' alt='pro image'></td>
                    <td>".$row_pro['pro_name']."</td>
                    <td>
                    <input type='text' name='qty[".$row['cart_id']."]' value='".$row['qty']."'/>
                    <input type='submit' name='up_qty' value='save'/>
                    </td> 
                    <td>".$row_pro['pro_price']."</td>
                    <td><a href='delete.php?delete_id=".$row_pro['pro_id']."'>Delete</a></td>
                    <td>";
                        $qty=$row['qty']; 
                        $pro_price=$row_pro['pro_price'];
                        $sub_total=$pro_price*$qty;
                        echo $sub_total;
                        $net_total=$net_total+$sub_total;
                    echo"</td>
                </tr>";
        endwhile;
        // echo"The net Total is : ".$net_total;

        
            echo "
                <tr>
                    <td> <button class='cart_btns'><a href='index.php'>Continue Shopping</a></button> </td>
                    <td> <button  class='cart_btns' ><a href='checkout.php'>Check Out</a></button> </td>
                    <td></td>
                    <td><b> Net Total = $net_total </b></td>
                </tr>
                ";
        }//end of else condition
    }else{//end of isset session
        echo"<script>alert('Please Login First!');</script>";
        echo "<script>window.open('login.php','_self') </script>";
    }
    }

    //delete cart item from cart 
    function  delete_cart_items(){
        include("inc/db.php");

        if(isset($_GET['delete_id'])){
            $pro_id=$_GET['delete_id'];

            $delete_pro=$con->prepare(" DELETE  FROM cart WHERE pro_id='$pro_id'");
            
            if($delete_pro->execute()){
                echo "<script>alert('Product Deleted successfuly!'); </script>";
                echo "<script>window.open('cart.php','_self') </script>";
            }
            
        }
    }
    //the section of the populer costumes in the main website page
    /*
            note that i was use the id of the category to display its content in the main page which is not 
            useful , and this function to display all categories regardless to the id of the category
    */
    function diaplay_categories(){
            
        include("inc/db.php");
        
        //fetch the category with the specific id
        $fetch_cat=$con->prepare(" SELECT * FROM main_cat");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();

        //
        while($row_cat=$fetch_cat->fetch()):
        $cat_id=$row_cat['cat_id'];

        echo"<h3>".$row_cat['cat_name']."</h3><ul>";
        //fetch all products that related with specific category
        $fetch_pro=$con->prepare(" SELECT * FROM products WHERE cat_id='$cat_id' LIMIT 3");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();
        //get the product details and bottons 
        while( $row_pro=$fetch_pro->fetch()):
            echo "<li>  
                <form method='post' enctype='multipart/form-data'>
                    <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                    <h4>".$row_pro['pro_name']."</h4>
                    <img src='imgs/pro_img/".$row_pro['pro_img1']."'>
                    <center>
                    <button id='pro_btn_choice'><a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a></button>
                    <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id'/>
                    <button id='pro_btn_choice'  name='cart_btn'>Cart</button>
                    <button id='pro_btn_choice'><a href='#'>Wish</a></button>
                    </center>
                    </a>
            </form>
                    </li>";
        endwhile;
    echo "</ul><br clear='all'/>"; 
    endwhile;
    }


    //diplay a new page for more details about the product 
    function pro_details(){
        include("inc/db.php");

        if(isset($_GET['pro_id'])){//when click on the peoduct
            $pro_id=$_GET['pro_id'];

            //get all product info from the database
            $pro_fetch=$con->prepare(" SELECT * FROM products WHERE pro_id='$pro_id'");
            $pro_fetch->setFetchMode(PDO:: FETCH_ASSOC);
            $pro_fetch->execute();

            $row_pro=$pro_fetch->fetch();
            $cat_id=$row_pro['cat_id'];//to can reach the related category in similar product

            //format andd diplay the product info
            echo"
                <div id='pro_img'>
                    <img src='imgs/pro_img/".$row_pro['pro_img1']."'>
                    <ul>
                        <li><img src='imgs/pro_img/".$row_pro['pro_img2']."'></li>
                        <li><img src='imgs/pro_img/".$row_pro['pro_img3']."'></li>
                        <li><img src='imgs/pro_img/".$row_pro['pro_img4']."'></li>
                    </ul>
                </div>
                <div id='pro_details'>
                    <div id='pro_descreption'>
                    
                        <h3>".$row_pro['pro_name']."</h3>
                        <br><br>
                        <p> <strong>Desciption :</strong> ".$row_pro['pro_descreption']."</p>
                        <br>
                    </div>
                    
                    <div id='pro_size'>
                    <p><strong> Size :</strong>".$row_pro['pro_size']."</p>
                    </div>
                    
                    <div id='pro_keyword'>
                    <p> <strong> Keyword :</strong>".$row_pro['pro_keyword']."</p>
                    </div>
                    
            
                </div>
                    <div id='pro_price'>
                    <center>
                        <h4>Selling Price : ".$row_pro['pro_price']."</h4>
                        <form method='post'>
                        <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id'/>
                            <button name='add_to_wish_list' >Add to wish list</button>
                            <button name='cart_btn' >Add to shopping cart</button>
                        </form>
                    </center>
                    
                    </div><br clear='all'/>
                <div id='sim_pro'>
                    <h3>Similar Product</h3>
                    <ul>";//to make a query loop 
                    echo add_cart();
                    $sim_pro=$con->prepare(" SELECT * FROM products WHERE pro_id!=$pro_id AND cat_id='$cat_id' LIMIT 6");
                    $sim_pro->setFetchMode(PDO:: FETCH_ASSOC);
                    $sim_pro->execute();

                    while($row=$sim_pro->fetch())://fetch all similar product related with the same category
                            echo"<li>
                                <a href='pro_detail.php?pro_id=".$row['pro_id']."'>
                                    <img src='imgs/pro_img/".$row['pro_img1']."' alt='pro_img1'/>
                                    <p>".$row['pro_name']."</p>
                                    <p>Price: ".$row['pro_price']."</p>
                                </a>
                            </li>";
                    endwhile;
                    echo"</ul>
                    </div><br clear='all'/>";

        }
    }
        //to display all cat as a sublist for category in navbar
        function all_cat(){
            include("inc/db.php");
            $all_cat=$con->prepare(" SELECT * FROM main_cat ");
            $all_cat->setFetchMode(PDO:: FETCH_ASSOC);
            $all_cat->execute();

            while($row=$all_cat->fetch()):
                echo"<li><a href='cat_detail.php?cat_id=".$row['cat_id']."'>".$row['cat_name']."</a></li>";
            endwhile;

        }
        //print the product details dynamically when click view
        function cat_detail(){
            
            include("inc/db.php");
            if(isset($_GET['cat_id'])){
                $cat_id=$_GET['cat_id'];
                $cat_pro=$con->prepare(" SELECT * FROM products WHERE cat_id='$cat_id' ");
                $cat_pro->setFetchMode(PDO:: FETCH_ASSOC);
                $cat_pro->execute();

                $cat_name=$con->prepare(" SELECT * FROM main_cat WHERE cat_id='$cat_id' ");
                $cat_name->setFetchMode(PDO:: FETCH_ASSOC);
                $cat_name->execute();
                $row=$cat_name->fetch();
                $row_main_cat=$row['cat_name'];
                echo "<h3> $row_main_cat</h3>";

                
                while( $row_cat=$cat_pro->fetch()):
                    
                    echo "<li>
                    <form method='post' enctype='multipart/form-data'>
                            <a href='pro_detail.php?pro_id=".$row_cat['pro_id']."'>
                            <h4>".$row_cat['pro_name']."</h4>
                            <img src='imgs/pro_img/".$row_cat['pro_img1']."'>
                            <center>
                            <button id='pro_btn_choice'><a href='pro_detail.php?pro_id=".$row_cat['pro_id']."'>View</a></button>
                            <input type='hidden' value='".$row_cat['pro_id']."' name='pro_id'/>
                            <button id='pro_btn_choice'  name='cart_btn'>Cart</button>
                            <button id='pro_btn_choice'><a href='#'>Wish</a></button>
                            </center>
                            </a>
                            </form>
                            </li>";
                endwhile;
            }
            }

            //to view the sub category for each category 
            function viewall_sub_cat(){
                    
                include("inc/db.php");
                    if(isset($_GET['cat_id'])){
                        $cat_id=$_GET['cat_id'];
                        $sub_cat=$con->prepare(" SELECT * FROM sub_cat WHERE cat_id='$cat_id' ");
                        $sub_cat->setFetchMode(PDO:: FETCH_ASSOC);
                        $sub_cat->execute();
                    echo"<h3 id='bodyright_title'>Sub Categories</h3>";
                        while( $row=$sub_cat->fetch()):
                        
                                echo"<li> <a href='cat_detail.php?sub_cat_id=".$row['sub_cat_id']."'>".$row['sub_cat_name']."</a></li>";
                        endwhile;
                    }
            }

        
            //display the products related with the same sub product
            function sub_cat_detail(){
            
                include("inc/db.php");
                if(isset($_GET['sub_cat_id'])){
                    $sub_cat_id=$_GET['sub_cat_id'];
                    
                    $sub_cat_pro=$con->prepare(" SELECT * FROM products WHERE sub_cat_id='$sub_cat_id' ");
                    $sub_cat_pro->setFetchMode(PDO:: FETCH_ASSOC);
                    $sub_cat_pro->execute();
        
                    $sub_cat_name=$con->prepare(" SELECT * FROM sub_cat WHERE sub_cat_id='$sub_cat_id' ");
                    $sub_cat_name->setFetchMode(PDO:: FETCH_ASSOC);
                    $sub_cat_name->execute();
                    $row=$sub_cat_name->fetch();

                    $row_sub_cat=$row['sub_cat_name'];

                    echo "<h3>$row_sub_cat</h3>";
                    
                    while( $row_sub_cat=$sub_cat_pro->fetch()):
                        
                        echo "<li>
                                <a href='pro_detail.php?pro_id=".$row_sub_cat['pro_id']."'>
                                <h4>".$row_sub_cat['pro_name']."</h4>
                                <img src='imgs/pro_img/".$row_sub_cat['pro_img1']."'>
                                <center>
                                <button id='pro_btn_choice'><a href='pro_detail.php?pro_id=".$row_sub_cat['pro_id']."'>View</a></button>
                                <button id='pro_btn_choice'><a href=''>Cart</a></button>
                                <button id='pro_btn_choice'><a href='#'>Wish</a></button>
                                </center>
                                </a>
                                </li>";
                    endwhile;
                }
                }

                //view all category
            function viewall_cat(){
                    
                include("inc/db.php");
                if(isset($_GET['sub_cat_id'])){
                    
                    $main_cat=$con->prepare(" SELECT * FROM main_cat  ");
                    $main_cat->setFetchMode(PDO:: FETCH_ASSOC);
                    $main_cat->execute();
                    echo"<h3 id='bodyright_title'>Categories</h3>";

                    while( $row=$main_cat->fetch()):
                    
                            echo"<li> <a href='cat_detail.php?cat_id=".$row['cat_id']."'>".$row['cat_name']."</a></li>";
                    endwhile;
                }
        }

        //search for product use title ,description and keyword
        function search(){
            include("inc/db.php");
            if(isset($_GET['search'])){
                
                $user_query=$_GET['user_query'];
                
                $user_query=$con->prepare(" SELECT * FROM products WHERE
                                            pro_name LIKE '%$user_query%' OR
                                            pro_descreption LIKE '%$user_query%' OR
                                            pro_keyword LIKE '%$user_query%'");
                $user_query->setFetchMode(PDO:: FETCH_ASSOC);
                $user_query->execute();
                echo"<div id='bodyleft'><ul>"; 
                if($user_query->rowCount() == 0){
                    echo"<h2> Product Not Found Try another Words </h2>";
                }else{
                while( $row=$user_query->fetch()):
                    echo "<li>
                    <a href='pro_detail.php?pro_id=".$row['pro_id']."'>
                    <h4>".$row['pro_name']."</h4>
                    <img src='imgs/pro_img/".$row['pro_img1']."'>
                    <center>
                    <button id='pro_btn_choice'><a href='pro_detail.php?pro_id=".$row['pro_id']."'>View</a></button>
                    <button id='pro_btn_choice'><a href='#'>Cart</a></button>
                    <button id='pro_btn_choice'><a href='#'>Wish</a></button>
                    </center>
                    </a>
                    </li>";
                endwhile;
                }
                echo "</ul></div>";
            }
        }


        //signup fuction 
        function u_signup(){
            
            include("inc/db.php");
           
            if(isset($_POST['u_signup'])){
                
                $u_name=$_POST['u_name'];
                $u_email=$_POST['u_email'];
                $u_id=$_POST['u_id'];
                $u_add=$_POST['u_add'];
                $u_date=$_POST['u_date'];
                $u_phone=$_POST['u_phone'];
                $u_pass=$_POST['u_pass'];

                
                $add_user=$con->prepare("INSERT INTO users(u_name,u_email,u_id,u_add,u_date,u_phone,u_pass,u_reg_date) 
                        VALUES ('$u_name','$u_email','$u_id','$u_add','$u_date','$u_phone','$u_pass',NOW())");
              
               
                if($add_user->execute()){
                    echo"<script>alert('Youre registeration success please sign in!');</script>";
                    echo"<script>window.open('index.php','_self');</script>";
                }else{
                    echo"<script>alert('registeration Faild Please Try again !');</script>";
                }
            }
        }

            //display all product details that in the checkout page
    function cart_checkout_display(){
        include("inc/db.php");

        if(isset($_SESSION['u_email'])){
        $ip=getIp();
        
        $u_email=$_SESSION['u_email'];//store the email from session into variable
        $get_user_num=$con->prepare(" SELECT * FROM users WHERE u_email='$u_email'");//query to get the u_num 
        $get_user_num->setFetchMode(PDO:: FETCH_ASSOC);
        $get_user_num->execute();
        $row_num=$get_user_num->fetch();
        $u_num=$row_num['u_num'];//store the user number into var

        $get_cart=$con->prepare(" SELECT * FROM cart WHERE ip_add='$ip'  AND u_num='$u_num' ");
        $get_cart->setFetchMode(PDO:: FETCH_ASSOC);
        $get_cart->execute();

        $cart_empty=$get_cart->rowCount();//when cart is empty ! keep shopping message
        $net_total=0;

        if($cart_empty==0){
            echo"<script>alert('Note!! the shopping cart is empty Please Buy  First!');</script>";
        }else{

            echo"
            <table cellpadding='0'>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
            </tr>
            ";
        while($row=$get_cart->fetch()):
            $pro_id=$row['pro_id'];
            
            $get_pro=$con->prepare(" SELECT * FROM products WHERE pro_id='$pro_id'");
            $get_pro->setFetchMode(PDO:: FETCH_ASSOC);
            $get_pro->execute();

            $row_pro=$get_pro->fetch(); 

            $get_qty=$con->prepare(" SELECT * FROM cart WHERE pro_id='$pro_id'");
            $get_qty->setFetchMode(PDO:: FETCH_ASSOC);
            $get_qty->execute();

            $row_qty=$get_qty->fetch(); 

            $qty=$row_qty['qty'];
            $sub_tot_price=$row_pro['pro_price']*$qty;

            echo "<tr>
                    <td>".$row_pro['pro_name']."</td>
                    <td>".$sub_tot_price."</td>
                    <td>";
                    $pro_price= $sub_tot_price;
                    $net_total=$net_total+$pro_price;
                    $_SESSION['total']=$net_total;
                echo"</td>
                </tr>";
        endwhile;
        // echo"The net Total is : ".$net_total;
            echo "
                <tr>
                    
                    <td><a href=''> Net Total = $net_total </a></td>
                </tr>
                ";
        }//end of else condition
    }else{//end of isset session
        echo"<script>alert('Please Login First!');</script>";
        echo "<script>window.open('login.php','_self') </script>";
    }
    }

       //checkout fuction  to pay
       function checkout(){
            
        include("inc/db.php");
       
        if(isset($_POST['checkout'])){
            
            $name=$_POST['fullname'];
            $email=$_POST['email'];
            $address=$_POST['address'];
            $city=$_POST['city'];
            $state=$_POST['state'];
            $zip=$_POST['zip'];
            $card_name=$_POST['cardname'];
            $credit_card_num=$_POST['cardnumber'];
            $exp_month=$_POST['expmonth'];
            $exp_year=$_POST['expyear'];
            $cvv=$_POST['cvv'];
            $total=$_SESSION['total'];
            
            $checkout_info=$con->prepare("INSERT INTO checkout(name,email,address,city,state,zip,card_name,credit_card_num,
                                    	exp_month,exp_year,cvv,total) 
                    VALUES ('$name','$email','$address','$city','$state','$zip','$card_name','$credit_card_num',
                            ' $exp_month','$exp_year','$cvv','$total')");   
          
                $checkout_info->setFetchMode(PDO:: FETCH_ASSOC);
    
            if($checkout_info->execute()){
                $u_num=$_SESSION['u_num'];
                
                $delete_cart_info=$con->prepare("DELETE FROM cart WHERE u_num='$u_num'");
                $delete_cart_info->setFetchMode(PDO:: FETCH_ASSOC);

                if($delete_cart_info->execute()){
                echo"<script>alert('Youre Transaction Process success , Thank you for the Payment!');</script>";
                echo"<script>window.open('cart.php','_self');</script>";

                }

            }else{
                echo"<script>alert('The Transaction Process  Faild Please Try again !');</script>";
            }
        }
    }

    ?>