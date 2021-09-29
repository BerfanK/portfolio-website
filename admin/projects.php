<!DOCTYPE html>
<html lang="en">

<?php include "../manager/authentication.php"; ?>
<?php include "../imports/head.php" ?>
<?php include_once("../manager/utilities.php"); ?>

<body>
    
    <?php include "../imports/navigation.php" ?>

    <div class="container mt-5">

        <a href="./index" class="go-back"><i class="fas fa-arrow-circle-left"></i>&nbsp; Zurück zur Startseite</a>

        <!-- Card -->
        <div class="card embed-dark mt-3">
            <div class="card-body">

                <span class="h2 projects-title">Projektverwaltung</span><br>
                <span class="projects-text">Hier können Sie ein Projekt erstellen resp. verwalten.</span>

            </div>
        </div>
        <!-- End Card -->

        <hr class="hr" />

        <?php

        /**
         * This field handles all the post submits.
         */

         include_once "./action/create_project.php"; // [POST] checks for project creations.
         include_once "./action/delete_project.php"; // [GET] checks for project deletions.
         include_once "./action/edit_project.php"; // [GET, POST] checks for project edits. 

        ?>

        <!-- Form -->
        <form class="mt-5 needs-validation" method="POST" enctype="multipart/form-data">

            <!-- Row -->
            <div class="row">

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="title" class="mb-1"><b>Name des Projekts <span class="text-danger">*</span></b></label>
                        <input type="text" id="title" name="title" class="form-control shadow-none p-2" placeholder="z.B. Project eBanking" required>
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
                        <input type="text" id="tags" name="tags" class="form-control shadow-none p-2" placeholder="z.B. C# ASP.NET Desktop-Applikation" required>
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
                        <textarea spellcheck="false" id="description" maxlength="1200" name="description" class="form-control shadow-none p-2" style="resize: none;" placeholder="Hier Ihre Nachricht eingeben..." col="30" rows="7" required></textarea>
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
                        <input type="date" id="startDate" name="startDate" class="form-control shadow-none p-2">

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="endDate" class="mb-1"><b>Startdatum</b></label>
                        <input type="date" id="endDate" name="endDate" class="form-control shadow-none p-2">

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="developer" class="mb-1"><b>Entwickler</b></label>
                        <input type="text" id="developer" name="developer" class="form-control shadow-none p-2" placeholder="z.B. Max Mustermann">

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="version" class="mb-1"><b>Version</b></label>
                        <input type="text" id="version" name="version" class="form-control shadow-none p-2" placeholder="z.B. v1.0.0">

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="workplace" class="mb-1"><b>Arbeitsplatz</b></label>
                        <input type="text" id="workplace" name="workplace" class="form-control shadow-none p-2" placeholder="z.B. Schule">

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="professor" class="mb-1"><b>Professor</b></label>
                        <input type="text" id="professor" name="professor" class="form-control shadow-none p-2" placeholder="z.B. Maximilian Musterman">

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="type" class="mb-1"><b>Art</b></label>
                        <select id="type" name="type" class="form-control shadow-none p-2">
                            <option value="0" selected>Schule</option>
                            <option value="1">Freizeit</option>
                            <option value="2">Arbeit</option>
                        </select>

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="difficulty" class="mb-1"><b>Schwierigkeit</b></label>
                        <select id="difficulty" name="difficulty" class="form-control shadow-none p-2">
                            <option value="0" selected>Leicht</option>
                            <option value="1">Mittel</option>
                            <option value="2">Schwierig</option>
                        </select>

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="download" class="mb-1"><b>Download</b></label>
                        <input type="text" id="download" name="download" class="form-control shadow-none p-2" placeholder="z.B. https://shaare.it/ufihaif">

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="github" class="mb-1"><b>GitHub</b></label>
                        <input type="text" id="github" name="github" class="form-control shadow-none p-2" placeholder="z.B. https://github.com/BerfanK/portfolio">

                    </div>
                
                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-12  mx-0">

                    <div class="form-group mb-4">

                        <label for="file" class="mb-1"><b>Screenshots</b></label>

                        <input type="file" id="file" name="file[]" class="form-control shadow-none p-2" multiple>

                    </div>

                </div>
                <!-- End Col -->

                 <!-- Col -->
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-0">

                    <div class="form-group mb-4">

                        <label for="public" class="mb-1"><b>Sichtbarkeit</b></label>
                        <div class="form-check">
                            <input class="form-check-input shadow-none" value="0" type="radio" name="private" id="public" checked>
                            <label class="form-check-label" for="public">
                                <i class="fas fa-globe-americas"></i>&nbsp; Öffentlich
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input shadow-none" value="1" type="radio" name="private" id="private">
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

                        <button type="submit" name="submit" style="width: 100%" class="shadow-none p-2 btn btn-dark">Erstellen</button>

                    </div>

                </div>
                <!-- End Col -->

            </div>
            <!-- End Row -->
            
        </form>
        <!-- End Form-->

        <?php

        $projects = get_project_embeds();
        if ($projects->num_rows != 0) {

            echo '<hr class="hr" />';
            echo '<div class="row mb-5">';

            while ($row = $projects->fetch_assoc()) {
                $id = $row['id'];
                $type = $row['type'];
                $title = $row['title'];
                $tags = explode(',', $row['tags']);
                $private = ($row['private'] == 1) ? true : false;

                $typeHtml = "<span class='tag-school' data-bs-toggle='tooltip' data-bs-placement='top' title='Schulprojekt'><i class='fas fa-graduation-cap'></i></span>";
                if ($type === 1) $typeHtml = "<span class='tag-free' data-bs-toggle='tooltip' data-bs-placement='top' title='Freizeitprojekt'><i class='fab fa-centercode'></i></span>";

                $statusHtml = '<span class="tag-status" data-bs-toggle="tooltip" data-bs-placement="top" title="Privat"><i class="fas fa-lock"></i></span>';
                if (!$private) $statusHtml = '<span class="tag-status" data-bs-toggle="tooltip" data-bs-placement="top" title="Öffentlich"><i class="fas fa-globe-americas"></i></span>';

                $titleHtml = truncate($title, 40);

                $tagHtml = "";
                foreach ($tags as $tag) {
                    $tagHtml .= getTagString($tag);

                }
            

            ?>

            <!-- Project Col -->
            <div class="col-lg-6 col-xl-6 col-sm-12 col-md-12 mb-3">

                <!-- End Card -->
                <div class="card">
                    <div class="card-body">

                        <?=$typeHtml?>
                        <?=$tagHtml?>
                        <?=$statusHtml?>

                        <br>

                        <span class="embed-title"><?=$titleHtml?></span><br>
                        <a href="../project?id=<?=$id?>" class="embed-link"><i class="far fa-arrow-alt-circle-right"></i>&nbsp; Mehr Details</span></a>
                        <a href="./projects?delete=<?=$id?>" class="embed-link text-danger me-3"><i class="fas fa-trash-alt"></i>&nbsp; Löschen</span></a>
                        <a href="./projects?edit=<?=$id?>" class="embed-link text-secondary me-3"><i class="fas fa-edit"></i>&nbsp; Bearbeiten</span></a>

                    </div>
                </div>
                <!-- Card -->

            </div>
            <!-- End Project Col -->

    <?php } } ?>




    </div>

</body>
</html>