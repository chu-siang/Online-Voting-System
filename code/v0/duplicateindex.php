<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="style_1.css">
</head>
<body>
    <h1>key login<h1>
     <form action="loginkey.php" method="post">
         <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	    <?php } ?>
     	
     	<input type="text" name="key" placeholder="KEY"><br>

     	<button type="submit">Login</button>
          <a href="signup.php" class="ca">Create an account</a>
     </form>
<!--  -->
     <div class="background background2"></div>
        <div class="background background1"></div>
        <div class="banner">
            <div class="left-corner">
                <h1>VO</h1>
            </div>
            <div class="right-corner">
                <h1>TE</h1>
            </div>
            <div class="container">
                <div class="banner_txt">
                    <form method="post" action="loginkey.php">
                    <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                        <h2>Key</h2>
                        <input type="text" name="key" placeholder="KEY"><br>
                        <section class="s_button">
                            <button type="submit">Login</button>
                        </section>
                    </form>
                    <hr>
                    <button onclick="window.location.href='register.html'">Register</button>
                </div>
            </div>
        </div>
        <!--  -->
</body>
</html>