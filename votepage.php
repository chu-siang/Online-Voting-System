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
    <link rel = "stylesheet" href = "style_33.css">
</head>

<body>
    <header>

    </header>
    <main>
        <?php 
        $key =  $_SESSION['key'];
        $_SESSION['key'] = $key;
        $vote_ID = $_SESSION['voter_ID_Number'];
        $_SESSION['voter_ID_Number'] = $vote_ID;
        ?>
        <h2>VOTE</h2>

        <div class="wrapper">
            <?php
            // 這裡應該是你的數據庫查詢結果
            // 假設 $result 是你的查詢結果
            $result = $conn->query("SELECT * FROM candidate where vote_key='$key'");

            if ($result->num_rows > 0) {
                // 輸出每一列數據
                while($row = $result->fetch_assoc()) {
                    echo "<div class='candidate'>";
                    echo "<h2>" . htmlspecialchars($row["candidate_Name"]) . "</h2>";
                    //echo "<h5>" . htmlspecialchars($row["candidate_Number"]) . "</h5>";
                    
                    //echo "<a href='candidate_details.php?id=" . htmlspecialchars($row["candidate_Number"]) . "'>";
                    if (!empty($row["candidate_Image"])) {
                        // echo "<img src = 'img/" . $row["candidate_Image"] . "' width = 200 title='" . $row['candidate_Image'] . "'>";
                        echo "<img src='img/" . $row["candidate_Image"] . "' width=200 title='" . $row['candidate_Image'] . "' data-candidate='" . htmlspecialchars($row["candidate_Name"]) . "' class='candidate-image'>";
                    } else {
                        // echo "<img src='default_photo.jpg' alt='Default Photo'>";
                        echo "<img src='default_photo.jpg' alt='Default Photo' data-candidate='" . htmlspecialchars($row["candidate_Name"]) . "' class='candidate-image'>";
                    }

                    echo "<button class='candidate-button' data-candidate='" . htmlspecialchars($row["candidate_Name"]) . "'></button>";
                    echo "</div>";
                }
            } else {
                echo "目前沒有候選人。";
            }
            ?>
        </div>

        <form id="voteForm" action="submit_vote.php" method="POST">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>
            <input type="hidden" name="selected_candidate" id="selected_candidate">
            <button type="submit" class="submit-button">Submit</button>
        </form>

        <script>
            document.querySelectorAll('.candidate-image').forEach(img => {
                img.addEventListener('click', function() {
                    const candidateName = this.getAttribute('data-candidate');
                    window.location.href = 'candidate_details.php?candidate=' + encodeURIComponent(candidateName);
                });
            });

            let selectedCandidate = null;

            document.querySelectorAll('.candidate-button').forEach(button => {
                button.addEventListener('click', function() {
                    const candidate = this.getAttribute('data-candidate');
                    if (selectedCandidate !== candidate) {
                        // 如果選擇的候選人與先前的不同，取消先前的選擇
                        if (selectedCandidate !== null) {
                            document.querySelector(`[data-candidate="${selectedCandidate}"]`).style.backgroundColor = '';
                        }
                        selectedCandidate = candidate;
                        this.style.backgroundColor = 'rgb(79, 106, 143)'; // 標示已選擇
                    } else {
                        // 如果再次點擊已選擇的候選人，取消選擇
                        selectedCandidate = null;
                        this.style.backgroundColor = ''; // 恢復原樣
                    }
                    console.log(selectedCandidate);
                });
            });

            document.querySelector('.submit-button').addEventListener('click', function() {
                if (selectedCandidate !== null) {
                    alert('你選擇的候選人是：' + selectedCandidate);
                    // 在這裡你可以進一步處理選擇，例如通過 AJAX 發送到伺服器
                    document.getElementById('selected_candidate').value = selectedCandidate;
                    document.getElementById('voteForm').submit();
                    // 在這裡添加跳轉到主頁的程式碼
                    window.location.href = 'home.php'; // 替換 'home.php' 為你的主頁 URL
                } else {
                    alert('請選擇一位候選人。');
                }
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