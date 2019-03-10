<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 11-01-2019
 * Time: 06:53
 */
include  "database.php";
error_reporting(E_ERROR | E_PARSE);
$filename = $_FILES["fileupload"]["name"];
$tempname = $_FILES["fileupload"]["tmp_name"];
$filetype = $_FILES["fileupload"]["type"];
$userid=$_REQUEST['userid'];


if($filetype=="image/jpeg" or $filetype=="image/jpg" or $filetype=="image/png")
{
    $folder = "imagefolder/".$filename;
    if(move_uploaded_file($tempname,$folder))
    {
        $imagepath=$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"."/TechnicalYouth/api/imagefolder/".$filename;
        header('Content-type: application/json;charset=utf-8');
        $myobj=null;
        $myobj->userid=$userid;
        $myobj->imagepath=$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"."/TechnicalYouth/api/imagefolder/".$filename;
        $myobj->status="Image Uploaded";
        $query="update user set profilepic='$imagepath' where id=$userid";
        if(mysqli_query($connection,$query)) {
            echo json_encode($myobj);
        }

    }
   // https://www.cricbuzz.com/stats/img/faceImages/265.jpg


    else{
        $myobj=null;
        $myobj->status="Not of a image type support only jpeg ,jpg ";
        echo json_encode($myobj);
    }

}