<?php
//error_reporting(E_ALL);
ini_set('display_errors', 'On');
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "longjo-db","GPKFsDyR0Sp66PFe","	longjo-db");
if($mysqli->connection_errno)
{
	echo "Connection Error " . $mysqli->connection_errno . " " . $mysqli->connection_error;
	
}
echo "THIS WORKS!!!";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<body>
	<div>
		<table>

			<tr>
				<td>Battlestar People</td>
			</tr>
			
			
			<tr>
				<td>Name</td>
				<td>Age</td>
				<td>Homeworld</td>
			</tr>


	<?php
		if (!($stmt = $mysqli->prepare("SELECT fname, age, homeworld FROM bsg_people")))
		{
			echo "Prepare failed " . $mysqli->connection_errno . " " . $mysqli->connection_error;
		}
		if (!$stmt->execute())
		{
			echo "Execute Failed " . $mysqli->connection_errno . " " . $mysqli->connection_error;
		}

		if ( $stmt->bind_result($name, $age, $homeworld))
		{
			echo "Bind Failed " . $mysqli->connection_errno . " " . $mysqli->connection_error;
		}
		
		while ($stmt->fetch())
		{
			echo "<tr>\n<td>" . $name . "\n</td>\n<td>" . $age . "</td>\n<td>" . $homeworld . "</td>\n</tr>";
		}
		
	?>
	


		</table>
	</div>
	
	<div>
		<form method="post" action="HTMLexample.html"> <!-- change later -->
		
			<fieldset>
				<legend>Name </legend>
				<p>First Name: <input type="text" name="FirstName" /></p>
				<p>Last Name: <input type="text" name="LastName" /></p>
				
			</fieldset>
			
			<fieldset>
				<legend>Age </legend>
				<p>Age: <input type="text" name="Age" /></p>
				
			</fieldset>
			
			<fieldset>
				<legend>Homeworld</legend>
				<select>
					<option value="1">Caprica</option>
					<option value="2">Gemenon</option>
				</select>
			</fieldset>

			
			<p><input type="submit" /></p>
		</form>
	</div>
	
	<div>
		<form method="post" action="HTMLexample.html">
			<fieldset>
				<legend>Planet Name</legend>
				<p>Planet Name: <input type="text" name="PName" /></p>
			</fieldset>
			
			<fieldset>
				<legend>Planet Populations</legend>
				<p>Planet Population: <input type="text" name="PPopulation" /></p>
			</fieldset>
			
			<fieldset>
				<legend>Language</legend>
				<p>Language: <input type="text" name="PLanguage" /></p>
			</fieldset>
			
			
			<input type="submit" name="add" value="Add Planet" />
			<input type="submit" name="update" value="Update" />
			
		</form>
	
	
	</div>


</body>

</html>