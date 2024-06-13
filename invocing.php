<?php 
session_start();

// 包含數據庫連接文件（假設名為 db_connection.php）
include('db_conn.php');

// 確認數據庫連接是否成功
if ($conn->connect_error) {
    die("數據庫連接失敗：" . $conn->connect_error);
}

if (isset($_SESSION['key'])) {

?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8"></meta>
    <title>Vote System</title>
    <link rel = "stylesheet" type="text/css" href = "style_6.css">
</head>

<body>
    <header>
        
    </header>
    <main>
        <?php 
            $key =  $_SESSION['key'];
            $_SESSION['key'] = $key;
        ?>
        <h2>Vote Result</h2>
        <div class = "container">
            <div class = left>   
            <?php
                // 查询最高得票数的候选人
                $key =  $_SESSION['key'];
                $sql = "SELECT * FROM candidate WHERE vote_key = '$key' ORDER BY candidate_Number DESC";
                
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $candidates = $result->fetch_all(MYSQLI_ASSOC);

                    // 第一名候选人
                    if (isset($candidates[0])) {
                        $first = $candidates[0];
                        echo "<h3>First Place</h3>";

                        echo "<div class = namel><h5>" . htmlspecialchars(1) . "</h5>";  
                        echo "<h4>" . htmlspecialchars($first["candidate_Name"]) . "</h4>";    

                       echo "<h6>Votes: " . htmlspecialchars($first["candidate_Number"]) . "</h6></div>";
                       echo "<img src = 'img/" . $first["candidate_Image"] . "' width = 400 title='" . $first['candidate_Image'] . "'>";
                       echo "<h7><strong>" . htmlspecialchars($first["candidate_Name"]) . " elected with " . htmlspecialchars($first["candidate_Number"]) . " votes.</strong></h7>";
         
                    }

                ?>
                        
            
            </div>
            <?php if(isset($candidates[1])){ ?>
            <div class = right>
                <?php
                    // 第二名候选人
                    if (isset($candidates[1])) {
                        $second = $candidates[1];
                        echo "<h3>Second Place</h3>";

                        echo "<div class = namel><h5>" . htmlspecialchars(2) . "</h5>";
                        echo "<h4>" . htmlspecialchars($second["candidate_Name"]) . "</h4>";

                        echo "<h6>Votes: " . htmlspecialchars($second["candidate_Number"]) . "</h6></div>";
                        
                    }

                    // 第三名候选人
                    if (isset($candidates[2])) {
                        $third = $candidates[2];
                        echo "<h3>Third Place</h3>";

                        echo "<div class = namel><h5>" . htmlspecialchars(3) . "</h5>";
                        echo "<h4>" . htmlspecialchars($third["candidate_Name"]) . "</h4>";

                        echo "<h6>Votes: " . htmlspecialchars($third["candidate_Number"]) . "</h6></div>";
                    }
                ?>
                
            </div>
            <?php } ?>
            
        </div>

        <button onclick="window.location.href='home.php'" class="ca">Back Home</button>
    </main>
    <footer>

    </footer>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
}
 ?>