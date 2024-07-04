<?php 
session_start();
include "db_conn.php";
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
        <div class="left-corner">
            <h1 class="slide-in-top">VO</h1>
        </div>
        <div class="right-corner">
            <h1 class="slide-in-top">TE</h1>
        </div>
        <div class="container">
            <div class="banner_txt">
                <form method="post" action="loginkey.php">
                    <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                    <h2 class="slide-in-bottom">Key</h2>
                    <input type="text" name="key" placeholder="Valid Key" class="slide-in-bottom"><br>
                    <button type="submit" class="ca slide-in-bottom">Login</button>
                </form>
                <hr class="slide-in-bottom">
                <button onclick="window.location.href='signup.php'" class="ca slide-in-bottom">Register</button>
            </div>
        </div>
    </div>
</body>
</html>