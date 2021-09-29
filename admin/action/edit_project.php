<?php

if (isset($_POST["editSubmit"])) {

    $projectId = $_GET["edit"];
    $title = $_POST["title"];
    $tags = explode(" ", $_POST["tags"]);
    $description = $_POST["description"];
    $startDate = ($_POST["startDate"] == null) ? null : strtotime($_POST["startDate"]);
    $endDate = ($_POST["endDate"] == null) ? null : strtotime($_POST["endDate"]);
    $developer = ($_POST["developer"] == null) ? "-" : $_POST["developer"];
    $version = ($_POST["version"] == null) ? "v1.0.0" : $_POST["version"];
    $workplace = ($_POST["workplace"] == null) ? "-" : $_POST["workplace"];
    $professor = ($_POST["professor"] == null) ? "-" : $_POST["professor"];
    $type = $_POST["type"];
    $difficulty = $_POST["difficulty"];
    $downloadUrl = ($_POST["download"] == null) ? null : $_POST["download"];
    $githubUrl = ($_POST["github"] == null) ? null : $_POST["github"];
    $private = $_POST["private"];


    update_project($projectId, $title, $tags, $description, $startDate, $endDate, $developer, $version, $workplace, $professor, $type, $difficulty, $downloadUrl, $githubUrl, $private);

}

