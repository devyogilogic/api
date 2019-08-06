<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 12-01-2019
 * Time: 06:46
 */
include  "database.php";



error_reporting(E_ERROR | E_PARSE);







$want=$_REQUEST['want'];
header('Content-type: application/json;charset=utf-8');

if($want=="GetUser"){
	
	$userid=$_REQUEST['userid'];
	function GetUserQuestion($userid);
}
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



if($want=="show"){
	
	showAll();
}


function showAll(){
	$questiondata=array();
$query="select * from posts ";
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