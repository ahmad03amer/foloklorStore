
<?php
//min and max range 
$minimum_range = 20;
$maximum_range = 500;
?>

<html>  
    <head>  
        <title>Price Range</title>  
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <link rel="stylesheet" href="../css/style14.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
		
    </head>  

    <style>/* Style the header */
.header {
  padding: 10px 16px;
  background: #555;
  color: #f1f1f1;
}

/* Page content */
.content {
  padding: 16px;
}

/* The sticky class is added to the header with JS when it reaches its scroll position */
.sticky {
  position: fixed;
  top: 0;
  width: 100%
}

/* Add some top padding to the page content to prevent sudden quick movement (as the header gets a new position at the top of the page (position:fixed and top:0) */
.sticky + .content {
  padding-top: 102px;
}
        #element{
            padding-bottom:50px;
            height: 300px;
            width: 100%;
            font-size: 15px;
            border: ridge 2px solid black;
            border-radius: 4px;
        }
        #element >img{
            height: 80%;
            width: 100%;
            border-radius: 4px;
            padding:2px;
        }
        #element >h3{
            height: 15%;
            width: 100%;
            border-radius: 4px;
            padding-bottom: 5px;
        }
    </style>
    <body>  
            <div class="header" id="my-Header">
                <h4>Return to the main Page from<a href="../index.php"> Here </a></h4>
              </div>
              <script>
                                // When the user scrolls the page, execute myFunction
                window.onscroll = function() {myFunction()};

                // Get the header
                var header = document.getElementById("myHeader");

                // Get the offset position of the navbar
                var sticky = header.offsetTop;

                // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
                function myFunction() {
                if (window.pageYOffset > sticky) {
                    header.classList.add("sticky");
                } else {
                    header.classList.remove("sticky");
                }
                }
              </script>
        <div class="container">  
            <br />  
            <br />
			<br />
			<h3 align="center">Filter the search Result</a></h3><br />
			<br />
			<div class="row">
				<div class="col-md-2">
					<input type="text" name="minimum_range" id="minimum_range" class="form-control" value="<?php echo $minimum_range; ?>" />
				</div>
				<div class="col-md-8" style="padding-top:12px">
					<div id="price_range"></div>
				</div>
				<div class="col-md-2">
					<input type="text" name="maximum_range" id="maximum_range" class="form-control" value="<?php echo $maximum_range; ?>" />
				</div>
			</div>
			<br />
            <!-- this section will filld using ajax techniqe-->
			<div id="load_product">
            </div>
			<br />
		</div>
    </body>  
</html>  
<script>  
$(document).ready(function(){  
    
	$( "#price_range" ).slider({
		range: true,
		min: 1,
		max: 2000,
		values: [ <?php echo $minimum_range; ?>, <?php echo $maximum_range; ?> ],
		slide:function(event, ui){
			$("#minimum_range").val(ui.values[0]);
			$("#maximum_range").val(ui.values[1]);
			load_product(ui.values[0], ui.values[1]);
		}
	});
	
	load_product(<?php echo $minimum_range; ?>, <?php echo $maximum_range; ?>);
	//load the products to the web page and will return list of products
	function load_product(minimum_range, maximum_range)
	{
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data:{minimum_range:minimum_range, maximum_range:maximum_range},
			success:function(data)//sucess call back fn.
			{
				$('#load_product').fadeIn('slow').html(data);
			}
		});
	}
	
});  
</script>
