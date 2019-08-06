<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 12-01-2019
 * Time: 06:46
 */
include  "database.php";



error_reporting(E_ERROR | E_PARSE);




$userid=$_REQUEST['userid'];


header('Content-type: application/json;charset=utf-8');


function GetUserQuestion($userid){
$questiondata=array();
$query="select * from posts where userid='$userid'";
$source= mysqli_query($connection,$query);
while ($result=mysqli_fetch_array($source))
{
    $questionobj=null;
    $questionobj->id=$result['id'];
    $questionobj->post=$result['post'];

    array_push($questiondata,$questionobj);
//print_r($result);
}
echo json_encode($questiondata);
}
