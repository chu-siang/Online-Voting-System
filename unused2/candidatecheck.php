<?php 
session_start(); 
include "db_conn.php";

if (isset($_SESSION['key']) && isset($_POST['candidate_name'])
    && isset($_POST['candidate_ID']) && isset($_POST['candidate_bd']) && isset($_POST['candidate_phone'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
    $name = validate($_POST['candidate_name']);
    $id = validate($_POST['candidate_ID']);
    $BD = validate($_POST['candidate_bd']);
    $phone = validate($_POST['candidate_phone']);
    $key = validate($_SESSION['key']);

	$user_data = 'candidate_name'. $name. '&candidate_ID='. $id. '&candidate_bd='. $BD. '&candidate_phone='. $phone. '&percent='. $phone.'&key='. $key;

	if (empty($name)) {
		header("Location: candidate.php?error=Name is required&$user_data");
	    exit();
	}else if(empty($id)){
        header("Location: candidate.php?error=ID Number is required&$user_data");
	    exit();
	}
	else if(empty($BD)){
        header("Location: candidate.php?error=Birthday is required&$user_data");
	    exit();
	}
	else if(empty($phone)){
        header("Location: candidate.php?error=phone is required&$user_data");
	    exit();
	}
	else if(empty($key)){
        header("Location: candidate.php?error=key is required&$user_data");
	    exit();
	}
	else{
		$sql = "SELECT * FROM candidate WHERE candidate_ID_Number='$id' ";
	    // $sql = "SELECT * FROM nation WHERE votename='$votename' ";
		$result = mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($result) > 0) {
			header("Location: candidate.php?error=This user has already been registered.&$user_data");
	        exit();
		}else {
		   $sql2 = "INSERT INTO candidate(candidate_name, candidate_ID_Number, candidate_Birthday,candidate_Phone_Number,vote_key,vote_number) VALUES('$name', '$id', '$BD','$phone','$key','0')";
		   $result2 = mysqli_query($conn, $sql2);
		   if ($result2) {
			$_SESSION['key'] = $key;
		   	 header("Location: candidate.php?success=Your account has been created successfully");
	         exit();
		   }else {
	           	header("Location: candidate.php?error=unknown error occurred&$user_data");
		        exit();
		   }
		}
	}
	
}else{
	header("Location: candidate.php");
	exit();
}