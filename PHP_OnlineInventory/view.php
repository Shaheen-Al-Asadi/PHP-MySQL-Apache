<?php

//Adding A1 function library
require_once('a1.lib');

//Connect to the Database
$secret = file('/home/int322_162a27/secret/topsecret.txt');
$dbobject = mysqli_connect(trim($secret[0]),trim($secret[1]),trim($secret[2]),trim($secret[3])) or die ("could not connect".mysqli_error($dbobject));

// Get all records now in DB with select statement
$sql_query = "SELECT * from inventory";

//Run our sql query
 $result = mysqli_query($dbobject, $sql_query) or die('query failed'. mysqli_error($dbobject));

?>

<html>
<!--Using Menu function from A1.lib-->
<?php
    //Unusual Error, Gives Undefined constant error if Argument is not quoted
    //Cannot reproduce Error on add.php
    menu('Inventory_Database');
?>

    <body>
        <h3>Paintings in Inventory: </h3>

        <table border="1">
            <tr>
                <th>Item ID</th>
                <th>Item Name</th>
                <th>Description</th>
                <th>Supply Code</th>
                <th>Cost</th>
                <th>Price</th>
                <th>OnHand</th>
                <th>ReOrder Level</th>
                <th>On Backorder?</th>
                <th>Delete/Restore</th>
            </tr>

<!-- While rows from query has not reached end of line yet , print database row -->
<?php
   while($row=mysqli_fetch_assoc($result))
    {
?>
                <tr>
                <td><?php print $row['id'];?> </td>
                <td><?php print $row['itemName']; ?></td>
                <td><?php print $row['description']; ?></td>
                <td><?php print $row['supplierCode']; ?></td>
                <td><?php print $row['cost']; ?></td>
                <td><?php print $row['price']; ?></td>
                <td><?php print $row['onHand']; ?></td>
                <td><?php print $row['reorderPoint']; ?></td>
                <td><?php print $row['backOrder']; ?></td>

                <td>
                    <a href="delete.php<?php print "?id=" . $row['id'] . "&info=" . $row['deleted'];?>">
                    <?php if ($row['deleted'] == 'n') echo "Delete";
                     else if ($row['deleted'] == 'y') echo "Restore";?>
                    </a>
                </td>

                </tr>
<?php
}
?>

        <footer>
            <h4>Designed by:Shaheen Al-Asadi Copyright@2016 </h4>
        </footer>
    </body>
</html>
