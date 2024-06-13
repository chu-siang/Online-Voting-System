<?php 
session_start();

if (isset($_SESSION['key']) && isset($_SESSION['webkey'])) {

 ?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8"></meta>
    <title>Vote System</title>
    <link rel = "stylesheet" href = "style_4.css">
</head>

<body>
    <header>
    </header>
    <main>
        <h2 class="slide-in-top">Here is your Login key!</h2>
        <h3 class="slide-in-top">Write down it carefully!</h3>
        <h4 class="bounce-in-top"><?php echo $_SESSION['key']; ?></h4>
        <br>
        <h2 class="slide-in-top">Here is your Invocing Vote key!</h2>
        <h3 class="slide-in-top">Write down it carefully!</h3>
        <h4 class="bounce-in-top"><?php echo $_SESSION['webkey']; ?></h4>
        <br>
        <button onclick="window.location.href='index.php'"class="button button1">Go Back</button>
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