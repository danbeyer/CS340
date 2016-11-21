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
<title>HTMLExample.php</title>
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


				//if(!($stmt = $mysqli->prepare("SELECT fname, age, homeworld FROM bsg_people")))
				if(!($stmt = $mysqli->prepare("SELECT upc, description, onHand, cost, price, sid FROM products")))
				{
					echo "prepare failed... " . $mysqli->connect_errno . " " . $mysqli->connect_error;
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
				/*

				*/
				//close the statement....
				$stmt->close();
			?>
			
		

		</table>
	<div>
	
	
	<!-- now creating a new form to add a Product... -->
	<div>
		<form method="post" action="addproductdb.php"> 
		
			<fieldset>
				<legend>PRODUCT</legend>
				<p>upc:<input type="text" name="upc" /></p>
				<p>description: <input type="text" name="description" /></p>
				<p>onHand: <input type="text" name="onHand" /></p>
				<p>cost: <input type="text" name="cost" /></p>
				<p>price: <input type="text" name="price" /></p>
				<p>sid: <input type="text" name="sid" /></p>
				
			</fieldset>
			<p><input type="submit" /></p>
		</form>
	</div>
	
	
	
	<!--Creating a add a customer...-->
	<div>
				<table>

					<tr>
						<td>CUSTOMERS</td>
					</tr>
					
					
					<tr>
						<td>customerID</td>
						<td>firstName</td>
						<td>lastName</td>
						<td>email</td>
						<td>region</td>
					</tr>
					
					<?php


						//if(!($stmt = $mysqli->prepare("SELECT fname, age, homeworld FROM bsg_people")))
						if(!($stmt = $mysqli->prepare("SELECT customerID, firstName, lastName, email, region FROM customers")))
						{
							echo "prepare failed... " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						//might have to change mysqlil->connect_errno to $stmt->errno
						if(!($stmt->execute()))
						{
							echo "execute failed... " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						if(!($stmt->bind_result($customerID, $firstName, $lastName, $email, $region)))
						{
							echo "bind failed... " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						while ($stmt->fetch()){
							//echo "<tr>\n<td>" . $name . "\n</td>\n<td>" . $age . "</td>\n<td>" . $homeworld . "</td>\n</tr>";
							
							echo "<tr>\n<td>" . 
									$customerID . "\n</td>\n<td>" . 
									$firstName . "</td>\n<td>" . 
									$lastName . "</td>\n<td>" .
									$email . "</td>\n<td>" .
									$region . "</td>\n</tr>";
										
						}
						/*

						*/
						//close the statement....
						$stmt->close();
					?>
					
				

				</table>
			<div>
	
	
			<!-- now creating a new form to add a customer... -->
			<div>
				<form method="post" action="addCustomerdb.php"> 
				
					<fieldset>
						<legend>CUSTOMER</legend>
						<p>customerID:<input type="text" name="customerID" /></p>
						<p>firstName:<input type="text" name="firstName" /></p>
						<p>lastName: <input type="text" name="lastName" /></p>
						<p>email: <input type="text" name="email" /></p>
						<p>region: <input type="text" name="region" /></p>
						
					</fieldset>
					<p><input type="submit" /></p>
				</form>
			</div>
	
	
	
	
	
	
	
	
	<div>
	
	
	
	<div>
				<table>

					<tr>
						<td>SUPPLIERS</td>
					</tr>
					
					
					<tr>
						<td>supplierID</td>
						<td>name</td>
						<td>region</td>
						<td>totalPurchases</td>
					</tr>
					
					<?php
					

						//if(!($stmt = $mysqli->prepare("SELECT fname, age, homeworld FROM bsg_people")))
						if(!($stmt = $mysqli->prepare("SELECT supplierID, name, region, totalPurchases FROM suppliers")))
						{
							echo "prepare failed... " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						
						
						//might have to change mysqlil->connect_errno to $stmt->errno
						if(!($stmt->execute()))
						{
							echo "execute failed... " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						
						if(!($stmt->bind_result($supplierID, $name, $region, $totalPurchases)))
						{
							echo "bind failed... " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						
						while ($stmt->fetch()){
							echo "<tr>\n<td>" . $supplierID . "\n</td>\n<td>" . $name . "</td>\n<td>" . $region . "</td>\n<td>" . $totalPurchases . "</td>\n</tr>";
							
							/*
							echo "<tr>\n<td>" . 
									$supplierID . "\n</td>\n<td>" . 
									$region . "</td>\n<td>" .  .
									$totalPurchases . "</td>\n</tr>";
								*/		
						}
						
						//close the statement....
						$stmt->close();
						/*
						*/
					?>
					
				

				</table>
			<div>
	
	
			 <!-- now creating a new form to add a Supplier...  -->
			<div>
				<form method="post" action="addSupplierdb.php"> 
				
					<fieldset>
						<legend>SUPPLIER</legend>
						<p>supplierID:<input type="text" name="supplierID" /></p>
						<p>name:<input type="text" name="name" /></p>
						<p>region:<input type="text" name="region" /></p>
						<p>totalPurchases: <input type="text" name="totalPurchases" /></p>
						
					</fieldset>
					<p><input type="submit" /> <--- addSupplier</p>
				</form>
			</div>
			
	
	
	
	
	
	
	
	<div>
	
	
	<div>
				<table>

					<tr>
						<td>STORES</td>
					</tr>
					
					
					<tr>
						<td>storeID</td>
						<td>region</td>
					</tr>
					
					<?php
					

						//if(!($stmt = $mysqli->prepare("SELECT fname, age, homeworld FROM bsg_people")))
						if(!($stmt = $mysqli->prepare("SELECT storeID, region FROM stores")))
						{
							echo "prepare failed... " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						
						
						//might have to change mysqlil->connect_errno to $stmt->errno
						if(!($stmt->execute()))
						{
							echo "execute failed... " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						
						if(!($stmt->bind_result($storeID, $region)))
						{
							echo "bind failed... " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						
						while ($stmt->fetch()){
							echo "<tr>\n<td>" . $storeID . "\n</td>\n<td>" . $region . "</td>\n<tr>\n";
							
							/*
							echo "<tr>\n<td>" . 
									$storeID . "\n</td>\n<td>" . 
									$region . "</td>\n<td>" .  .
									$region . "</td>\n</tr>";
									*/
										
						}
						
						//close the statement....
						$stmt->close();
						/**/
						
					?>
					
				

				</table>
			<div>
	
	
			 <!-- now creating a new form to add a Product...  -->
			<div>
				<form method="post" action="addStoredb.php"> 
				
					<fieldset>
						<legend>STORES</legend>
						<p>storeID:<input type="text" name="storeID" /></p>
						<p>region:<input type="text" name="region" /></p>
						
					</fieldset>
					<p><input type="submit" /> <--- addStore</p>
				</form>
			</div>
			
<div>
				<table>

					<tr>
						<td>ORDERS</td>
					</tr>
					
					
					<tr>
						<td>OrderID</td>
						<td>Order Date</td>
						<td>CustomerID</td>
					</tr>
				<?php


						//if(!($stmt = $mysqli->prepare("SELECT fname, age, homeworld FROM bsg_people")))
						if(!($stmt = $mysqli->prepare("SELECT orderID, orderDate, cid FROM orders")))
						{
							echo "prepare failed... " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						//might have to change mysqlil->connect_errno to $stmt->errno
						if(!($stmt->execute()))
						{
							echo "execute failed... " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						if(!($stmt->bind_result($orderID, $orderDate, $cid)))
						{
							echo "bind failed... " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						while ($stmt->fetch()){
							//echo "<tr>\n<td>" . $name . "\n</td>\n<td>" . $age . "</td>\n<td>" . $homeworld . "</td>\n</tr>";
							
							echo "<tr>\n<td>" . 
									$orderID . "\n</td>\n<td>" . 
									$orderDate . "</td>\n<td>" . 
									$cid . "</td>\n<tr>";

										
						}
						/*

						*/
						//close the statement....
						$stmt->close();
					?>
					</table>
				</div>
			<!-- now creating a new form to add an Order...  -->	
		<div>
		
				<form method="post" action="addOrderdb.php"> 
				
					<fieldset>
						<legend>ORDERS</legend>
						<p>OrderID:<input type="text" name="orderID" /></p>
						<p>Order Date:<input type="date" name="orderDate" /></p>
						<p>Customer ID:<input type="text" name="cid" /></p>
						
					</fieldset>
					<p><input type="submit" /> <--- addOrder</p>
				</form>
			</div>
	
	
	
	
	
	<div>
	

	<!--
		<form method="post" action =filter.php">
			<fieldset>
				<legend>
					<select name="Homeworld">
						
					<?php
					
						if(!($stmt = $mysqli->prepare("SELECT id, name FROM bsg_planets"))){
							echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
						}

						if(!$stmt->execute()){
							echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						if(!$stmt->bind_result($id, $pname)){
							echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						while($stmt->fetch()){
						 echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
						}
						$stmt->close();
						
					?>
		
						
					</select>
				</legend>
			</fieldset>
			<input type ="submit" value="Run Filter" />
		</form>
		-->
	</div>
	
	<div>
	
	
	
					
	
	
	
	
	
	
	
	
	
	<!--
	<div>
		<form method="post" action="HTMLexample.html">
			<fieldset>
				<legend>STORES</legend>
				<p>storeID: <input type="text" name="storeID" /></p>
				<p>region: <input type="text" name="region" /></p>
			</fieldset>
			<br><br>

			<br><br>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			<fieldset>
				<legend>SUPPLIERS</legend>
				<p>suppID: <input type="text" name="suppID" /></p>
				<p>address: <input type="text" name="address" /></p>
			</fieldset>
			
			
			<input type="submit" name="add" value="Add Planet" />
			<input type="submit" name="update" value="Update" />
			
		</form>
	
	
	</div>
	-->


</body>

</html>