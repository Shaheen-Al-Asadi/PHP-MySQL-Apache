<html>
  <head>
    <title>FSOSS Registration</title>
  </head>
  <body>

<?php 

//( isset($_POST['submit']) ) {}
//if (key_exists('submit', $_POST) )
//if ( exists($_POST) )
//IF ($_POST)
//Possible ways to detect a submited form

//if($_POST){
//echo "Your First Name is: ". $_POST['firstName'] . "</br>";
//echo "Your Last Name is: ". $_POST['lastName'] . "</br>";
//echo "Your Organization is :". $_POST['organization']. "</br>";
//echo "<p>Welcome to the Website</p>";
//}

$firstNameErr ="";
$lastNameErr ="";
$postalErr ="";
$phoneErr = "";
$postalRegex ='/(\s*[a-zA-Z][0-9][a-zA-Z]\s[0-9][a-zA-z][0-9]\s*|\s*[a-zA-Z][0-9][a-zA-Z][0-9][a-zA-z][0-9]\s*)/';
$validatePostal = $_POST['postal'];
$validatePhone = $_POST['phone'];
$phoneRegex = '/(\s*[0-9]{3}\s[0-9]{3}\s[0-9]{4}\s*|\s*[0-9]{3}\-[0-9]{3}\-[0-9]{4}\s*|\s*\([0-9]{3}\)\s[0-9]{3}\s[0-9]{4}\s*)/';
$dataValid = true;
// If submit with POST
if ($_POST) { 
        // Test for nothing entered in field
	if ($_POST['firstName'] == "") {
		$firstNameErr = "Error - you must fill in a first name";
		$dataValid = false;
	}
	if ($_POST['lastName'] == "") {
		$lastNameErr = "Error - you must fill in a last name";
		$dataValid = false;		
	}
	if($_POST['postal'] == "" || !preg_match($postalRegex , $validatePostal)){
		$postalErr = "Empty or Incorrect Postal Format ( X9X 9X9 )";
		$dataValid = false;
	}
	if($_POST['phone'] == "" || !preg_match($phoneRegex , $validatePhone)){
		$phoneErr = "Empty or Incorrect Phone Format ( 999 999 9999 )";
		$dataValid = false;
	}
}
// If the submit button was pressed and something was entered in both fields, process data
// (we just print a mesg)
if ($_POST && $dataValid) { 
?>
	Data is Valid!

<?php
// If no submit or data is invalid, print form, repopulating fields and printing err mesgs
} else { 
?>

<h1>FSOS Registration</h1>
  <form method="POST">
	<table>
	<tr>
    	<td valign="top">Title:</td>
	<td>
		<table>
		<tr>
		<td><input type="radio" name="title" value="mr"<?php if ($_POST['title'] == "mr") echo "CHECKED"; ?>>Mr</td>
		</tr>
		<tr>
		<td><input type="radio" name="title" value="mrs"<?php if ($_POST['title'] == "mrs") echo "CHECKED"; ?>>Mrs</td>
		</tr>
		<tr>
		<td><input type="radio" name="title" value="ms"<?php if ($_POST['title'] == "ms") echo "CHECKED"; ?>>Ms</td>
		</tr>
		</table>
	</td>
	</tr>
	<tr>
    	<td>First name:</td>
	<td><input name="firstName" type="text" value="<?php if(isset($_POST['firstName'])){ echo $_POST['firstName'];} ?>"><?php echo$firstNameErr;?></td>
	</tr>
	<tr>
    	<td>Last name:</td>
	<td><input name="lastName" type="text" value="<?php if(isset($_POST['lastName'])){ echo $_POST['lastName'];}?>"><?php echo$lastNameErr;?></td>
	</tr>
	<tr>
    	<td>Organization:</td>
	<td><input name="organization" type="text" value="<?php if(isset($_POST['organization'])){ echo $_POST['organization'];}?>"></td>
	</tr>
	<tr>
    	<td>Email address:</td>
	<td><input name="email" type="text" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];}?>"></td>
	</tr>
	<tr>
	<td>Postal Code:</td>
	<td><input name="postal" type="text" value="<?php if(isset($_POST['postal'])){ echo $_POST['postal'];}?>"><?php echo$postalErr;?></td>
	</tr>
	<tr>
    	<td>Phone number:</td>
	<td><input name="phone" type="text" value="<?php if(isset($_POST['phone'])){ echo $_POST['phone'];}?>"> <?php echo$phoneErr;?></td>
	</tr>
	<tr>
    	<td>Days attending:</td>
	<td>
		<input name="monday" type="checkbox" value="monday"<?php if ($_POST['monday'] == "monday") echo "CHECKED"; ?>>Monday
		<input name="tuesday" type="checkbox" value="tuesday"<?php if ($_POST['tuesday'] == "tuesday") echo "CHECKED"; ?>>Tuesday<td/>
	</tr>
	<tr>
	<td>T-shirt size:</td>
	<td>
	<select name="t-shirt">
	<option>--Please choose--</option>
	<option value="s">Small</option>
	<option value="m">Medium</option>
	<option value="l">Large</option>
	<option value="xl">X-Large</option>
	</select>
	</td>
	</tr>
	<tr><td><br></td></tr>
	<tr>
	<td></td>
	<td><input name="submit" type="submit"></td>
	</tr>
  </form>
<?php
}
?>
  </body>
</html>
