<?php 
session_start();
include "db_conn.php";

if (isset($_GET['candidate'])) {


?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>Candidate Details</title>
    <link rel="stylesheet" href="style_7.css">
</head>
<body>
    <header>
        <!-- 可以在这里添加头部内容 -->
    </header>
    
    <main>
        <?php
            $cosignName = htmlspecialchars($_GET['candidate']);

            // 从数据库中获取候选人详细信息
            $key = $_SESSION['key'];
            $sql = "SELECT * FROM cosign WHERE cosign_Name = '$cosignName' AND vote_key = '$key'";
            $result = mysqli_query($conn, $sql);
        
            if ($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
                echo "<div class='candidate'>";
                // echo "<h2>" . htmlspecialchars($row["candidate_Name"]) . "</h2>";
                // echo "<h2>" . htmlspecialchars($row["candidate_Number"]) . "</h2>";
        ?>
        <h2>Cosign Details</h2>

            <div class="container">
                <div class='left'>  
                    <h4><?php echo htmlspecialchars($row["cosign_Name"]); ?></h4>
                    <?php
                        if (!empty($row["cosign_Image"])) {
                            // echo "<img src='" . htmlspecialchars($row["candidate_Image"]) . "' alt='" . htmlspecialchars($row["candidate_Name"]) . "'>";
                            echo "<img src = 'img/" . $row["cosign_Image"] . "' width = 200 title='" . $row['cosign_Image'] . "'>";

                        } else {
                            echo "<img src='default_photo.jpg' alt='Default Photo'>";
                        }
                    ?>
                    <h5><?php echo htmlspecialchars($row["cosign_Number"]); ?></h5>
                </div>
                <div class = "right">
                    <p><?php echo htmlspecialchars($row["cosign_Content"]); ?></p>
                </div>
            </div>
        <?php
            } else {
                echo "未找到候选人。";
            }
        ?>
        <button onclick="window.location.href='cosignpage.php'" class="ca">Go Back</button>
    </main>
    <footer>
        <!-- 可以在这里添加脚注内容 -->
    </footer>
</body>
</html>

<?php } else {
    echo "未指定候选人 ID。";
    exit();
}
?>