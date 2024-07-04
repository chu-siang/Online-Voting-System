<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['web_key'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$webkey = validate($_POST['web_key']);
    $ans = $_SESSION['webkey'];
	if (empty($webkey)) {
		header("Location: index.php?weberror=WebKey is required");
	    exit();
	}else{
		if ($webkey === $ans) {
            header("Location: home.php?websuccess=WebKey is correct");
		    exit();
		}else{
			header("Location: index.php?weberror=Incorect WebKey");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}