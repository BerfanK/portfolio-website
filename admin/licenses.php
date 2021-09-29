<!doctype html>
<html lang="en">

  <?php include "../manager/authentication.php"; ?>
  <?php include "../imports/head.php" ?>

  <body>

    <?php include "../imports/navigation.php" ?>

    <div class="container mt-5">

        <!-- Header -->

      <a href="./" class="go-back">🡠 Zurück zur Startseite</a>

      <div class="card embed mt-3">
        <div class="card-body">
          <span class="h2 projects-title">Lizenzenverwaltung</span><br>
          <span class="projects-text">Hier können Sie eine Lizenz erstellen resp. verwalten.</span>
        </div>
      </div>

      <!-- Header End -->

      <hr class="hr" />

      <?php

          if (isset($_POST["submit"])) {

            $days = $_POST["days"];
            $usesLimit = ($_POST["uses"] == 0) ? null : $_POST["uses"];
            $email = (!isset($_POST["email"])) ? null : $_POST["email"];
            $admin = (!isset($_POST["admin"])) ? 0 : 1;

            $license = create_license($days, $email, $usesLimit, $admin);

            echo 
            '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-check"></i> Lizenz wurde erfolgreich erstellt: <code>'. $license .'</code></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';

            if ($email != null) {
              // TODO: Send mail
            }

          }

          if (isset($_GET['delete'])) {

            $id = $_GET['delete'];

            if (get_license(get_license_by_id($id)) != null) {
              delete_license($id);
            }

            echo "<script>window.location.href = './licenses';</script>";

          };

      ?>

      <form method="post" class="mt-5 needs-validation" novalidate>

        <div class="row">

            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12  mx-0">
              <div class="form-group mb-4">
                  <label for="name" class="mb-1"><b>Nach wie vielen Tagen soll die Lizenz ablaufen? <span class="text-danger">*</span></b></label>
                  <input type="number" id="days" name="days" class="form-control shadow-none p-2" placeholder="z.B. 30 (0, wenn permanent)" required>
                  <div class="invalid-feedback">
                    Bitte füllen Sie dieses Feld aus.
                  </div>
              </div>
            </div>

            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">
              <div class="form-group mb-4">
                  <label for="name" class="mb-1"><b>Nach wie vielen Uses soll die Lizenz ablaufen? <span class="text-danger">*</span></b></label>
                  <input type="number" id="uses" name="uses" class="form-control shadow-none p-2" placeholder="z.B. 5 (0, wenn unendlich)" required>
                  <div class="invalid-feedback">
                    Bitte füllen Sie dieses Feld aus.
                  </div>
              </div>
            </div>

            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">
              <div class="form-group mb-4">
                  <label for="email" class="mb-1"><b>Soll das Unternehmen benachrichtigt werden?</b></label>
                  <input type="email" id="email" name="email" class="form-control shadow-none p-2" placeholder="z.B. jobs@google.ch (leer, wenn nein)">
              </div>
            </div>

            <div class="col-12 mx-0">
              <div class="form-group mb-4">
                  <input class="form-check-input" type="checkbox" name="admin" value="" id="flexCheckChecked">
                  <label class="form-check-label" for="flexCheckChecked">
                    &nbsp;  Lizenz soll Admin sein
                  </label>
              </div>
            </div>

            <div class="col-12 mb-3 mx-0">
              <div class="form-group mb-4">
                  <button type="submit" name="submit" style="width: 100%" class="shadow-none p-2 btn btn-dark">Erstellen</button>
              </div>
            </div>

        </div>

      </form>

      <hr class="hr" />

        <?php

          $result = get_licenses();

          while ($row = $result->fetch_assoc()) {

            $date1 = new DateTime();
            $date2 = new DateTime(strftime("%Y-%m-%d", $row['expireDate']));
            $interval = $date1->diff($date2);
            $totalDays = ($interval->y != 0 && $interval->m != 0) ? ((($interval->y * 12) * 30) + ($interval->m * 30) + $interval->d) : $interval->d;
            $expiresIn = "Läuft ab in " . $totalDays . " Tage(n)";
            if ($row['expireDate'] == -1) $expiresIn = "Läuft nie ab";

            $license = $row['token'];
            $uses = $row['uses'];
            $maxUses = $row['usesLimit'];
            $admin = $row['isAdmin'];
            $email = $row['email'];
            $id = $row['id'];

            $licenseHtml = $license;
            $daysHtml = $expiresIn;
            $usesHtml = ($maxUses == null) ? $uses . "/∞" : $uses . "/" . $maxUses;
            $adminHtml = ($admin == 1) ? "<span class='text-danger'><b>*</b></span>" : "";
            $emailHtml = ($email != null) ? "<small class='text-primary'>" . $email . "</small><br>" : "";

          

        ?>

          <div class="card mb-4">
            <div class="card-body">

              <!-- Row -->
              <div class="row">

                <div class="col-12">
                  <span class="login-text"><?=$emailHtml?><b><?=$licenseHtml?></b> <?=$adminHtml?> <span data-bs-toggle="tooltip" data-bs-placement="top" title="Anzahl Nutzungen">(<?=$usesHtml?>)</span></span>
                </div>

                <div class="col-6">
                  <small class="text-muted"><?=$daysHtml?></small>
                </div>

                <div class="col-6 text-end ">
                  <a href="./licenses?delete=<?=$id?>" class="embed-link text-danger me-2">Löschen</a>
                </div>

              </div>
              <!-- End Row -->

            </div>
          </div>

        <?php

          }

        ?>

        <div class="mb-5"></div>


    </div>


    <?php include "../imports/scripts.php" ?>
  </body>
  
</html>
