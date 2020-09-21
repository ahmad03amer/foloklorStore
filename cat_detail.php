
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
           
            echo"<div id='bodyleft'><ul>"; cat_detail();sub_cat_detail();add_cart();echo"</ul></div>";
            echo"<div class='bodyright' id='bodyright'>
          
            <ul>"; viewall_sub_cat();viewall_cat();echo"</ul>
            
            </div><br clear='all'/>";
            
            include("inc/footer.php");
           
        ?>
        
    
</body>

</html>