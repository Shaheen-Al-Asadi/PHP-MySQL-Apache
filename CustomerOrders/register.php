<?php

if(isset($_POST['submit']))
{
//values that will hold error messages
$firsterror ="";
$lasterror="";
$oerror="";
$eerror="";
$perror="";
$valid = true;
$titler="";
$day="";
$sh="";
$ti=$_POST['title'];
$fi=$_POST['firstName'];
$ls=$_POST['lastName'];
$or=$_POST['organization'];
$em=$_POST['email'];
$ph=$_POST['phone'];
$mon=$_POST['monday'];
$tue=$_POST['tuesday'];
$st=$_POST['t-shirt'];

//id any of the data comming form the html is empty the error will be actoivated
if(empty($_POST['title']))
{
$titler="select tile";
$valid=false;
}
if(empty($_POST['monday'])&& (empty($_POST['tuesday'])))
{
$valid=false;
$day="please select a day";
}


if($_POST['t-shirt']=='--Please choose--' ){
$sh="Please select a shirt size";
$valid = false;
}

if($_POST['firstName'] == ""){
$firsterror="First Name is Empty";
$valid = false;
}

if($_POST["lastName"] == ""){
$valid=false;
$lasterror="Last Name is Empty";
}
if($_POST["organization"] == ""){
$valid=false;
$oerror="organization Name is Empty";
}

if($_POST["email"] == ""){
$valid=false;
$eerror="email Name is Empty";
}

if($_POST["phone"] == ""){
$valid=false;
$perror="phone Name is Empty";
}


}

if($valid && $_POST)
{






$dboject=mysqli_connect("db-mysql.zenit","int322_162a27","qeHW2354","int322_162a27") or die ("could not connect".mysqli_error($dboject));

$sql_query = 'INSERT INTO form set Title="' . $ti . '",FirstName=" '.$fi .'",LastName="'.$ls .'",Organization="' .$or .'",Email="' .$em .'",PhoneNumber="' .$ph .'",Day1="' .$mon .'",Day2="' .$tue .'",Shirt="' .$st .'"';

/*$sql_query1 = "SELECT * from form";*/
		//Run our sql query
 $result = mysqli_query($dboject, $sql_query) or die('query failed'. mysqli_error($dboject));


// Get all records now in DB
$sql_query = "SELECT * from form";
//Run our sql query
 $result = mysqli_query($dboject, $sql_query) or die('query failed'. mysqli_error($dboject));
 
 //iterate through result printing each record
print "<br>Names in DB: <br>";

?>
<html>
<body>
<table border="1">
<tr>
<th>Title</th> <th>First Name</th> <th> Last Name</th> <th> Organization</th> <th>Email</th> <th> Number</th> <th>Day1</th> <th>Day2</th> <th>Shirt</th><th>Click to Cancel</th>
<?php
   while($row=mysqli_fetch_assoc($result))
    {
?>
                <tr>
                 <td><?php print $row['Title']; ?></td>
		<td><?php print $row['FirstName']; ?></td>
		<td><?php print $row['LastName']; ?></td>
               <td><?php print $row['Organization']; ?></td>
                <td><?php print $row['Email']; ?></td>
                <td><?php print $row['PhoneNumber']; ?></td>
                 <td><?php print $row['Day1']; ?></td>
                  <td><?php print $row['Day2']; ?></td>
                   <td><?php print $row['Shirt']; ?></td>
                  
                  <td> <a href="remove.php?id=<?php print $row['id']; ?>"> click to cancel</a></td>
		</tr>      
<?php
     }





}





else {
?>
<html>

<h1>FSOS Registration</h1>
<body>
<form method="POST" action="#">
<table>
<tr>
<td valign="top">Title:</td>
<td>
	<table>
	<tr>
	<td><input type="radio" name="title" value="mr" <?php if ($_POST['title'] == "mr") echo "CHECKED"; ?>    >Mr</td> <td> <?php echo $titler ?> </td>
	</tr>
	<tr>
	<td><input type="radio" name="title" value="mrs" <?php if ($_POST['title'] == "mrs") echo "CHECKED"; ?>    >Mrs</td>
	</tr>
	<tr>
	<td><input type="radio" name="title" value="ms"<?php if ($_POST['title'] == "ms") echo "CHECKED"; ?>     >Ms</td>
	</tr>
	</table>
</td>
</tr>
<tr>
<td>First name:</td>

<td><input name="firstName" type="text" value="<?php echo $_POST['firstName'];?>"></td> <td><?php echo $firsterror  ?> </td>


</tr>
<tr>
<td>Last name:</td>
<td><input name="lastName" type="text" value="<?php echo $_POST['lastName'];?>"></td> <td><?php echo $lasterror  ?> </td>
</tr>
<tr>
<td>Organization:</td>
<td><input name="organization" type="text" value="<?php echo $_POST['organization'];?>"> </td> <td><?php echo $oerror  ?> </td>
</tr>
<tr>
<td>Email address:</td>
<td><input name="email" type="text" value="<?php echo $_POST['email'];?>"></td> <td><?php echo $eerror  ?> </td>
</tr>
<tr>
<td>Phone number:</td>
<td><input name="phone" type="text" value="<?php echo $_POST['phone'];?>"></td> <td><?php echo $perror?> </td>
</tr>
<tr>
<td>Days attending:</td>
<td>
	<input name="monday" type="checkbox" value="monday"  <?php if ($_POST['monday']) echo "CHECKED"; ?>   >Monday
	<input name="tuesday" type="checkbox" value="tuesday"   <?php if ($_POST['tuesday']) echo "CHECKED"; ?>   >Tuesday<td/> <?php echo $day ?>
</tr>
<td> <?php echo $sh ?> </td>
<tr>
<td>T-shirt size:</td>
<td>
<select name="t-shirt">
<option>--Please choose--</option>
<option name="small" value="s"  <?php if ($_POST['t-shirt']=='s') echo "SELECTED";     ?> >Small</option>
<option value="m"             <?php if ($_POST['t-shirt']=='m' ) echo "SELECTED";       ?>>Medium</option>
<option value="l"              <?php if ($_POST['t-shirt']=='l') echo "SELECTED";      ?>>Large</option>
<option value="xl"             <?php if ($_POST['t-shirt']=='xl') echo "SELECTED";      ?>>X-Large</option>
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
