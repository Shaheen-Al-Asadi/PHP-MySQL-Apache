<?php
// Example of DB APPEND and SELECT
// You must create a table called registrant that has two columns of varchar(30) each.

// For debugging purposes
// print_r($_POST);
$firstNameErr = "";
$lastNameErr = "";
$valid = True;
if ( $_POST ) {
	if ( $_POST['firstName'] == "" ) { // validate fields
		$firstNameErr = "You must enter a first name";
		$valid = false;
	}
	if ( $_POST['lastName'] == "" ) { // validate fields
		$lastNameErr = "You must enter a first name";
		$valid = false;
	}
	if ( $valid ) { // process form - add to DB and then print out all records
		// get database servername, username, password, and database name
          	//  from local file not on web accessible path (remove newline/blanks)
		$lines = file('/home/int322/secret/topsecret');
		$dbserver = trim($lines[0]);
		$uid = trim($lines[1]);
		$pw = trim($lines[2]);
		$dbname = trim($lines[3]);

		//Connect to the mysql server and get back our link_identifier
 		$link = mysqli_connect($dbserver, $uid, $pw, $dbname)
         			or die('Could not connect: ' . mysqli_error($link));
 
		//Our SQL Query
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
 		$sql_query = 'INSERT INTO registrant set firstName="' . $firstName . '", lastName="' . $lastName . '"';
		// For debugging purposes
		print $sql_query;
 
		//Run our sql query
 		$result = mysqli_query($link, $sql_query) or die('query failed'. mysqli_error($link));

		// Get all records now in DB
		$sql_query = "SELECT * from registrant";
		//Run our sql query
 		$result = mysqli_query($link, $sql_query) or die('query failed'. mysqli_error($link));
 
 		//iterate through result printing each record
		print "<br>Names in DB: <br>";
?>
<html>
<body>
<table border="1">
<tr>
<th>First Name</th><th>Last Name</th>
<?php

 		while($row = mysqli_fetch_assoc($result))
 		{
?>
		<tr>
		<td><?php print $row['firstName']; ?></td>
		<td><?php print $row['lastName']; ?></td>
		</tr>
<?php
 		}

?>
</table>
</body>
</html>
<?php
 
		// Free resultset (optional)
		mysqli_free_result($result);
  
		//Close the MySQL Link
 		mysqli_close($link);
		// print "Name entered: " . $_POST['firstName'] . ' ' . $_POST['lastName'];
	}
}

// if not valid or not post then display web form again - otherwise, don't!
if ( !$valid ||  !$_POST ) {
?>
<html>
<body>
<form method="POST" action="">
Enter first name: <input type="text" name="firstName" value="<?php if ( isset($_POST['firstName']) ) print $_POST['firstName']; ?>"><strong><?php print $firstNameErr; ?></strong>
<br>
Enter last name: <input type="text" name="lastName" value="<?php if ( isset($_POST['lastName']) ) print $_POST['lastName']; ?>"><strong><?php print $lastNameErr; ?></strong>
<br>
<input type="submit" name="submit">
</form>
<?php
}
?>
</body>
</html>
