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
if ($want=="select"){
   selectInterest($con);
}
if ($want=="selected"){
   getSelectedInterset($con);
}
if($want=="update"){
	
	updateInterest($con);
	
}














function showInterest($con){




    $interestdata=array();
    $query="select * from interest";
    $source= mysqli_query($con,$query);
    while ($result=mysqli_fetch_array($source))
    {
        $interestobj=null;
		echo print_r([$result]);
		
        $interestobj->id=$result['id'];
        $interestobj->InterestArea=$result['InterestArrea'];

        array_push($interestdata,$interestobj);

    }
    echo json_encode($interestdata);
}
function selectInterest ($con) {
    $userid=$_REQUEST['userid'];
    $interestid=$_REQUEST['interestid'];
	

$Intersetarray = explode(',', $interestid);
$c= count($Intersetarray);
   for ($i = 0; $i <count($Intersetarray); $i++)  {
          $query=  "INSERT INTO `getinterest`(`userid`, `interestid`) VALUES ('$userid',' $Intersetarray[$i]')";
		 // echo $query;
		  mysqli_query($con,$query);
        }
	
      
        $interestobj->Status="Good to go";
		
		 $query=  "Update user  set profilesetup='Y' where id='$userid'";
		
		 
		  mysqli_query($con,$query);
	 echo json_encode($interestobj);
      
    }

	
	function getSelectedInterset($con){
		 $selectInterestdata=array();
		$userid=$_REQUEST['userid'];
		$query="SELECT * FROM `getinterest`,`interest` WHERE (getinterest.interestid=interest.id) and (getinterest.userid='$userid')";
		// $arr= array()
		 
		 $res=mysqli_query($con,$query);
		 while ($result=mysqli_fetch_array($res))
    {
        $interestobj=null;
        $interestobj->id=$result['id'];
		$interestobj->user_id=$result['userid'];
        $interestobj->InterestArea=$result['InterestArrea'];

        array_push( $selectInterestdata,$interestobj);

    }
	}
    echo json_encode($selectInterestdata);
		 
         
		function updateInterest($con){
			
			
			    $userid=$_REQUEST['userid'];
                $interestid=$_REQUEST['interestid'];
	

              $Intersetarray = explode(',', $interestid);
			  
			  $query="Delete from `getinterest` where  userid='$userid'  ";
			 
			  mysqli_query($con,$query);
			  
             $c= count($Intersetarray);
			 
			
             for ($i = 0; $i <count($Intersetarray); $i++)  {
            $query=  "INSERT INTO `getinterest`(`userid`, `interestid`) VALUES ('$userid',' $Intersetarray[$i]')";
		   
		  
		   mysqli_query($con,$query);
        }
	
      $interestobj=null;
        $interestobj->Status="Good to go";
	 echo json_encode($interestobj);
			
			
		}
		
		
    
	
