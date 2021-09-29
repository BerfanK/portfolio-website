<!doctype html>
<html lang="en">

  <?php 
  include "./manager/authentication.php";
  include "imports/head.php"; 
  include_once("./manager/utilities.php"); ?>

  <body>

    <?php include "imports/navigation.php" ?>

    <div class="container mt-5">

    <?php

    if (isset($_POST["submitForm"])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = nl2br(htmlspecialchars($_POST['message']));
        
        ?>

        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
          <strong><i class="fas fa-exclamation-triangle"></i> Das Kontaktformular wurde noch nicht eingerichtet. Bitte kontaktiere mich normal per <a href="mailto:berfan.korkmaz@stud.edubs.ch" class='embed-link'>Mail</a></strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <?php

    }

    ?>

      <!-- Header -->

      <a href="./" class="go-back">🡠 Zurück zur Startseite</a>

      <div class="card embed-dark mt-3">
        <div class="card-body">
          <span class="h2 projects-title">Kontakt</span><br>
          <span class="projects-text">In diesem Abschnitt können Sie mich kontaktieren.</span>
        </div>
      </div>

      <!-- Header End -->

      <hr class="hr" />

        <!--<form autocomplete="off" class="mt-5 needs-validation" method="post" novalidate>-->

        <form autocomplete="off" class="mt-5 needs-validation" method="post" novalidate>

          <div class="row flex-column-reverse flex-md-row">

            <!-- Col -->
            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mb-3 mx-0">
              <div class="form-group mb-4">
                  <label for="name" class="mb-1"><b>Bitte geben Sie Ihren Namen ein <span class="text-danger">*</span></b></label>
                  <input type="text" id="name" name="name" class="form-control shadow-none p-2" placeholder="z.B. Max Mustermann" required>
                  <div class="invalid-feedback">
                    Bitte füllen Sie dieses Feld aus.
                  </div>
              </div>

              <div class="form-group mb-4">
                  <label for="email" class="mb-1"><b>Bitte geben Sie Ihre Email-Adresse ein <span class="text-danger">*</span></b></label>
                  <input type="text" id="email" name="email" class="form-control shadow-none p-2" placeholder="z.B. max.mustermann@gmail.com" required>
                  <div class="invalid-feedback">
                    Bitte füllen Sie dieses Feld aus.
                  </div>
              </div>

              <div class="form-group mb-4">
                  <label for="message" class="mb-1"><b>Bitte geben Sie eine Nachricht ein <span class="text-danger">*</span></b></label>
                  <textarea spellcheck="false" id="message" name="message" class="form-control shadow-none p-2" style="resize: none;" placeholder="Hier Ihre Nachricht eingeben..." col="30" rows="4" required></textarea>
                  <div class="invalid-feedback">
                    Bitte füllen Sie dieses Feld aus.
                  </div>
              </div>

              <input type="hidden" class="antispam">

              <div class="form-group mb-4">
                  <label for="files" class="mb-1"><b>Anhänge</b></label>
                  <input type="file" id="files" name="files" class="form-control shadow-none p-2" multiple>
              </div>

              <div class="form-group mb-4">
                  <button type="submit" name="submitForm" style="width: 100%" class="shadow-none p-2 btn btn-dark">Absenden</button>
              </div>

            </div>
            <!-- End Col -->

            <div class="col-1"></div>

            <!-- Col -->
            <div class="col-lg-5 col-xl-5 col-md-12 col-md-12 mx-0">
              
              <label for="" class="mb-1"><b>Kontaktdetails</b></label>
              <div class="card mb-3">
                <div class="card-body">

                    <span class="item-icon mb-2"><i class="fas fa-envelope-open-text"></i></span>
                    <span class="item-text"><a href="mailto:berfan.korkmaz@stud.edubs.ch" style="text-decoration: none; color: inherit">ihre@email.ch</a></span><br>

                    <span class="item-icon mb-2"><i class="fas fa-phone-alt"></i></span>
                    <span class="item-text">(+41) 12 345 67 89</span><br>

                    <span class="item-icon mb-2"><i class="fas fa-clock"></i></span>
                    <span class="item-text">Binnen 24 Stunden</span>

                </div>
              </div>

            </div>
            <!-- End Col -->

          </div>

        </form>
        
    </div>

    <?php include "imports/scripts.php" ?>
  </body>
  
</html>
