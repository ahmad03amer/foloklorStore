
<html>

    <head>
        <title>Foloklor Store</title>
        <link rel="stylesheet" href="css/style14.css">
        
        <script src="js/main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>

    <style>
     .fbutton {
    width: 180px;
    height: 35px;
    border-radius: 4px;
    border: ridge 2px solid black;
    margin-left:100px;
    text-decoration:none;
    margin-top:10px;
}

.fbutton:hover {
   background: lightgreen;
}
    </style>
    <body>
            <?php
                include("inc/function.php");
                include("inc/header.php");
                include("inc/navbar.php");
                
                echo "<button type='submit' class='fbutton'><a href='filter/fpage.php'>Filter the Products</button> 
                 ";
                echo search();
                include("inc/bodyright.php");
                include("inc/footer.php");
               
                
            ?>
        
    </body>
   
</html>