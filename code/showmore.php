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
        <div class = "container">
            <div class = right>
            
                <?php
            $i = 1;
            $rows = mysqli_query($conn, "SELECT * FROM cosign WHERE vote_key = '$key'")
            ?>

            <?php foreach ($rows as $row) : ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <br>
                <td><?php echo $row["cosign_Name"]; ?></td>
                <br>
                <td><?php echo $row["cosign_Content"]; ?></td>
                <br>
                <?php 
                    if($qualify_cosign_number - $row["cosign_Number"] > 0){
                        echo "The shortage number of cosigns :";
                        echo $qualify_cosign_number - $row["cosign_Number"];
                    }else{
                        echo "Success assign for the election.";
                    }
                ?>
                <br>
                <td> <img src="img/<?php echo $row["cosign_Image"]; ?>" width = 400 title="<?php echo $row['cosign_Image']; ?>"> </td>
                <br>
            </tr>
            <?php endforeach; ?>
            
            <br>
            <button onclick="window.location.href='logout.php'" class="ca">Logout</button>

            
            </div>


        </div>
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