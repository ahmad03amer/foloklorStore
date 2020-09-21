
<html>

<head>
    <title>Foloklor Store</title>
    <link rel="stylesheet" href="css/style14.css">
    <script src="js/external.js"></script>

</head>
<style>
.login-body{
    width:600px;
    display:block;
    align-items:center;
    justify-content:center;
    padding-left:350px;
    margin-bottom:20px;
}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

.lbutton {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}



.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>

<body>
        <?php
            include("inc/function.php");//already starts the session
            include("inc/header.php");
            include("inc/navbar.php");
            include("inc/db.php");
      
            
        ?>
    <br><br>

      <?php
      
      if(isset($_SESSION['u_email'])){//at first there is no session 
        
        if($_SESSION['group_id']==1){
          echo "<script>alert('You already logged in as admin ,You will directly redirect to the cpanel ! ');</script>";
          echo"<script>window.open('admin/index.php','_self');</script>";
       }else{
        echo "<script>alert('You already logged in ,You will redirect to account settings! ');</script>";
        echo"<script>window.open('myaccount.php','_self');</script>";
      }
      
      }

      //check if the user coming from http request
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
           
              $u_email=$_POST['u_email'];
              $u_pass=$_POST['u_pass'];
              $hash_psw=sha1($u_pass);
       
          //check if the user exist in the data base
          $stmt= $con->prepare("SELECT * FROM users WHERE u_email=?
                          AND u_pass=?");
          $stmt->execute(array($u_email,$u_pass));
          $count=$stmt->rowCount();
          $row=$stmt->fetch();
          //if count >0 then the user  exist
          if($count > 0 ){

            $_SESSION['u_email']=$u_email;
            $_SESSION['u_pass']=$u_pass;
            $_SESSION['group_id']=$row['group_id'];
            
           // header('location:index.php');//redirect to main page
           echo "<script>alert('Youre successfully Logged in! ');</script>";
           echo"<script>window.open('index.php','_self');</script>";
           
          }else{
            echo "<script>alert('Youre login info is not correct please try again ! ');</script>";
          }
        }   

      ?>
    <center>
          <h2>Login Form</h2> 
    </center>
 
    <br>
    <div class="login-body">
            
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

              <div class="container">
                  <label for="u_email"><b>Email</b></label>
                  <input type="text" placeholder="Enter Email" name="u_email" required>

                  <label for="u_pass"><b>Password</b></label>
                  <input type="password" placeholder="Enter Password" name="u_pass" required>
                      
                  <button type="submit" class="lbutton" onclick="clickedBtn()">Login</button>
                  <label>
                  <input type="checkbox" checked="checked" name="remember"> Remember me
                  </label>
              </div>

              <div class="container" style="background-color:#f1f1f1">
                  <button type="button" class="cancelbtn">Cancel</button>
                  <span class="psw">Forgot <a href="#">password?</a></span>
              </div>
        </form>
    </div>

          <?php
              include("inc/footer.php");
          ?>
     
    
</body>

</html>
   
   
   
   
   
   
   
   
   

