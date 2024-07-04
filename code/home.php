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
    <link rel = "stylesheet" type="text/css" href = "style_5.css">
</head>

<body>
    <header>
        
    </header>
    <main>
        <?php 
            $key =  $_SESSION['key'];
            $_SESSION['key'] = $key;
            $condition_1 = false;
            $condition_2 = false;
            $condition_3 = false;
        ?>
        <?php if (isset($_GET['weberror'])) { ?>
     		<p class="error"><?php echo $_GET['weberror']; ?></p>
             <? $condition_1 = false;?>
     	<?php } ?>

          <?php if (isset($_GET['websuccess'])) { ?>
               <p class="success"><?php echo $_GET['websuccess']; ?></p>
          <? $condition_1 = true;?>
          <?php } ?>

          <?php if (isset($_GET['errorweb'])) { ?>
     		<p class="error"><?php echo $_GET['errorweb']; ?></p>
     	<?php } ?>
         <?php if(isset($_GET['accountsuccess'])) {  ?>
            <p class="success"><?php echo $_GET['accountsuccess']; ?></p>
        <?php } ?>
          <?php if (isset($_GET['successweb'])) { 
                 $condition_2 = TRUE;?>
               <p class="success"><?php echo $_GET['successweb']; ?></p>
                
          <?php } ?>
        <h2>Current Status</h2>
        <div class = "container">
            <div class = left>
                <button onclick="window.location.href='cosignStatus.php'" >Show more</button>
                
                <?php
                    $sql = "SELECT * FROM nation WHERE vote_key='$key' ";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $qualify_cosign_number = $row['limit_cosign_num'];
                    $_SESSION['qualify_cosign_number'] = $qualify_cosign_number;

                    if($row['is_invocing']){
                        $condition_2 = TRUE;
                    }
                    $sql2 = "SELECT * FROM candidate WHERE vote_key='$key' ";



                    $result2 = mysqli_query($conn, $sql2);
                    $shortage = $qualify_cosign_number - mysqli_num_rows($result2);
                    if($shortage <= 0){
                        echo "<h3> The number of candidate is enough</span></h3>";
                        $condition_3 = TRUE;
                    }
                    else echo "<h3> Shortage of Candidate <span class='highlight'>" . $shortage . "</span></h3>";
                ?>
                
                
                <!-- <h3>A qualified candidate need <?php echo $qualify_cosign_number ?></h3> -->
                <h3>A qualified candidate need <?php echo "<span class='highlight'>" . $qualify_cosign_number . "</span> cosigns."?></h3>

                <?php
                // 假設有一個變數 $condition，代表條件是否符合
                 // 或者從數據庫或其他地方獲取條件值

                // 檢查條件是否符合
                if($condition_2){
                    echo "<h3>Invocing is done.</h3>";
                    echo '<button class="disabled">----</button>';
                }
                else if ($condition_3) {
                    // 如果條件符合，生成一個可按的按鈕
                    echo '<button onclick="window.location.href=\'votepagelogin.php\'" class="enabled">Go Vote</button>';
                }else{
                    // 如果條件不符合，生成一個不可按的按鈕
                    echo '<button class="disabled">Still need candidates.</button>';
                }
            ?>
            </div>
            <div class = right>
                <?php if (!$condition_3){?>
                <button onclick="window.location.href='cosign.php'" >
                <img src="image/h1.png" class = "im">
                    <br>Stand for Election
                </button>
                <?php }else{?>
                <button class = "disable">PLEASE GO TO VOTE</button>
                <?php }?>

                <?php if (!$condition_3){?>
                <button onclick="window.location.href='loginvoter.php'" >
                    <img src="image/h2.png" class = "im">
                    <br>Cosign
                </button>
                <?php }else{?>
                    <?php }?>
                <br><button onclick="window.location.href='logout.php'" class="ca">Logout</button>
                
            </div>
            

        </div>
            
            
            
        </div>
    </main>
    <footer>

        <form method="post" action="invocingcheck.php">
            <h4>Enter invocing code:</h4>
            <input type="text" 
                name="webkey" 
                placeholder="Invocing Key"
            ><br></input>
        </form>
        <?php
            // 假設有一個變數 $condition，代表條件是否符合
            // 或者從數據庫或其他地方獲取條件值
            // 檢查條件是否符合
            if ($condition_2 === TRUE && $condition_3 === TRUE) {
            // 如果條件符合，生成一個可按的按鈕
                echo '<button type="submit" onclick="window.location.href=\'invocing.php\'" class="enabled">Invocing</button>';
            } else {
                // 如果條件不符合，生成一個不可按的按鈕
                echo '<button type="button" class="disabled" disabled>Wait for Election Committee Invocing.</button>';
            }
        ?>

    </footer>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>