if (isset($_GET['edit'])) {

    $projectId = $_GET['edit'];
    if (get_project($projectId) == null) {
      echo "<script>window.location.href = './projects';</script>";
    } else {

      $row = get_project($projectId);
      $title = $row["title"];
      $tags = explode(",", $row["tags"]);
      $description = $row["description"];
      $startDate = ($row["startDate"] == null) ? null : strftime("%Y-%m-%d", $row["startDate"]);
      $endDate = ($row["endDate"] == null) ? null : strftime("%Y-%m-%d", $row["endDate"]);
      $developer = ($row["developer"] == null) ? "-" : $row["developer"];
      $version = ($row["version"] == null) ? "v1.0.0" : $row["version"];
      $workplace = ($row["workplace"] == null) ? "-" : $row["workplace"];
      $professor = ($row["professor"] == null) ? "-" : $row["professor"];
      $type = $row["type"];
      $difficulty = $row["difficulty"];
      $downloadUrl = ($row["downloadUrl"] == null) ? null : $row["downloadUrl"];
      $githubUrl = ($row["githubUrl"] == null) ? null : $row["githubUrl"];
      $private = $row["private"];

      $tagsHtml = "";
      foreach ($tags as $tag) $tagsHtml .= $tag . " ";
      $tagsHtml = trim($tagsHtml);

      ?>



        <!-- Form -->
        <form class="mt-5 needs-validation" method="POST" enctype="multipart/form-data">

            <!-- Row -->
            <div class="row">

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="title" class="mb-1"><b>Name des Projekts <span class="text-danger">*</span></b></label>
                        <input type="text" id="title" name="title" class="form-control shadow-none p-2" placeholder="z.B. Project eBanking" value="<?=$title?>" required>
                        <div class="invalid-feedback">
                            Bitte füllen Sie dieses Feld aus.
                        </div>

                    </div>

                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12  mx-0">

                    <div class="form-group mb-4">

                        <label for="tags" class="mb-1"><b>Tags <span class="text-danger">*</span></b></label>
                        <input type="text" id="tags" name="tags" class="form-control shadow-none p-2" placeholder="z.B. C# ASP.NET Desktop-Applikation" value="<?=$tagsHtml?>"required>
                        <div class="invalid-feedback">
                            Bitte füllen Sie dieses Feld aus.
                        </div>

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-12">

                    <div class="form-group mb-4">

                        <label for="description" class="mb-1"><b>Beschreibung <span class="text-danger">*</span></b></label>
                        <textarea spellcheck="false" id="description" maxlength="1200" name="description" class="form-control shadow-none p-2" style="resize: none;" placeholder="Hier Ihre Nachricht eingeben..." col="30" rows="7" required><?=$description?></textarea>
                        <div class="invalid-feedback">
                            Bitte füllen Sie dieses Feld aus.
                        </div>

                    </div>

                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="startDate" class="mb-1"><b>Startdatum</b></label>
                        <input type="date" id="startDate" name="startDate" class="form-control shadow-none p-2" value="<?=$startDate?>">

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="endDate" class="mb-1"><b>Startdatum</b></label>
                        <input type="date" id="endDate" name="endDate" class="form-control shadow-none p-2" value="<?=$endDate?>">

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="developer" class="mb-1"><b>Entwickler</b></label>
                        <input type="text" id="developer" name="developer" class="form-control shadow-none p-2" placeholder="z.B. Max Mustermann" value="<?=$developer?>">

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="version" class="mb-1"><b>Version</b></label>
                        <input type="text" id="version" name="version" class="form-control shadow-none p-2" placeholder="z.B. v1.0.0" value="<?=$version?>">

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="workplace" class="mb-1"><b>Arbeitsplatz</b></label>
                        <input type="text" id="workplace" name="workplace" class="form-control shadow-none p-2" placeholder="z.B. Schule" value="<?=$workplace?>">

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="professor" class="mb-1"><b>Professor</b></label>
                        <input type="text" id="professor" name="professor" class="form-control shadow-none p-2" placeholder="z.B. Maximilian Musterman" value="<?=$professor?>">

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="type" class="mb-1"><b>Art</b></label>
                        <select id="type" name="type" class="form-control shadow-none p-2">
                            <option value="0" <?php if($type == 0) echo "selected"; ?>>Schule</option>
                            <option value="1" <?php if($type == 1) echo "selected"; ?>>Freizeit</option>
                            <option value="2" <?php if($type == 2) echo "selected"; ?>>Arbeit</option>
                        </select>

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="difficulty" class="mb-1"><b>Schwierigkeit</b></label>
                        <select id="difficulty" name="difficulty" class="form-control shadow-none p-2">
                            <option value="0" <?php if($difficulty == 0) echo "selected"; ?>>Leicht</option>
                            <option value="1" <?php if($difficulty == 1) echo "selected"; ?>>Mittel</option>
                            <option value="2" <?php if($difficulty == 2) echo "selected"; ?>>Schwierig</option>
                        </select>

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="download" class="mb-1"><b>Download</b></label>
                        <input type="text" id="download" name="download" class="form-control shadow-none p-2" placeholder="z.B. https://shaare.it/ufihaif" value="<?=$downloadUrl?>">

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="github" class="mb-1"><b>GitHub</b></label>
                        <input type="text" id="github" name="github" class="form-control shadow-none p-2" placeholder="z.B. https://github.com/BerfanK/portfolio" value="<?=$githubUrl?>">

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="public" class="mb-1"><b>Sichtbarkeit</b></label>
                        <div class="form-check">
                            <input class="form-check-input shadow-none" value="0" type="radio" name="private" id="public" <?php if ($private == 0) echo "checked"; ?>>
                            <label class="form-check-label" for="public">
                                <i class="fas fa-globe-americas"></i>&nbsp; Öffentlich
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input shadow-none" value="1" type="radio" name="private" id="private" <?php if ($private == 1) echo "checked"; ?>>
                            <label class="form-check-label" for="private">
                                <i class="fas fa-lock"></i>&nbsp; Privat
                            </label>
                        </div>

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-12 mb-3 mt-4 mx-0">

                    <div class="form-group mb-4">

                        <button type="submit" name="editSubmit" style="width: 100%" class="shadow-none p-2 btn btn-dark">Bearbeiten</button>

                    </div>

                </div>
                <!-- End Col -->

            </div>
            <!-- End Row -->
            
        </form>
        <!-- End Form-->

    <?php } die(); }; ?>