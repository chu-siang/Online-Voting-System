<?php 
session_start();

if (isset($_SESSION['key'])) {

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="style_1.css">
</head>
<body>
    <div class="background background2"></div>
    <div class="background background1"></div>
    <div class="banner">
        <?php 
        $key = $_SESSION['key'];
        $_SESSION['key'] = $key;
        ?>
        <div class="container">
            <div class="banner_txt">
                <form method="post" action="loginvotercheck.php">
                    <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                    <?php if (isset($_GET['success'])) { ?>
                    <p class="success"><?php echo $_GET['success']; ?></p>
                    <?php } ?>
                    <h2 class="slide-in-bottom">LOGIN TO COSIGN</h2>
                    <input type="text" name="voter_ID_Number" placeholder="Valid VOTER_ID" class="slide-in-bottom"><br>
                    <button type="submit" class="ca slide-in-bottom">Login</button>
                </form>
                <hr class="slide-in-bottom">
                <button onclick="window.location.href='bevoter.php'" class="ca slide-in-bottom">Register</button>
                <br>
                <button onclick="window.location.href='home.php'" class="ca slide-in-bottom">Back to home</button>
            </div>
        </div>
    </div>
</body>
</html>


<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>