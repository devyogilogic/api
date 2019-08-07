<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 12-01-2019
 * Time: 06:46
 */
include  "database.php";



error_reporting(E_ERROR | E_PARSE);


$con=$connection;

$want=$_REQUEST['want'];

	
header('Content-type: application/json;charset=utf-8');

if($want=="Getuser"){
getuser($connection);
}
if($want=="Show"){
show($connection);
}

function getuser($con){
$userid=$_REQUEST['userid'];
$questiondata=array();
$query="select * from posts,user where (posts.userid='$userid')and(user.id='$userid')";
$source= mysqli_query($con,$query);
while ($result=mysqli_fetch_array($source))
{
    $questionobj=null;
    $questionobj->id=$result['id'];
    $questionobj->post=$result['post'];
	$questionobj->username=$result['username'];
	$questionobj->timeanddate=$result['TimeandDate'];

    array_push($questiondata,$questionobj);
//print_r($result);
}
echo json_encode($questiondata);
}

function show($con){
$userid=$_REQUEST['userid'];
$questiondata=array();
$query="select * from posts,user where (posts.userid=user.id)";
$source= mysqli_query($con,$query);
while ($result=mysqli_fetch_array($source))
{
    $questionobj=null;
    $questionobj->id=$result['id'];
    $questionobj->post=$result['post'];
	$questionobj->username=$result['username'];
	$questionobj->timeanddate=$result['TimeandDate'];

    array_push($questiondata,$questionobj);
//print_r($result);
}
echo json_encode($questiondata);
}
