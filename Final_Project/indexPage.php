<?php

//error_reporting(E_ALL);
ini_set('display_errors', 'On');
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","beyerda-db","Bik0Ek2mqI3IPA1L","beyerda-db");

//check for connection_aborted
if ($mysqli->connect_errno){
	echo "Connection Error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
echo "";


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>indexPage.php</title>
</head>

<body>
	<div>
	<h1>CS340 Final Project - Retail Store Database</h1>
	<h3>Joseph Long</h3>
	<h3>Daniel Beyer</h3>
		<table>

			<tr>
				<td><b>Product List:</b></td>
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
				if(!($stmt = $mysqli->prepare("
						SELECT p.upc, p.description, p.onHand, p.cost, p.price, s.supplierID 
						FROM products as p
						INNER JOIN suppliers as s
						ON s.supplierID = p.sid												
						")))
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
	</div>
	
	
	<!-- now creating a new form to add a Product... -->
	<div>
		<form method="post" action="addproductdb.php"> 
		
			<fieldset>
				<legend>Add a Product</legend>
				<p>upc:<input type="text" name="upc" /></p>
				<p>description: <input type="text" name="description" /></p>
				<p>onHand: <input type="text" name="onHand" /></p>
				<p>cost: <input type="text" name="cost" /></p>
				<p>price: <input type="text" name="price" /></p>
				<!-- <p>sid: <input type="text" name="sid" /></p> -->
				
			</fieldset>
			
			
			
			
			
			
			<!-- add selector for selecting id of vendor... -->
			
			<fieldset>
			<legend>Select Supplier for Product</legend>
			<select name="name">
				<?php
				if(!($stmt = $mysqli->prepare("SELECT supplierID, name FROM suppliers"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($supplierID, $name)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
					echo '<option value=" '. $supplierID . ' "> ' . $name . '</option>\n';
				}
				$stmt->close();
				?>
			</select>
		</fieldset>
					
			
			<p><input type="submit" value="ADD Product"/></p>
		</form>
	</div>
	
	
	
	<!-- filter products by supplier...-->	

		<div>
			<form method="post" action="filter.php">
				<fieldset>
					<legend>Filter Products by Supplier</legend>
						<select name="name">
						<?php
							if(!($stmt = $mysqli->prepare("SELECT supplierID, name FROM suppliers"))){
								echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
							}

							if(!$stmt->execute()){
								echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							if(!$stmt->bind_result($supplierID, $name)){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							while($stmt->fetch()){
								echo '<option value=" '. $supplierID . ' "> ' . $name . '</option>\n';
							}
							$stmt->close();
						?>
						</select>
				</fieldset>
				<input type="submit" value="Run Filter" />
			</form>
		</div>
	<br/>
	<br/>
	
	
	<!--Creating a add a customer...-->
	<div>
				<table>

					<tr>
						<td><b>Customer List:</b></td>
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
						<legend>Add a Customer</legend>
						<p>customerID:<input type="text" name="customerID" /></p>
						<p>firstName:<input type="text" name="firstName" /></p>
						<p>lastName: <input type="text" name="lastName" /></p>
						<p>email: <input type="text" name="email" /></p>
						<p>region: <input type="text" name="region" /></p>
						
					</fieldset>
					<p><input type="submit" value="ADD Customer"/></p>
				</form>
			</div>
	
		<br/>
		<br/>	
	<div>
	

	<div>
				<table>

					<tr>
						<td><b>Supplier List:</b></td>
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
	
	<!-- creating a filter by region for supplier... -->
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
			 <!-- now creating a new form to add a Supplier...  -->
			<div>
				<form method="post" action="addSupplierdb.php"> 
				
					<fieldset>
						<legend>Add a Supplier</legend>
						<p>supplierID:<input type="text" name="supplierID" /></p>
						<p>name:<input type="text" name="name" /></p>
						<p>region:<input type="text" name="region" /></p>
						<p>totalPurchases: <input type="text" name="totalPurchases" /></p>
						
					</fieldset>
					<p><input type="submit" value="ADD Supplier" /> </p>
				</form>
			</div>
			<br/>
	<br/>	
	
	<div>
	
	
	<div>
				<table>

					<tr>
						<td><b>Store List:</b></td>
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
							echo "<tr>\n<td>" . $storeID . "\n</td>\n<td>" . $region . "</td>\n</tr>\n";
							
										
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
						<legend>Add a Store</legend>
						<p>storeID:<input type="text" name="storeID" /></p>
						<p>region:<input type="text" name="region" /></p>
						
					</fieldset>
					<p><input type="submit" value="ADD Store"/> </p>
				</form>
			</div>
				<br/>
	<br/>
			
<div>
				<table>

					<tr>
						<td><b>Order List:</b></td>
					</tr>
					
					
					<tr>
						<td>OrderID</td>
						<td>Order Date</td>
						<td>CustomerID</td>
					</tr>
				<?php

						if(!($stmt = $mysqli->prepare("SELECT orderID, orderDate, cid FROM orders")))
						{
							echo "prepare failed... " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

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
						
						//close the statement....
						$stmt->close();
					?>
					</table>
				</div>
			<!-- now creating a new form to add an Order...  -->	
		<div>
		
				<form method="post" action="addOrderdb.php"> 
				
					<fieldset>
						<legend>Add an Order</legend>
						<p>OrderID:<input type="text" name="orderID" /></p>
						<p>Order Date:<input type="date" name="orderDate" /></p>
						<!--<p>Customer ID:<input type="text" name="cid" /></p> -->
						
					</fieldset>
		<fieldset>
			<legend>Select CustomerID</legend>
			<select name="customerID">
				<?php
				if(!($stmt = $mysqli->prepare("SELECT customerID, firstName, lastName FROM customers"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($customerID, $firstName, $lastName)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
					echo '<option value=" '. $customerID . ' "> ' . $firstName . ' ' . $lastName .'</option>\n';
				}
				$stmt->close();
				?>
			</select>
		</fieldset>			
					
					<p><input type="submit" value="ADD Order"/> </p>
				</form>
			</div>
		<br/>
	<br/>
	
	<div>
				<table>

					<tr>
						<td><b>Product Orders List:</b></td>
					</tr>
					
					
					<tr>
						<td>Product Order ID</td>
						<td>Order ID</td>
						<td>Product ID</td>
						<td>Quantity</td>
					</tr>
				<?php


						
						if(!($stmt = $mysqli->prepare("SELECT poID, oid, pid, quantity FROM product_orders")))
						{
							echo "prepare failed... " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						
						if(!($stmt->execute()))
						{
							echo "execute failed... " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						if(!($stmt->bind_result($poID, $oid, $pid, $quantity)))
						{
							echo "bind failed... " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						while ($stmt->fetch()){
							
							
							echo "<tr>\n<td>" . 
									$poID . "\n</td>\n<td>" . 
									$oid . "</td>\n<td>" . 
									$pid . "</td>\n<td>" .
									$quantity ."</td>\n<tr>";

										
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
		
				<form method="post" action="addProduct_ordersdb.php"> 
				
					<fieldset>
						<legend>Add a Product Order</legend>
						<p>Product Order ID:<input type="text" name="poID" /></p>
						<!--<p>Order ID:<input type="text" name="oid" /></p> -->
						<!--<p>Product ID:<input type="text" name="pid" /></p> -->
						<p>Quantity:<input type="text" name="quantity" /></p>
						
					</fieldset>
								<!-- add selector for selecting orderID of product order... -->
			
			<fieldset>
			<legend>Select OrderID</legend>
			<select name="OrderID">
				<?php
				if(!($stmt = $mysqli->prepare("SELECT orderID, orderID FROM orders"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($orderID, $name)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
					echo '<option value=" '. $orderID . ' "> ' . $orderID . '</option>\n';
				}
				$stmt->close();
				?>
			</select>

					<!-- add selector for selecting product of product order... -->
			
			<br/>
			<br/>
			<legend>Select Product</legend>
			<select name="ProductID">
				<?php
				if(!($stmt = $mysqli->prepare("SELECT upc, description FROM products"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($upc, $description)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
					echo '<option value=" '. $upc . ' "> ' . $description . '</option>\n';
				}
				$stmt->close();
				?>
			</select>
		</fieldset>

					

					<p><input type="submit" value="ADD Product Order"/></p>
				</form>
			</div>
		<br/>
	<br/>

	
	</div>
	
	<div>
	



</body>

</html>