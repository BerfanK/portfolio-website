<?php

if (isset($_GET["delete"])) {
    
    $projectId = $_GET["delete"];
    if (get_project($projectId) != null) {

        delete_project($projectId);

        echo 
        '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-check"></i> Projekt wurde erfolgreich gelöscht!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';

    } else {

        echo 
        '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-times"></i> Es gab einen Fehler beim Löschen des Projekts!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';

    }
}

?>