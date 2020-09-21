
    <header>
           <?php

    if(isset($_SESSION['u_email'])){
        echo '<br/>';        
        echo 'Hi =>  '.$_SESSION['u_email'].'  <= Welcome in the control panel ';
        echo " -   Go to the main page : <a href='../index.php'>Main Page</a>";
              }else{
                   echo "<script>alert('You not authorized to access this page');</script>";
                   header('location:index.php');//redirect to cpanel
                    exit();
                 }
           ?>
    </header>
       