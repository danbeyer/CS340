<?php 
//error_reporting(E_ALL);
ini_set('display_errors', 'On');
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","beyerda-db","Bik0Ek2mqI3IPA1L","beyerda-db");
/* if($mysqli->connection_errno)
{
	echo "Connection Error " . $mysqli->connection_errno . " " . $mysqli->connection_error;	
} */
echo "THIS WORKS!!!";


//if(!($stmt = $mysqli->prepare("INSERT INTO bsg_people(fname, lname, homeworld, age) VALUES (?,?,?,?)")))
if(!($stmt = $mysqli->prepare("INSERT INTO products(upc, description, onHand, cost, price, sid) VALUES (?,?,?,?,?,?)")))
{
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

//if(!($stmt->bind_param("ssii",$_POST['FirstName'],$_POST['LastName'],$_POST['Homeworld'],$_POST['Age'])))
if(!($stmt->bind_param("isiiii",$_POST['upc'],$_POST['description'],$_POST['onHand'],$_POST['cost'],$_POST['price'],$_POST['sid'])))
{
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;

	
}
if(!$stmt->execute())
{
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} 
else 
{
	echo "Added " . $stmt->affected_rows . " rows to products.";
}
 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>addperson.php</title>
</head>








<body>
<br>
<script>
    document.write('<a href="' + document.referrer + '">Go Back</a>');
</script>


</body>
</html>