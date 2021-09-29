<!doctype html>
<html lang="en">

  <?php include "./manager/authentication.php"; ?>
  <?php include "./imports/head.php" ?>
  <?php include_once("./manager/utilities.php"); ?>

  <body>

    <?php include "imports/navigation.php" ?>

    <div class="container mt-5">

        <!-- Header -->

      <a href="./index" class="go-back">🡠 Zurück zur Startseite</a>

      <div class="card embed mt-3">
        <div class="card-body">
          <span class="h2 projects-title">Projekte</span><br>
          <span class="projects-text">In diesem Abschnitt haben Sie einen Einblick in meine Projekte.</span>
        </div>
      </div>

      <!-- Header End -->

      <hr class="hr" />

      <!-- Projects -->

      <div class="row mb-5">

        <?php

        $result = get_project_embeds();
        
        while ($row = $result->fetch_assoc()) {

          $id = $row['id'];
          $type = $row['type'];
          $title = $row['title'];
          $tags = explode(',', $row['tags']);
          $description = truncate($row['description'], 200, "... (abgeschnitten)");
          $private = ($row['private'] == 1) ? true : false;
          if ($private) continue;

          $typeHtml = "<span class='tag-school' data-bs-toggle='tooltip' data-bs-placement='top' title='Schulprojekt'><i class='fas fa-graduation-cap'></i></span>";
          if ($type === 1) $typeHtml = "<span class='tag-free' data-bs-toggle='tooltip' data-bs-placement='top' title='Freizeitprojekt'><i class='fab fa-centercode'></i></span>";

          $titleHtml = truncate($title, 40);

          $tagHtml = "";
          foreach ($tags as $tag) {
            $tagHtml .= getTagString($tag);
          }

          ?>

          <!-- Project Col -->
          <div class="col-lg-6 col-xl-6 col-sm-12 col-md-12 mb-3">

            <div class="card">
                <div class="card-body">

                  
                  <?=$typeHtml?>
                  <?=$tagHtml?><br>
                  <span class="embed-title"><?=$titleHtml?></span><br>
                    <span class="embed-text"><?=$description?></span><br>
                  <a href="../project?id=<?=$id?>" class="embed-link"><i class="far fa-arrow-alt-circle-right mt-2"></i>&nbsp; Mehr Details</span></a>
                </div>
            </div>

            </div>
            <!-- Project Col End -->

            <?php
          
        }

        ?>

      </div>


    </div>


    <?php include "imports/scripts.php" ?>
  </body>
  
</html>
