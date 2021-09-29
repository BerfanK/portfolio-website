<?php

session_start();
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {

    if ($directory == 'admin')
        die ("<script>window.location.href = '../logout'</script>");
    else 
        die ("<script>window.location.href = './logout'</script>");

}

?>

<!doctype html>
<html lang="en">

  <?php include "imports/head.php" ?>

  <body>

    <?php include "imports/navigation.php" ?>
        
    <!-- Section -->
    <div class="container mt-5">

        <?php

        if (isset($_POST["submitForm"])) {

            $license = $_POST["license"];
            login($license);

        }

        ?>

        <div class="card p-3">
            <div class="card-body">
                <div class="login-title">Bitte anmelden.</div>
                <div class="login-text">Sie brauchen eine Lizenz, um Zugriff zu erhalten.</div>
                <div class="cv-divider"></div>
                
                <form method="post" autocomplete="off">
                    <div class="form-group">
                        <div class="input-group w-75 mx-auto">
                            <input class="form-control shadow-none" type="text" name="license" placeholder="Lizenz eingeben..." required>
                            <button type="submit" name="submitForm" class="input-group-text text-primary"><i class="fas fa-arrow-right"></i></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
    <!-- Section End -->


    <?php include "imports/scripts.php" ?>
  </body>
  
</html>


