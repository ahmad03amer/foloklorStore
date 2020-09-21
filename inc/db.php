
<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "foloklor_store";

$con = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser, $dbpass);

    if(!$con ) {
        die("Could not connect to database");
        }

    try{
        $con =new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser, $dbpass);
      //  echo "Connected Succsessfuly!";
        echo"<br/><br/><br/>";
        
    }catch(PDOException $e){
        $error_message = $e->getMessage();//في getline , getcode 
        echo $error_message;   
        exit();
    }
?>
