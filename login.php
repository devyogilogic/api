<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 10-01-2019
 * Time: 19:54
 */
include"database.php";
 header('Content-type: application/json;charset=utf-8');
$emailid=$_REQUEST['emailid'];

$password=$_REQUEST['password'];
$username=$_REQUEST['username'];
$want=$_REQUEST['want'];
$con=$connection;
error_reporting(E_ERROR | E_PARSE);
if($want=="login"){

    loginuser($emailid,$username,$password,$con);
}
else if ($want="signup"){

    signup($emailid,$username,$password,$con);

}



















function checkexsists($email,$username,$con){
    $query="select * from user where emailid='$email' or username='$username'";
   if (mysqli_query($con,$query)) {
       $aff = mysqli_affected_rows($con);
   }
   else {
       echo mysqli_error($con);
   }
  return $aff;
}
function loginuser($email,$username,$password,$con){

    $query="select * from user where emailid='$email' and password='$password'";









    
	
   if (mysqli_query($con,$query)){
     $a=  mysqli_query($con,$query);
     $result=mysqli_fetch_array($a);




   $aff = mysqli_affected_rows($con);
  

    if ($aff == 1) {

        header('Content-type: application/json;charset=utf-8');
        $myObj->username =$result['username'] ;
        $myObj->userid = $result['id'];
		$myObj->emailid =$result['emailid'] ;
        $myObj->password =$result['password'] ;
        $myObj->status = "User Log in";

        echo json_encode($myObj);

    }
    if ($aff == 0) {

        $query = "select * from user where username='$username' and password='$password'";
     $a=   mysqli_query($con, $query);
        $aff = mysqli_affected_rows($con);
        $result=mysqli_fetch_array($a);
        if ($aff == 1) {
            header('Content-type: application/json;charset=utf-8');
            $myObj->username =$result['username'] ;
            $myObj->email =$result['email'] ;
            $myObj->password =$result['password'] ;
			
			
            $myObj->userid = $result['id'];
            $myObj->status = "User Log in";
                 echo json_encode($myObj);
        } else {
            $myObj->status = "User  does not exsists or invalid  combination";
            echo json_encode($myObj);

        }
    }
}
else {
       echo mysqli_error($con);

}
}
function signup($email,$username,$password,$con){
    $a=checkexsists($email,$username,$con);
    
    if($a==0) {
        $query = " INSERT INTO `user` ( `emailid`, `password`, `username`,  `role`) VALUES ( '$email', '$username', '$password', '0')";
        if (mysqli_query($con, $query)) {
			header('Content-type: application/json;charset=utf-8');
            
			$myObj->email=$email;
            $myObj->username = $username;
            $myObj->password = $password;
            $myObj->status = "Signup Successfull";
			
            header('Content-type: application/json;charset=utf-8');
            echo json_encode($myObj);
        }
    }
    else {
        $myObj=null;

        $mess="usename or email already exsists";
        $myObj->status = $mess;
        echo json_encode($myObj);
    }

}