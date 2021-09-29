<!doctype html>
<html lang="en">

  <?php 
  include "./manager//authentication.php";
  include "imports/head.php"; 
  include_once("./manager/utilities.php"); ?>

  <body>

    <?php include "imports/navigation.php" ?>

    <div class="container mt-5">

      <!-- Header -->

      <a href="./" class="go-back">🡠 Zurück zur Startseite</a>

      <div class="card embed-green mt-3">
        <div class="card-body">
          <span class="h2 projects-title">Lebenslauf</span><br>
          <span class="projects-text">In diesem Abschnitt sehen Sie mein Lebenslauf.</span>
        </div>
      </div>

      <!-- Header End -->

      <hr class="hr" />

      <a class="fs-5 embed-link" href="./assets/Lebenslauf.pdf"><i class="fas fa-cloud-download-alt"></i>&nbsp; Lebenslauf herunterladen</a>

      <!-- Row -->
      <div class="row mt-5">

            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 mb-5">
                <div class="cv-header">Persönliche Daten</div>

                <span class="cv-field">Name</span><span class="cv-value">Ihr Name</span><br>
                <span class="cv-field">Anschrift</span><span class="cv-value">Ihre Adresse</span><br>
                <span class="cv-field"></span><span class="cv-value">PLZ, Ort</span><br>
                <span class="cv-field">Telefon</span><span class="cv-value">Ihre Telefonnr.</span><br>
                <span class="cv-field">E-Mail</span><span class="cv-value">Ihre Email</span><br>
                <span class="cv-field">Geburtsdatum</span><span class="cv-value">Ihr Geburtsdatum</span>
            </div>

            <div class="col-2"></div>

            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 mb-5">
                <div class="cv-header">Schnupperlehren</div>

                <div class="cv-text"><b>Jahr - Firma</b></div>
                <div class="cv-text">Tätigkeit</div>
                
            </div>

            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 mb-5">
                <div class="cv-header">Ausbildung</div>

                <div class="cv-small-title"><b>Von - Bis</b></div>
                <div class="cv-text">Art der Ausbildung</div>
                <div class="cv-text">Name</div>

                <div class="cv-divider"></div>

                <div class="cv-small-title"><b>Von - Bis</b></div>
                <div class="cv-text">Art der Ausbildung</div>
                <div class="cv-text">Name</div>

                <div class="cv-divider"></div>

                <div class="cv-small-title"><b>Von - Bis</b></div>
                <div class="cv-text">Art der Ausbildung</div>
                <div class="cv-text">Name</div>

            </div>

            <div class="col-2"></div>

            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 mb-5">
                <div class="cv-header">Freizeitinteressen</div>

                <div class="cv-small-title"><b>Überbegriff</b></div>
                <div class="cv-text">- Punkt</div>
                <div class="cv-text">- Punkt</div>
				<div class="cv-text">- Punkt</div>
				<div class="cv-text">- Punkt</div>

                <div class="cv-divider"></div>

                <div class="cv-small-title"><b>Sonstige Hobbys</b></div>
                <div class="cv-text">- Punkt</div>
				<div class="cv-text">- Punkt</div>

            </div>

            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 mb-5">
                <div class="cv-header">Kentnisse & Fähigkeiten</div>

                <div class="cv-text"><b>Sprachkenntnisse</b></div>
                <div class="cv-text">Deutsch als Muttersprache</div>
                <div class="cv-text">2. Sprache ...</div>
				<div class="cv-text">3. Sprache ...</div>

                <div class="cv-divider"></div>

                <div class="cv-text"><b>EDV-Kenntnisse</b></div>
                <div class="cv-text">PHP - Fortgeschritten</div>
                <div class="cv-text">HTML & CSS - Fortgeschritten</div>
                <div class="cv-text">Java - Grundkenntnisse</div>
                <div class="cv-text">C# - Grundkenntnisse</div>

            </div>

            <div class="col-2"></div>

            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 mb-5">
                <div class="cv-header">Referenzen</div>

                <div class="cv-text"><b>Name (Tätigkeit)</b></div>
                <div class="cv-text">Tel.: Telefonnr.</div>
                <div class="cv-text">Email: Email</div>

                <div class="cv-divider"></div>

                <div class="cv-text"><b>Name (Tätigkeit)</b></div>
                <div class="cv-text">Tel.: Telefonnr.</div>
                <div class="cv-text">Email: Email</div>

                <div class="cv-divider"></div>

                <div class="cv-text"><b>Name (Tätigkeit)</b></div>
                <div class="cv-text">Tel.: Telefonnr.</div>
                <div class="cv-text">Email: Email</div>

            </div>
            

      </div>
      <!-- Row End -->

    </div>

    <?php include "imports/scripts.php" ?>
  </body>
  
</html>
