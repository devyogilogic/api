<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 12-01-2019
 * Time: 07:05
 */
include  'database.php';
header('Content-type: application/json;charset=utf-8');
error_reporting(E_ERROR | E_PARSE);
$userid=$_REQUEST['userid'];
$postid=$_REQUEST['postid'];
$answer=$_REQUEST['answer'];
$query = " INSERT INTO `answerpost` ( `postid`, `userid`,`answer`) VALUES ( '$postid','$userid','$answer')";
if (mysqli_query($connection, $query)) {
    $myObj=null;
    $myObj->postid = $postid;
    $myObj->user = $userid;
    $myObj->status = "Answer post  Successfully";

    echo json_encode($myObj);

    $query = "update user set numberanswers=numberanswers+1  where id=$userid";
    mysqli_query($connection, $query);
}