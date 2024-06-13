<?php 
session_start();

if (isset($_SESSION['key'])) {

 ?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8"></meta>
    <title>Vote System</title>
    <link rel = "stylesheet" href = "style_2.css">
</head>

<body>
    <header>

    </header>
    <main>
        <h2 class="slide-in-bottom">Sign up for Cosign</h2>
        <form method="post" action="votercheck.php">
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>

          <h3 class="slide-in-bottom">Name</h3>
          <?php if (isset($_GET['voter_Name'])) { ?>
               <input type="text" 
                      name="voter_Name" 
                      placeholder=" voter's name "
                      value="<?php echo $_GET['voter_Name']; ?>"
                      class="slide-in-bottom"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="voter_Name" 
                      placeholder=" voter's name "
                      class="slide-in-bottom"><br>
          <?php }?>

          <h3 class="slide-in-bottom">ID Number</h3>
          <?php if (isset($_GET['voter_ID'])) { ?>
               <input type="text" 
                      name="voter_ID" 
                      pattern="[A-Z]{1}[0-9]{9}" 
                      placeholder="ex:A123456789"
                      value="<?php echo $_GET['voter_ID']; ?>"
                      class="slide-in-bottom"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="voter_ID"
                      pattern="[A-Z]{1}[0-9]{9}" 
                      placeholder="A123456789"
                      class="slide-in-bottom"><br>
          <?php }?>

          <h3 class="slide-in-bottom">Birthday</h3>
          <?php if (isset($_GET['voter_bd'])) { ?>
               <input type="date" 
                      name="voter_bd" 
                      placeholder="YYYY-MM-DD"
                      min="0000-00-00" max="9999-12-31"
                      value="<?php echo $_GET['voter_bd']; ?>"
                      class="slide-in-bottom"><br>
          <?php }else{ ?>
               <input type="date" 
                      name="voter_bd"
                      min="0000-00-00" max="9999-12-31"
                      placeholder="YYYY-MM-DD"
                      class="slide-in-bottom"><br>
          <?php }?>
          <h3 class="slide-in-bottom">Enter your phone number</h3>
          <?php if (isset($_GET['voter_phone'])) { ?>
               <input type="tel" 
                      name="voter_phone" 
                      placeholder="0923-456-789"
                      pattern="[0-9]{4}-[0-9]{3}-[0-9]{3}" 
                      value="<?php echo $_GET['voter_phone']; ?>"
                      class="slide-in-bottom"><br>
          <?php }else{ ?>
               <input type="tel" 
                      name="voter_phone"
                      pattern="[0-9]{4}-[0-9]{3}-[0-9]{3}"
                      placeholder="0923-456-789"
                      class="slide-in-bottom"><br>
          <?php }?>
          <?php $key = $_SESSION['key']; 
               $_SESSION['key'] = $key;
          ?>

          <!-- <button onclick="window.location.href='home.php'" type="submit" class="ca">Submit</button> -->
          <button  type="submit" class="ca">Submit</button>     
     </form>
          <button onclick="window.location.href='home.php'"class="ca">Back to home</button>
    </main>
    <footer></footer>
</body>
</html>

<?php 
}else{
     header("Location: home.php");
     exit();
}
 ?>