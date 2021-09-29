<?php

if (isset($_POST["submit"])) {
    
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
    $files = $_FILES;

    create_project($title, $tags, $description, $startDate, $endDate, $developer, $version, $workplace, $professor, $type, $difficulty, $downloadUrl, $githubUrl, $files, $private);
    
}

?>