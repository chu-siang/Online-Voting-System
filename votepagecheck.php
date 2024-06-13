<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['voter_ID_Number'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	$vote_ID = validate($_POST['voter_ID_Number']);
	$key = $_SESSION['key'];

	if (empty($vote_ID)) {
		header("Location: votepage.php?error=Vote_ID is required");
	    exit();
	}else{
		$sql = "SELECT * FROM voter WHERE vote_key='$key' AND voter_ID_Number='$vote_ID'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['vote_key'] === $key && $row['voter_ID_Number'] === $vote_ID) {
            	$_SESSION['key'] = $row['vote_key'];
				$_SESSION['voter_ID_Number'] = $row['voter_ID_Number'];
                header("Location: votepage.php");
		        exit();
            }else if($row['vote_key'] != $key ){
				echo "Your are not allowed in this Vote!!";
				header("Location: votepagelogin.php?error=You are not allowed in this Vote!!");
		        exit();
			}else{
				echo "Incorect User Information!!";
				header("Location: votepagelogin.php?error=Incorect User Information!!");
		        exit();
			}
		}else{
			header("Location: votepagelogin.php?error=Incorect User Information!!");
	        exit();
		}
	}
	
}else{
	header("Location: home.php");
	exit();
}