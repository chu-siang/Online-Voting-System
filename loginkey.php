<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['key'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$key = validate($_POST['key']);

	if (empty($key)) {
		header("Location: index.php?error=Key is required");
	    exit();
	}else{
		$sql = "SELECT * FROM nation WHERE vote_key='$key'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['vote_key'] === $key) {
            	$_SESSION['key'] = $row['vote_key'];
				$_SESSION['web_key'] = $row['web_key'];
                header("Location: home.php");
		        exit();
            }else{
				header("Location: index.php?error=Incorect User name or password!!");
		        exit();
			}
		}else{
			header("Location: index.php?error=Incorect User name or password");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}