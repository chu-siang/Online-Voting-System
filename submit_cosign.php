<?php
// 確認是否有接收到候選人資料
session_start(); 
include "db_conn.php";

if (isset($_POST['selected_candidate'])) {
    $selectedCandidate = $_POST['selected_candidate'];
    
    // 在這裡處理你的投票邏輯，例如將投票結果存入資料庫
    // 包含數據庫連接文件（假設名為 db_connection.php）
    $vote_ID = $_SESSION['voter_ID_Number'];
    $key = $_SESSION['key'];
    $_SESSION['key'] = $key;
    $_SESSION['voter_ID_Number'] = $vote_ID;
    $sql = "SELECT * FROM voter WHERE vote_key='$key' AND voter_ID_Number='$vote_ID'";

    $result = mysqli_query($conn, $sql);
    $qualify_cosign_number = $_SESSION['qualify_cosign_number'];
    $_SESSION['qualify_cosign_number'] = $qualify_cosign_number;

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['is_cosign'] > 0) {
            $_SESSION['key'] = $row['vote_key'];
            echo "You have cosigned!!!";
            header("Location: cosignpage.php?error=You have cosigned!!");
            // header("Location: home.php");
            exit();
        }else if ($row['vote_key'] === $key && $row['voter_ID_Number'] === $vote_ID) {
            $sql3 = "SELECT * FROM cosign WHERE cosign_Name='$selectedCandidate'";
            $result3 = mysqli_query($conn, $sql3);
            $row3 = mysqli_fetch_assoc($result3);
            if ($row3['cosign_Name'] === $selectedCandidate) {
                $sql4 = "UPDATE cosign SET cosign_Number = cosign_Number + 1 WHERE cosign_Name='$selectedCandidate' AND vote_key='$key'";
                $result4 = mysqli_query($conn, $sql4);
                $sql5 = "SELECT * FROM cosign WHERE cosign_Name='$selectedCandidate'";
                $result5 = mysqli_query($conn, $sql5);
                $row5 = mysqli_fetch_assoc($result5);

                $sql7 = "SELECT * FROM candidate WHERE vote_key='$key' AND candidate_Name='$selectedCandidate'";
                $result7 = mysqli_query($conn, $sql7);

                if (($row5['cosign_Number'] >= $qualify_cosign_number) && (mysqli_num_rows($result7) == 0)) {
                    $BD = $row5['cosign_Birthday'];
                    $ID = $row5['cosign_ID_Number'];
                    $phone = $row5['cosign_Phone_Number'];
                    $image = $row5['cosign_Image'];
                    $content = $row5['cosign_Content'];
                    $sql6 = "INSERT INTO candidate(candidate_Name, candidate_ID_Number, candidate_Birthday,candidate_Phone_Number,vote_key,candidate_Image,candidate_Number,candidate_Content) VALUES('$selectedCandidate','$ID', '$BD', '$phone','$key','$image','0','$content')";
                    $result6 = mysqli_query($conn, $sql6);
                }
            }else{
                echo "Incorect User name or password!!";
                header("Location: cosignpage.php?error=Incorect User name or password!!");
                exit();
            }
            $sql2 = "UPDATE voter SET is_cosign = 1 WHERE vote_key='$key' AND voter_ID_Number='$vote_ID'";
            $result2 = mysqli_query($conn, $sql2);
            echo "Successfully cosigned!!";
            header("Location: cosignpage.php?success= Successfully cosigned!!");
            exit();
        }else{
            header("Location: cosignpage.php?error=Incorect User name or password!!");
            exit();
        }
    }else{
        header("Location: cosignpage.php?error=Incorect User name or password");
        exit();
    }
    

} else {
    echo "沒有選擇任何候選人。";
    header("Location: cosignpage.php");
	exit();
}
?>