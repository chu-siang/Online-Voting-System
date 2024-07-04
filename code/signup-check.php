<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['votename']) && isset($_POST['lnum'])
    && isset($_POST['cnum']) && isset($_POST['vnum']) && isset($_POST['percent'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
    $votename = validate($_POST['votename']);
    $lnum = validate($_POST['cnum']);
    $cnum = validate($_POST['lnum']);
    $vnum = validate($_POST['vnum']);
    $percent = validate($_POST['percent']);

	$user_data = 'votename'. $votename. '&cnum='. $cnum. '&lnum='. $lnum. '&vnum='. $vnum. '&percent='. $percent;

	if (empty($votename)) {
		header("Location: signup.php?error=VoteName is required&$user_data");
	    exit();
	}else if(empty($cnum)){
        header("Location: signup.php?error=Number of Candidates is required&$user_data");
	    exit();
	}
	else if(empty($lnum)){
        header("Location: signup.php?error=Limit of Cosign is required&$user_data");
	    exit();
	}
	else if(empty($vnum)){
        header("Location: signup.php?error=Number of Voter is required&$user_data");
	    exit();
	}
	else if(empty($percent)){
        header("Location: signup.php?error=Percent of Ballot to Elect is required&$user_data");
	    exit();
	}
	else{
        function RandomString($length = 6) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[random_int(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        $key = RandomString();
		$webkey = RandomString();
	    $sql = "SELECT * FROM nation WHERE votename='$votename' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: signup.php?error=The username is taken try another&$user_data");
	        exit();
		}else {
            $sql3 = "SELECT * FROM nation WHERE vote_key='$key' ";
            $result3 = mysqli_query($conn, $sql3);
            while (mysqli_num_rows($result3) > 0) {
                $key = RandomString();
                $sql3 = "SELECT * FROM nation WHERE vote_key='$key' ";
                $result3 = mysqli_query($conn, $sql3);
            }
			$sql4 = "SELECT * FROM nation WHERE web_key='$webkey' ";
			$result4 = mysqli_query($conn, $sql4);
			while (mysqli_num_rows($result4) > 0) {
				$webkey = RandomString();
				$sql4 = "SELECT * FROM nation WHERE web_key='$webkey' ";
				$result4 = mysqli_query($conn, $sql4);
			}
           $sql2 = "INSERT INTO nation(votename, candidate_num, limit_cosign_num,voter_num,percentage,vote_key,web_key,is_invocing) VALUES('$votename', '$cnum', '$lnum','$vnum','$percent','$key','$webkey','false')";
           $result2 = mysqli_query($conn, $sql2);
           if ($result2) {
            $_SESSION['key'] = $key;
			$_SESSION['webkey'] = $webkey;
           	 header("Location: key.php?success=Your account has been created successfully");
	         exit();
           }else {
	           	header("Location: signup.php?error=unknown error occurred&$user_data");
		        exit();
           }
		}
	}
	
}else{
	header("Location: signup.php");
	exit();
}