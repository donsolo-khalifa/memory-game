<?php
require_once "dbhandler.php";

$rankQuery="SELECT scores,usersUid FROM users ORDER BY scores ASC";
$rankResult = mysqli_query($con,$rankQuery);
$data=array();
while($row = mysqli_fetch_assoc($rankResult)) {
    $data[$row['usersUid']]= $row['scores'];

}
// print_r($data);
// // print_r(array_keys($data));
// print_r($data);
// print_r($data) ;
echo array_search('pvitigo',array_keys($data));
