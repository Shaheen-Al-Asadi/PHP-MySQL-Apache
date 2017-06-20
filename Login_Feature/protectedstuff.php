<?php
//check if logout link was clicked, initialize variable into scope
$logoutneed="";

if(isset($_GET['logout'])){
    $logoutneed =$_GET['logout'];
}

//check if _session is set and session matches PHPSESSID ( logged in? )
session_start();
//did person login in successfully from login page?
if (isset ($_SESSION['authorized'])) {
    if($logoutneed=="yes"){
        unset($_SESSION['authorized']);
        setcookie("PHPSESSID", "", time() - 61200,"/"); //close PHPSESSID
        session_destroy(); //close session
        $_SESSION = array(); //empty session data
        header("Refresh: 1; url=http://zenit.senecac.on.ca:11481/login.php");//redirect to login page (( logged out ))
    }
//if logged in but user did not click logout then display protected stuff
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

    <body>
        <p>You are logged in!</p></br>
        <a href="protectedstuff.php?logout=yes">Logout</a>
    </body>

</html>

<?php
}
else {
    // invalid password
    session_destroy();
    header("Refresh: 1; url=http://zenit.senecac.on.ca:11481/login.php");
}
?>
