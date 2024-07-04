<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['webkey'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$webkey = validate($_POST['webkey']);
    $key = $_SESSION['key'];
	if (empty($webkey)) {
		header("Location: home.php?errorweb=WebKey is required");
	    exit();
	}else{
		$sql = "SELECT * FROM nation WHERE vote_key='$key'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['web_key'] === $webkey) {
            	$_SESSION['key'] = $row['vote_key'];
				$_SESSION['web_key'] = $row['web_key'];
                $sql2 = "UPDATE nation SET is_invocing = 1 WHERE vote_key='$key'";
                $result2 = mysqli_query($conn, $sql2);
                header("Location: home.php?successweb=Web key is correct!!");
		        exit();
            }else{
				header("Location: home.php?errorweb=Incorect Web key!!");
		        exit();
			}
		}else{
			header("Location: home.php?errorweb=Incorect Web key");
	        exit();
		}
	}
	
}else{
	header("Location: home.php?errorweb=Incorect Web key");
	exit();
}