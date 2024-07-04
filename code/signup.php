<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8"></meta>
    <title>Vote System</title>
    <link rel = "stylesheet"  type="text/css" href = "style_2.css">
</head>
<body>
     <form action="signup-check.php" method="post">
     	<h2>SETTING</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>

          <label>Vote Name</label>
          <br>
          <?php if (isset($_GET['votename'])) { ?>
               <input type="text" 
                      name="votename" 
                      placeholder="VoteName"
                      value="<?php echo $_GET['votename']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="votename" 
                      placeholder="VoteName"><br>
          <?php }?>

        <label>Number of Candidates</label>
        <br>
          <?php if (isset($_GET['cnum'])) { ?>
               <input type="number" 
                      min = "0"
                      max = "10"
                      name="cnum" 
                      placeholder="1~10"
                      value="<?php echo $_GET['cnum']; ?>"><br>
          <?php }else{ ?>
               <input type="number" 
                      name="cnum" 
                      min = "1"
                      max = "10"
                      placeholder="1~10"><br>
          <?php }?>

        <label>Limit of Cosign</label>
        <br>
          <?php if (isset($_GET['lnum'])) { ?>
               <input type="number" 
                      min = "1"
                      name="lnum" 
                      placeholder="positve integer"
                      value="<?php echo $_GET['lnum']; ?>"><br>
          <?php }else{ ?>
               <input type="number" 
                      name="lnum"
                      min = "1"
                      placeholder="positive integer"><br>
          <?php }?>

        <label>Number of Voter</label>
        <br>
          <?php if (isset($_GET['vnum'])) { ?>
               <input type="number" 
                      min = "1"
                      name="vnum" 
                      placeholder="positve integer"
                      value="<?php echo $_GET['vnum']; ?>"><br>
          <?php }else{ ?>
               <input type="number" 
                      name="vnum"
                      min = "1"
                      placeholder="positive integer"><br>
          <?php }?>

          <label>Percentage of Ballot to Elect</label>
          <br>
          <?php if (isset($_GET['percent'])) { ?>
               <input type="number" 
                      min = "0"
                      max = "100"
                      name="percent"
                      placeholder="positve integer(0~100)%"
                      value="<?php echo $_GET['percent']; ?>"><br>
          <?php }else{ ?>
               <input type="number" 
                      name="percent"
                      min = "0"
                      max = "100"
                      text-align="center"
                      placeholder=" 0~100 "><br>
          <?php }?>
          <section class = "s_button">
               <button type="submit"class="ca">Sign Up</button>
            </section>
        </form>
        <a href="index.php"class="slide-in-bottom">Already have an account?</a>
     
</body>
</html>