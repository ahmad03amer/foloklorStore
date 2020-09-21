
<html>

    <head>
        <title>Foloklor Store</title>
        <link rel="stylesheet" href="css/style14.css">
        <script src="js/main3.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    </head>

    <body>
            <?php
                include("inc/function.php");
                include("inc/header.php");
                include("inc/navbar.php");
               
               
                include("inc/bodyleft.php");
                include("inc/bodyright.php");
                echo add_cart();
                 echo u_signup();
                include("inc/footer.php");
              
                
            ?>
        
    </body>
   
</html>