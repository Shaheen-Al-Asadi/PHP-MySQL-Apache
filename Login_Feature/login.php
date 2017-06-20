<?php

//Checks if Forgot your password link was clicked and performs mail function
if(isset($_GET['forgot'])){
?>
<html>
 <body>
        <p> Enter an Email for your password hint </p>
        <form method="POST" action="login.php">
        <input name="email" type="text" value="email">
        <input name="submit" type="submit">
        </form>
 </body>
</html>
<?php
}
//if email has been posted from forgot password, email person their password hint
if(isset($_POST['email'])){

 $secret = file('/home/int322_162a27/secret/topsecret.txt');
 $dbobject = mysqli_connect(trim($secret[0]),trim($secret[1]),trim($secret[2]),trim($secret[3])) or die ("could not connect".mysqli_error($dbobject));
 $sql_query = 'SELECT * FROM users WHERE username ="' . $_POST['email'] . '"';
 $result = mysqli_query($dbobject, $sql_query) or die('query failed '. mysqli_error($dbobject));

 while ($row = mysqli_fetch_assoc($result)) {

	   $to = $_POST['email'];
   	   $subject = "Forgotten Password";
   	   $message = "Your Password hint is: " . $row['passwordHint'];
   	   $header = "From:abc@somedomain.com \r\n";
   	   $sent = mail ($to,$subject,$message,$header);

   if( $sent == true ){
      echo "Message sent successfully...";
   }

 } //while results are active

    //if mail was not sent successfully, person inputed fake email address
   if($sent!=true){
    header("Refresh: 1; url=http://zenit.senecac.on.ca:11481/login.php");
   }

}//is email set closer
?>
<?php
//shows regular menu of login screen , including if person clicked forgot password
if($_POST ){
    //valid login
	$valid=false;
	$error="";
	//storing form variables to compare to DB
	$username= $_POST['name'];
	$password= $_POST['password'];

	$secret = file('/home/int322_162a27/secret/topsecret.txt');
	$dbobject = mysqli_connect(trim($secret[0]),trim($secret[1]),trim($secret[2]),trim($secret[3])) or die ("could not connect".mysqli_error($dbobject));

    //select all rows where username is connected to DB
	$sql_query = 'SELECT * FROM users WHERE username ="' . $username . '"';

	//echo " |||| DEBUG CURRENT QUERY CONTENTS IS: [ " . $sql_query . " ] |||| </br> ";
	//Run our sql query
	$result = mysqli_query($dbobject, $sql_query) or die('query failed '. mysqli_error($dbobject));

    //loop through resulting rows, which should be one as username is a primary key in DB
	while ($row = mysqli_fetch_assoc($result)) {
        //if supplied username and password match, initiate a valid login
		if($row['username'] == $username && $row['password'] == $password){

			$valid = true;
			session_start();
			//creating Session cookie
			$_SESSION['authorized'] = "true";

			//COMMENT MYSQL DEBUG ECHO ON LINE 65 TO PREVENT EARLY HEADERS
			header("Refresh: 1; url=http://zenit.senecac.on.ca:11481/protectedstuff.php");

		} // if password is correct

	} //while loop through db rows

	// if password or username dont bring a query redisplay form
	if($valid==false){
        $error=" *Wrong Username or Password*";
?>
	<html>

        <style>
        body{
                background-color:black;
                color: #00FF00;
                font-family:Monospace;
                border-style:ridge;
                border-color:green;
        }
        </style>

	<head>
        <title>Session Lab 5</title>
    </head>

	<body>
        <p> Enter Name and Password to login to </p>
        <form method="POST" action="login.php">
        <input name="name" type="text" value="">
        <input name="password" type="password" value=""><?php echo $error;?>
        <input name="submit" type="submit">
        </form>
	<a href="login.php?forgot=true">Forgot Your Password?</a>
	</body>
	</html>
<?php
    }//if valid==false

}//IF POST

//INITIAL page view launches login form
else{
?>
<html>
	<style>
	body{
		background-color:black;
		color: #00FF00;
		font-family:Monospace;
        border-style:ridge;
        border-color:green;
	}
	</style>

	<head>
	<title>Session Lab 5</title>
	</head>

	<body>
        <p> Enter Name and Password to login to </p>
        <form method="POST" action="login.php">
        <input name="name" type="text" value="">
        <input name="password" type="password" value=""><?php echo $error;?>
        <input name="submit" type="submit">
        </form>
	</body>
</html>

<?php
} // Closing Initial page launch brackets
?>
