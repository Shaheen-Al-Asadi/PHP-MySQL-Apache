<?php
/*
Assignment Document Statement: Add.php is used to display the initial webpage and a form to submit data towards view.php,
to document a fictional business inventory. Delete.php is used to change a flag in a DB record.
*/

//I was getting Undefined variable errors , must initialize variables and use isset()/empty() functions more often to prevent warnings - Warnings Turned off
error_reporting(error_reporting() & ~E_NOTICE );

//Adding A1 function library
require_once('a1.lib');

if($_POST['submit']){

//values that will hold RED error messages
$nameError ="";
$descriptionError="";
$supplyError="";
$costError="";
$priceError="";
$handError="";
$rePointError="";
$orderError="";

//trimmed form values DB will insert
$nameT= trim($_POST['name']);
$descriptionT= trim($_POST['description']);
$supplyCodeT= trim($_POST['supplyCode']);
$costT= trim($_POST['cost']);
$priceT= trim($_POST['price']);
$onHandT= trim($_POST['onHand']);
$rePointT= trim($_POST['rePoint']);
$backOrderT= trim($_POST['backOrder']);

//Regular Expressions
$nameRegex = '/^[a-zA-Z0-9\s\;\:\-\,]*$/';
$descRegex = '/^[a-zA-Z0-9\s\.\,\-\']*$/';
$supplyRegex ='/^[a-zA-Z0-9\s\-]*$/';
$costRegex = '/^[(+\d)\.(+\d)]*$/';
$priceRegex ='/^[(+\d)\.(+\d)]*$/';
$onHandRegex ='/^[\d]*$/';
$rePointRegex ='/^[\d]*$/';

$valid = true;

    //if any of the data coming from the form is invalid, errors will be posted

    if($nameT == "" || !preg_match($nameRegex, $nameT) ){
    $valid = false;
    $nameError ="<font color='red'>Item Name is Empty/Incorrect [a-Z :;-,0-9]</font>";
    }

    if($descriptionT == "" || !preg_match($descRegex, $descriptionT) ){
    $valid=false;
    $descriptionError="<font color='red'>Description is Empty/Incorrect [a-Z .,-'0-9]</font>";
    }

    if($supplyCodeT == "" || !preg_match($supplyRegex, $supplyCodeT) ){
    $valid=false;
    $supplyError="<font color='red'>Supply Code is Empty/Incorrect [a-Z - 0-9]</font>";
    }

    if($costT  == "" || !preg_match($costRegex, $costT) ){
    $valid=false;
    $costError="<font color='red'>Cost is Empty/Incorrect [99.99]</font>";
    }

    if($priceT == "" || !preg_match($priceRegex, $priceT) ){
    $valid=false;
    $priceError="<font color='red'>Price is Empty/Incorrect [99.99]</font>";
    }

    if($onHandT == "" || !preg_match($onHandRegex, $onHandT) ){
    $valid=false;
    $handError="<font color='red'>On Hand is Empty/Incorrect [0-9]</font>";
    }

    if($rePointT  == "" || !preg_match($rePointRegex, $rePointT) ){
    $valid=false;
    $rePointError="<font color='red'>Reorder Point is Empty/Incorrect [0-9]</font>";
    }
}

if($valid && $_POST ){

    //Connect to the Database and insert form information
    addToDB($nameT,$descriptionT,$supplyCodeT,$costT,$priceT,$onHandT,$rePointT,$backOrderT);

}
else {
?> <!-- If no Form POST'ed' , or valid is false, then print Regular Form with repopulation-->

<html>

<!--Using Menu function from A1.lib-->
<?php
    menu(Inventory_Form);
?>

    <body>
    <form method="POST" action="#">

        <h6>All fields are mandatory except "Back Order"</h6>

        <table>
            <tr>
                <td valign="top">Item Name:</td>
                <td><input name="name" type="text" value="<?php echo $_POST['name'];?>"> </td>
                <td><?php echo $nameError?></td>

            </tr>

            <tr>
                <td>Item Description:</td>
                <td><textarea rows="2" cols="15" name="description"><?php echo trim($_POST['description']);?></textarea>
                <td><?php echo $descriptionError?></td>
            </tr>

            <tr>
                <td>Supplier Code:</td>
                <td><input name="supplyCode" type="text" value="<?php echo $_POST['supplyCode'];?>"> </td>
                <td><?php echo $supplyError?></td>
            </tr>

            <tr>
                <td>Cost:</td>
                <td><input name="cost" type="text" value="<?php echo $_POST['cost'];?>"></td>
                <td><?php echo $costError?></td>
            </tr>

            <tr>
                <td>Selling Price:</td>
                <td><input name="price" type="text" value="<?php echo $_POST['price'];?>"></td>
                <td><?php echo $priceError?></td>
            </tr>

            <tr>
                <td>Number On Hand:</td>
                <td><input name="onHand" type="text" value="<?php echo $_POST['onHand'];?>"></td>
                <td><?php echo $handError?></td>
            </tr>

            <tr>
                <td>Reorder Level:</td>
                <td><input name="rePoint" type="text" value="<?php echo $_POST['rePoint'];?>"></td>
                <td><?php echo $rePointError?></td>
            </tr>

            <tr>
                <td>Backorder:</td>
                <td><input name="backOrder" type="text" value="<?php echo $_POST['backOrder'];?>"></td>
                <td><?php echo $orderError?></td>
            </tr>

            <tr><td><br></td></tr>

            <tr>
                <td></td>
                <td><input name="submit" type="submit"></td>
            </tr>
    </form>

<?php

//I should deallocate $result and $dbobject, but the connection is automatically deallocated at the end of this script
//mysqli_free_result($result);
//mysqli_close($dbobject);

}?> <!-- Closing the initial php script -->

        <footer>
            <h4>Designed by:Shaheen Al-Asadi Copyright@2016 </h4>
        </footer>
    </body>
</html>
