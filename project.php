<!doctype html>
<html lang="en">

  <?php 
  ini_set("display_errors", 1);
  include "manager/authentication.php";
  include "imports/head.php";

  if (!isset($_GET['id'])) 
    die('<script>window.location.href = "./projects"</script>');
  
  if (get_project($_GET['id']) == null) 
    die('<script>window.location.href = "./projects"</script>');
  
  $id = $_GET['id'];

  $row = get_project($id);
  
  $type = ($row['type'] === 0) ? "Schule" : "Freizeit";
  $title = $row['title'];
  $description = nl2br($row['description']);
  $developer = $row['developer'];
  $version = $row['version'];
  $workplace = $row['workplace'];
  $professor = $row['professor'];
  $difficulty = $row['difficulty'];
  $startTimestamp = $row['startDate'];
  $endTimestamp = $row['endDate'];
  $releaseTimestamp = $row['releaseDate'];
  $downloadUrl = $row['downloadUrl'];
  $githubUrl = $row['githubUrl'];
  $tags = explode(',', $row['tags']);
  $images = explode(',', $row['images']);

  switch ($difficulty) {
    default:
      $difficulty = "<span class='text-success'>Leicht</span>";
      break;
    case 1:
      $difficulty = "<span class='text-warning'>Mittel</span>";
      break;
    case 2:
      $difficulty = "<span class='text-danger'>Schwierig</span>";
      break;
  }

  setlocale(LC_ALL, 'de_DE.utf8');
  $startDate = strftime("%d. %B %Y", $startTimestamp);
  $endDate = strftime("%d. %B %Y", $endTimestamp);
  $releaseDate = strftime("%d. %B %Y", $releaseTimestamp);

  $date1 = new DateTime(strftime("%Y-%m-%d", $startTimestamp));
  $date2 = new DateTime(strftime("%Y-%m-%d", $endTimestamp));
  $interval = $date1->diff($date2);
  $difference = "(" . $interval->m . " Monate)";

  if ($startTimestamp == null) $startDate = '-';
  if ($endTimestamp == null) $endDate = "-";
  if ($releaseTimestamp == null) $releaseDate = "-";
  if ($startTimestamp == null || $endTimestamp == null) $difference = "";
  ?>

  <body>

    <?php include "imports/navigation.php" ?>

    <div class="container mt-5">

      <!-- Header -->

      <a href="./projects" class="go-back">🡠 Zurück zu Projekten</a>

      <div class="mt-4"></div>

      <span class="h3 projects-title"><?=$title?></span><br>
      <span class="text-muted fs-6">Projekt wurde am <b><?=$releaseDate?></b> veröffentlicht.</span>

      <!-- Header End -->

      <hr class="project-hr" />

      <!-- Project Details -->

      <div class="row flex-column-reverse flex-md-row">

        <div class="col-lg-7 col-xl-7 col-md-12 col-sm-12 mb-5">
            <span class="projects-text">
                <?=$description?>
            </span>
        </div>

        <div class="col-lg-5 col-xl-5 col-md-12 col-sm-12 mb-5">
            
            <div class="card mb-2">
                <div class="card-body">

                  <!-- Developer Item -->
                  <span class="item-icon"><i class="fas fa-code"></i></span>
                  <span class="item-header">Entwickler:</span>
                  <span class="item-text"><?=$developer?></span>
                  <br />
                  <!-- Developer Item End -->

                  <!-- Version Item -->
                  <span class="item-icon"><i class="fas fa-code-branch"></i></span>
                  <span class="item-header">Version:</span>
                  <span class="item-text"><?=$version?></span>
                  <br />
                  <!-- Version Item End -->


                  <hr class="item-divider" />

                  <!-- Type Item -->
                  <span class="item-icon"><i class="fas fa-border-all"></i></span>
                  <span class="item-header">Art:</span>
                  <span class="item-text"><?=$type?></span>
                  <br />
                  <!-- Type Item End -->

                  <!-- Location Item -->
                  <span class="item-icon"><i class="fas fa-map-marked-alt"></i></span>
                  <span class="item-header">Arbeitsplatz:</span>
                  <span class="item-text"><?=$workplace?></span>
                  <br />
                  <!-- Location Item End -->

                  <!-- Professor Item -->
                  <span class="item-icon"><i class="fas fa-chalkboard-teacher"></i></span>
                  <span class="item-header">Professor:</span>
                  <span class="item-text"><?=$professor?></span>
                  <br />
                  <!-- Professor Item End -->

                  <!-- Difficulty Item -->
                  <span class="item-icon"><i class="fas fa-dumpster-fire"></i></span>
                  <span class="item-header">Schwierigkeit:</span>
                  <span class="item-text text-danger"><?=$difficulty?></span>
                  <br />
                  <!-- Difficulty Item End -->

                  <!-- Start Item -->
                  <span class="item-icon"><i class="fas fa-hourglass-start"></i></span>
                  <span class="item-header">Start:</span>
                  <span class="item-text"><?=$startDate?></span>
                  <br />
                  <!-- Start Item End -->

                  <!-- End Item -->
                  <span class="item-icon"><i class="fas fa-hourglass-end"></i></span>
                  <span class="item-header">Abgabe:</span>
                  <span class="item-text"><?=$endDate?> <?=$difference?></span>
                  <br />
                  <!-- End Item End -->

                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">

                  <?php
                  
                  if ($downloadUrl != null) echo '<a href="' . $downloadUrl . '" class="embed-link" target="_blank"><i class="fas fa-download"></i>&nbsp; Herunterladen</span></a>';
                  if ($githubUrl != null) echo '<a href="' . $githubUrl . '" class="embed-link" target="_blank"><i class="fab fa-github"></i>&nbsp; GitHub</span></a>';
                  if ($downloadUrl == null && $githubUrl == null) echo '<span class="text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp; Kein Download oder Github verfügbar.</span>';
                  ?>

                </div>
            </div>

        </div>

      </div>


      <div class="mt-3"></div>
      <span class="h4 projects-title">Screenshots</span><br>
      <hr />

      <?php

      if (empty($images) || empty($images[0])) {
        echo '<span class="text-danger"><i class="fas fa-exclamation-triangle"></i> <b>Oops!</b> Es gibt zu diesem Projekt noch keine Screenshots.</span>';
      } else {

        foreach ($images as $image) {

          ?>

          <div class="mb-5">
            <img src="./screenshots/<?=$image?>" class="img-fluid" /><br>
            <small class="text-muted"><?php echo get_image_description($image); ?></small>
          </div>

          <?php

        }

      }

      ?>


    </div>

    <?php include "imports/scripts.php" ?>
  </body>
  
</html>
