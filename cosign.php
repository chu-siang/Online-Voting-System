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
        <h2 class="slide-in-bottom">Sign up for being a cosign</h2>
        <form method="post"enctype="multipart/form-data" action="cosigncheck.php">
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>

          <h3 class="slide-in-bottom">Name</h3>
          <?php if (isset($_GET['cosign_Name'])) { ?>
               <input type="text" 
                      name="cosign_Name" 
                      placeholder="  cosign name "
                      value="<?php echo $_GET['cosign_Name']; ?>"
                      class="slide-in-bottom"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="cosign_Name" 
                      placeholder="cosign Name "
                      class="slide-in-bottom"><br>
          <?php }?>

          <h3 class="slide-in-bottom">ID Number</h3>
          <?php if (isset($_GET['cosign_ID'])) { ?>
               <input type="text" 
                      name="cosign_ID" 
                      pattern="[A-Z]{1}[0-9]{9}" 
                      placeholder="ex:A123456789"
                      value="<?php echo $_GET['cosign_ID']; ?>"
                      class="slide-in-bottom"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="cosign_ID"
                      pattern="[A-Z]{1}[0-9]{9}" 
                      placeholder="A123456789"
                      class="slide-in-bottom"><br>
          <?php }?>

          <h3 class="slide-in-bottom">Birthday</h3>
          <?php if (isset($_GET['cosign_bd'])) { ?>
               <input type="date" 
                      name="cosign_bd" 
                      placeholder="YYYY-MM-DD"
                      min="0000-01-01" max="9999-12-31"
                      value="<?php echo $_GET['cosign_bd']; ?>"
                      class="slide-in-bottom"><br>
          <?php }else{ ?>
               <input type="date" 
                      name="cosign_bd"
                      min="0000-01-01" max="9999-12-31"
                      placeholder="YYYY-MM-DD"
                      class="slide-in-bottom"><br>
          <?php }?>
          <h3 class="slide-in-bottom">Enter your phone number</h3>
          <?php if (isset($_GET['cosign_Phone'])) { ?>
               <input type="tel" 
                      name="cosign_Phone" 
                      placeholder="0923-456-789"
                      pattern="[0-9]{4}-[0-9]{3}-[0-9]{3}" 
                      value="<?php echo $_GET['cosign_Phone']; ?>"
                      class="slide-in-bottom"><br>
          <?php }else{ ?>
               <input type="tel" 
                      name="cosign_Phone"
                      pattern="[0-9]{4}-[0-9]{3}-[0-9]{3}"
                      placeholder="0923-456-789"
                      class="slide-in-bottom"><br>
          <?php }?>
          <?php $key = $_SESSION['key']; 
               $_SESSION['key'] = $key;
          ?>
          <h3 class="slide-in-bottom">Upload your Photo</h3>
            <input type="file" name="cosign_Image" accept=".jpg, .jpeg, .png" class="slide-in-bottom">
        <h3 class="slide-in-bottom">Enter your Platform</h3>
            <input type="text" name="cosign_Content" placeholder="Enter your platform"class="slide-in-bottom">
          <br>
            <button type="submit"class="ca">Submit</button>
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