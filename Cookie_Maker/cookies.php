<?php

if (empty($_COOKIE['count'])){
    setcookie("count", 1 , time() + 36000);
} else {
    setcookie("count", ($_COOKIE['count']+1) , time() + 36000);
}

$visits = $_COOKIE['count'];

if($_POST){
    $cname = $_POST['name'];
    $cvalue = $_POST['value'];

    //Making the cookie request
    setcookie($cname,$cvalue,time()+36000);

    //below is just the form again after submit
?>
<html>
    <title> Cookies Lab 5</title>
    <head></head>
    <body>
        <p> Enter Name and Value of a Cookie to create </p>
        <form method="POST" action="cookies.php">
            <input name="name" type="text" value="name">
            <input name="value" type="text" value="value">
            <input name="submit" type="submit">
        </form>
<?php

echo "Welcome back - You visited this page " . $visits . " times" . "</br>";
//print_r($_COOKIE);??

//print entire $cookie superglobal array
echo "Cookie has been created". "</br></br>" ;
foreach ($_COOKIE as $key=>$val)  {
    echo "Name of the Cookie is: [ " . $key . " ] and the Cookie value is: " . $val . "<br>\n";
}

?>
    </body>
</html>

<?php
} //first time the page is visited, print empty form
  //TO DO: SHOULD HAVE FUNCTION TO PRINT MENU
else{
?>

<html>
<title> Cookies Lab 5</title>
<head></head>
<body>
	<p> Enter Name and Value of a Cookie to create </p>
	<form method="POST" action="cookies.php">
	<input name="name" type="text" value="name">
	<input name="value" type="text" value="value">
	<input name="submit" type="submit">
	</form>

<?php
echo "Welcome back - You visited this page " . $visits . " times" . "</br>";
//print_r($_COOKIE);??
?>
</body>
<html>
<?php
}
?>
