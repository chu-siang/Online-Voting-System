<?php 
session_start();
include "db_conn.php";
if (isset($_SESSION['key'])) {

 ?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8"></meta>
    <title>Vote System</title>
    <link rel = "stylesheet" href = "style_33.css">
</head>

<body>
    <header>

    </header>
    <main>
        <?php 
            $key =  $_SESSION['key'];
            $_SESSION['key'] = $key;
            $qualify_cosign_number = $_SESSION['qualify_cosign_number'];
        ?>
        <h2>Shortage of Cosign</h2>
        <div class="wrapper">
            <?php
                // 這裡應該是你的數據庫查詢結果
                // 假設 $result 是你的查詢結果
                $result = $conn->query("SELECT * FROM cosign where vote_key='$key'");

            if ($result->num_rows > 0) {
                // 輸出每一列數據
                while($row = $result->fetch_assoc()) {
                    echo "<div class='candidate'>";
                    echo "<h2>" . htmlspecialchars($row["cosign_Name"]) . "</h2>";
                    echo "<h5>" . htmlspecialchars($row["cosign_Number"]) . "</h5>";
                    
                    //echo "<a href='candidate_details.php?id=" . htmlspecialchars($row["cosign_Number"]) . "'>";
                    if (!empty($row["cosign_Image"])) {
                        //echo "<img src='" . htmlspecialchars($row["cosign_Image"]) . "' alt='" . htmlspecialchars($row["cosign_Name"]) . "'>";
                        // echo "<img src = 'img/" . $row["cosign_Image"] . "' width = 200 title='" . $row['cosign_Image'] . "'>";
                        echo "<img src='img/" . $row["cosign_Image"] . "' width=200 title='" . $row['cosign_Image'] . "' data-candidate='" . htmlspecialchars($row["cosign_Name"]) . "' class='cosign-image'>";

                    } else {
                        // echo "<img src='default_photo.jpg' alt='Default Photo'>";
                        echo "<img src='default_photo.jpg' alt='Default Photo' data-candidate='" . htmlspecialchars($row["cosign_Name"]) . "' class='cosign-image'>";

                    }
                    // echo "</a>";
                    // echo "<button class='candidate-button' data-candidate='" . htmlspecialchars($row["cosign_Name"]) . "'></button>";
                    echo "</div>";
                }
            } else {
                echo "目前沒有候選人。";
            }
            ?>
        </div>
        <script>
            document.querySelectorAll('.cosign-image').forEach(img => {
                img.addEventListener('click', function() {
                    const candidateName = this.getAttribute('data-candidate');
                    window.location.href = 'cosignStatus_detail.php?candidate=' + encodeURIComponent(candidateName);
                });
            });
        </script>
        <button onclick="window.location.href='home.php'" class="ca">Back Home</button>
    </main>
    <footer></footer>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>