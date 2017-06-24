<?php
$value=$_GET['id'];


$dboject=mysqli_connect("server","user","pass","user") or die ("could not connect".mysqli_error($dboject));

$sql_query = "update  form set Day1='Not Attending',Day2='Not Attending' where id = '$value'";
//Debug echo $sql_query;
echo "Successfully removed attendance date, we hope to see you next time!";

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







?>
