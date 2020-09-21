
<html>

<head>
    <title>Foloklor Store</title>
    <link rel="stylesheet" href="css/style14.css">
</head>

<style>]

.logout{
        margin-top:50px;
        margin-left:50px;
    
    }
    
    .logout a {
        text-decoration:none;
        margin-top:50px;
        margin-left:50px;
    }
    
    .lout{
        height: 35px;
        border: 1px solid black;
        width: 200px;
        background: lightgrey;
        color: black;
        border-radius: 4px;
        margin-top: 15px;
        margin-left: 30px;
       
    } 
     .lout:hover{
        background: lightgreen;
        border-radius: 4px;
        color: black;
        cursor: pointer;
    }
</style>

<body>
        <?php
            include("inc/function.php");
            include("inc/header.php");
            include("inc/navbar.php");

            if(isset($_SESSION['u_email'])){

            
        ?>
   <div class="logout">
       
        <a href="logout.php"> Log Out : <button class="lout">Logout</button></a>
   </div>
   <div class="link">
   <form method="post" enctype="multipart/form-data" >
                            <table>
                                <tr>
                                    <td>Update Your Name</td>
                                    <td><input type="text" name="u_name" required/></td>
                                </tr>
                                <tr>
                                    <td>Update Your Email</td>
                                    <td><input type="email" name="u_email" required/></td>
                                </tr>
                                <tr>
                                    <td>Update Your ID</td>
                                    <td><input type="text" name="u_id" required/></td>
                                </tr>
                            
                                <tr>
                                    <td>Update Your Address</td>
                                    <td><textarea name="u_add" id="" cols="30" rows="10" required></textarea></td>
                                </tr>
                                <tr>
                                    <td>Update Your DOB</td>
                                    <td><input type="date" name="u_date" required/></td>
                                </tr>
                                <tr>
                                    <td>Update Your Phone</td>
                                    <td><input type="tel" name="u_phone" required/></td>
                                </tr>
                                <tr>
                                    <td>Update The Password</td>
                                    <td><input type="password" name="u_pass" required/></td>
                                </tr>
                             
                            </table>
                                <center>
                                    <input type="submit" name="u_update" value="Update"/>
                                    <input type="reset" name="u_reset" value="Reset"/>
                                </center>
                        </form>
                        <?php
                               echo u_signup();
                        ?>
   </div>
                    <?php
            }else{
                    
            echo"<script>alert('Please Login First!');</script>";
            echo "<script>window.open('login.php','_target') </script>";
            }
                    ?>
</body>

</html>
   
   
   
   
   
   
   
   
   