
<html>

<head>
    <title>Foloklor Store</title>
    <link rel="stylesheet" href="css/style14.css">
</head>


<body>
        <?php
            include("inc/function.php");
            include("inc/header.php");
            include("inc/navbar.php");
        ?>
   <div class="link">
   <div id="go_to_login">
   </div>
   <form method="post" enctype="multipart/form-data" >
                            <table>
                                <tr>
                                    <td>Enter Your Name</td>
                                    <td><input type="text" name="u_name" required/></td>
                                </tr>
                                <tr>
                                    <td>Enter Your Email</td>
                                    <td><input type="email" name="u_email" required/></td>
                                </tr>
                                <tr>
                                    <td>Enter Your ID</td>
                                    <td><input type="text" name="u_id" required/></td>
                                </tr>
                            
                                <tr>
                                    <td>Enter Your Address</td>
                                    <td><textarea name="u_add" id="" cols="30" rows="10" required></textarea></td>
                                </tr>
                                <tr>
                                    <td>Enter Your DOB</td>
                                    <td><input type="date" name="u_date" required/></td>
                                </tr>
                                <tr>
                                    <td>Enter Your Phone</td>
                                    <td><input type="tel" name="u_phone" required/></td>
                                </tr>
                                <tr>
                                    <td>Enter The Password</td>
                                    <td><input type="password" name="u_pass" required/></td>
                                </tr>
                             
                            </table>
                                <center>
                                    <input type="submit" name="u_signup" value="SignUp"/>
                                    <input type="reset" name="u_reset" value="Reset"/>
                                </center>
                        </form>
                        <?php
                               echo u_signup();
                        ?>
   </div>
   
</body>

</html>
   
   
   
   
   
   
   
   
   