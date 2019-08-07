<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 12-01-2019
 * Time: 06:15
 */
 include  "database.php";
error_reporting(E_ERROR | E_PARSE);
header('Content-type: application/json;charset=utf-8');
 $userid=$_REQUEST['userid'];
 $questionpost=$_REQUEST['postdata'];
$query = " INSERT INTO `posts` ( `userid`, `post`) VALUES ( '$userid','$questionpost')";
if (mysqli_query($connection, $query)) {
    $myObj=null;
    $myObj->post = $questionpost;
    $myObj->user = $userid;
    $myObj->status = "Post Successfully";

    echo json_encode($myObj);

    $query = "update user set numberposts=numberposts+1  where id=$userid";
    mysqli_query($connection, $query);
}

