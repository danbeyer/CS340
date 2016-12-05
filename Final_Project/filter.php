<?php

//error_reporting(E_ALL);
ini_set('display_errors', 'On');
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","beyerda-db","Bik0Ek2mqI3IPA1L","beyerda-db");

//check for connection_aborted
if ($mysqli->connect_errno){
	echo "Connection Error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
echo "it works.....";


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>HTMLExampledb.php</title>
</head>

<body>
	<div>
		<table>

			<tr>
				<td>Products...</td>
			</tr>
			
			
			<tr>
				<td>UPC</td>
				<td>description</td>
				<td>On Hand</td>
				<td>Cost</td>
				<td>Price</td>
				<td>Supplier</td>
			</tr>
			
			<?php

				if(!($stmt = $mysqli->prepare("
						SELECT p.upc, p.description, p.onHand, p.cost, p.price, s.supplierID 
						FROM products as p
						INNER JOIN suppliers as s
						ON s.supplierID = p.sid	
						WHERE p.sid = ?
						")))
		
				{
					echo "prepare failed... " . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				
				if(!($stmt->bind_param("i",$_POST['name'])))
				{
					echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;

				}
				

				//might have to change mysqlil->connect_errno to $stmt->errno
				if(!($stmt->execute()))
				{
					echo "execute failed... " . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}

				if(!($stmt->bind_result($upc, $description, $onHand, $price, $cost, $sid)))
				{
					echo "bind failed... " . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}

				while ($stmt->fetch()){
					//echo "<tr>\n<td>" . $name . "\n</td>\n<td>" . $age . "</td>\n<td>" . $homeworld . "</td>\n</tr>";
					
					echo "<tr>\n<td>" . 
							$upc . "\n</td>\n<td>" . 
							$description . "</td>\n<td>" . 
							$onHand . "</td>\n<td>" .
							$cost . "</td>\n<td>" .
							$price . "</td>\n<td>" .
							$sid . "</td>\n</tr>";
								
				}

				$stmt->close();
			?>
			
		

		</table>
	</div>
	</body>
	
	<script>
			document.write('<a href="' + document.referrer + '">Go Back</a>');
		</script>
	</html>
