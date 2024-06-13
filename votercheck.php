<?php 
session_start(); 
include "db_conn.php";
//
if (isset($_SESSION['key']) && isset($_POST['voter_Name'])
&& isset($_POST['voter_ID']) && isset($_POST['voter_bd'])&& isset($_POST['voter_phone'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
    $name = validate($_POST['voter_Name']);
    $id = validate($_POST['voter_ID']);
    $BD = $_POST['voter_bd'];
    $phone = validate($_POST['voter_phone']);
    $key = validate($_SESSION['key']);

	$user_data = 'voter_Name'. $name. '&voter_ID='. $id. '&voter_bd='. $BD. '&voter_phone='. $phone. '&percent='. $phone.'&key='. $key;

	if (empty($name)) {
		header("Location: bevoter.php?error=Name is required&$user_data");
	    exit();
	}else if(empty($id)){
        header("Location: bevoter.php?error=ID Number is required&$user_data");
	    exit();
	}
	else if(empty($BD)){
        header("Location: bevoter.php?error=Birthday is required&$user_data");
	    exit();
	}
	else if(empty($phone)){
        header("Location: bevoter.php?error=phone is required&$user_data");
	    exit();
	}
	else if(empty($key)){
        header("Location: bevoter.php?error=key is required&$user_data");
	    exit();
	}
	else{
		$sql = "SELECT * FROM voter WHERE voter_ID_Number='$id' ";
	    // $sql = "SELECT * FROM nation WHERE votename='$votename' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: bevoter.php?error=This user has already been registered.&$user_data");
	        exit();
		}else {
		   $sql2 = "INSERT INTO voter(voter_Name, voter_ID_Number, voter_Birthday,voter_Phone_Number,is_vote,is_cosign,vote_key) VALUES('$name', '$id', '$BD','$phone','0','0','$key')";
		   $result2 = mysqli_query($conn, $sql2);
		   if ($result2) {
			$_SESSION['key'] = $key;
			header("Location: home.php?accountsuccess=Your account has been created successfully");
	         exit();
		   }else {
	           	header("Location: bevoter.php?error=unknown error occurred&$user_data");
		        exit();
		   }
		}
	}
	
}else{
	header("Location: bevoter.php?error=All Information is required.");
	exit();
}