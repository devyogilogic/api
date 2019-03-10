<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 11-01-2019
 * Time: 07:54
 */

include "database.php";

error_reporting(E_ERROR | E_PARSE);
header('Content-type: application/json;charset=utf-8');

$con=$connection;
$want= $_REQUEST['want'];
if($want=="show"){
    showInterest($con);

}
if ($want="select"){
   selectinterest($con);
}














function showInterest($con){




    $interestdata=array();
    $query="select * from interest";
    $source= mysqli_query($con,$query);
    while ($result=mysqli_fetch_array($source))
    {
        $interestobj=null;
        $interestobj->id=$result['id'];
        $interestobj->InterestArea=$result['InterestArrea'];

        array_push($interestdata,$interestobj);

    }
    echo json_encode($interestdata);
}
function selectinterest ($con) {
    $userid=$_REQUEST['userid'];
    $interestid=$_REQUEST['interestarea'];
    $query=  "INSERT INTO `getinterest`(`userid`, `interestid`) VALUES ('$userid','$interestid')";
    if(mysqli_query($con,$query)){
        $result=null;
        $result->message="Good to Go !!!";
        echo json_encode($result);
    }
}