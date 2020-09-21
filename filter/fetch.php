
<?php

//fetch.php
include("../inc/db.php");

//return the products with the defined price
$query = "SELECT * FROM products WHERE pro_price BETWEEN '".$_POST["minimum_range"]."' AND '".$_POST["maximum_range"]."' ORDER BY pro_price ASC";

$statement = $con->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$total_row = $statement->rowCount();

//the numer of item to be listed on the page
$output = '
<h4 align="center">Total Item - '.$total_row.'</h4>
<div class="row">
';
if($total_row > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<div class="col-md-2">
			<div id="element">
				<img src="../imgs/pro_img/'.$row["pro_img1"].'" class="img-responsive img-thumnai img-circle" />
				<h4 align="center">'.$row["pro_name"].'</h4>
				<h3 align="center" class="text-danger">'.$row["pro_price"].'</h3>
				<br />
			</div>
		</div>
		';
	}
}
else
{
    //if there is co product with the range
	$output .= '
		<h3 align="center">No Product Found</h3>
	';
}

$output .= '
</div>
';

//send to ajax request
echo $output;

?>
