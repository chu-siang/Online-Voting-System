<?php 
session_start(); 
include "db_conn.php";

if (isset($_SESSION['key']) && isset($_POST['cosign_Name'])
    && isset($_POST['cosign_ID']) && isset($_POST['cosign_bd']) && isset($_POST['cosign_Phone'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
    $name = validate($_POST['cosign_Name']);
    $id = validate($_POST['cosign_ID']);
    $BD = validate($_POST['cosign_bd']);
    $phone = validate($_POST['cosign_Phone']);
    $key = validate($_SESSION['key']);
    $content  = $_POST['cosign_Content'];
	$user_data = 'cosign_Name'. $name. '&cosign_ID='. $id. '&cosign_bd='. $BD. '&cosign_Phone='. $phone. '&percent='. $phone.'&key='. $key;


    if($_FILES["image"]["error"] == 4){
        echo
        "<script> alert('Image Does Not Exist'); </script>"
        ;
        header("Location: cosign.php?error=Image Does Not Exist&$user_data");
	    exit();
      }
	if (empty($name)) {
		header("Location: cosign.php?error=Name is required&$user_data");
	    exit();
	}else if(empty($id)){
        header("Location: cosign.php?error=ID Number is required&$user_data");
	    exit();
	}
	else if(empty($BD)){
        header("Location: cosign.php?error=Birthday is required&$user_data");
	    exit();
	}
	else if(empty($phone)){
        header("Location: cosign.php?error=phone is required&$user_data");
	    exit();
	}
	else if(empty($key)){
        header("Location: cosign.php?error=key is required&$user_data");
	    exit();
	}
	else{
		$sql = "SELECT * FROM cosign WHERE cosign_ID_Number='$id' ";
	    // $sql = "SELECT * FROM nation WHERE votename='$votename' ";
		$result = mysqli_query($conn, $sql);
		

            $fileName = $_FILES["cosign_Image"]["name"];
            $fileSize = $_FILES["cosign_Image"]["size"];
            $tmpName = $_FILES["cosign_Image"]["tmp_name"];

            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));
            if (!in_array($imageExtension, $validImageExtension)){
              echo
              "
              <script>
                alert('Invalid Image Extension');
              </script>
              ";
                header("Location: cosign.php?error=Invalid Image Extension&$user_data");
                    exit();
            }
            else
             if($fileSize > 1000000){
              echo
              "
              <script>
                alert('Image Size Is Too Large');
              </script>
              ";
              header("Location: cosign.php?error=Image Size Is Too Large&$user_data");
                exit();
            }

            
		if (mysqli_num_rows($result) > 0) {
			header("Location: cosign.php?error=This user has already been registered.&$user_data");
	        exit();
		}else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;
            move_uploaded_file($tmpName, 'img/' . $newImageName);

		   $sql2 = "INSERT INTO cosign(cosign_Name, cosign_ID_Number, cosign_Birthday,cosign_Phone_Number,vote_key,cosign_Image,cosign_Number,cosign_content) VALUES('$name', '$id', '$BD','$phone','$key','$newImageName','0','$content')";
		   $result2 = mysqli_query($conn, $sql2);
		   if ($result2) {
			$_SESSION['key'] = $key;
		   	 header("Location: cosign.php?success=Your account has been created successfully");
	         exit();
		   }else {
	           	header("Location: cosign.php?error=unknown error occurred&$user_data");
		        exit();
		   }
		}
	}
	
}else{
	header("Location: cosign.php");
	exit();
}