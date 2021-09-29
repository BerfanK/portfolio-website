<?php

/**
 * @author Berfan Korkmaz
 * @link https://github.com/BerfanK
 * @version 1.0.0
 */


// Get the directory of the current file
$fullPath = getcwd();
$pathArray = explode(DIRECTORY_SEPARATOR, $fullPath);
$directory = $pathArray[count($pathArray) - 1];

// Include the database
if ($directory == 'admin')
    include_once ("../imports/database.php");
else 
    include_once ("./imports/database.php");


/**
 * @param message Prints an success Bootstrap alert
 */
function print_success($message) {
    echo
    '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><i class="far fa-check-circle"></i></strong> '. $message . '
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
}

/**
 * @param message Prints an danger Bootstrap alert
 */
function print_danger($message) {
    echo
    '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class="far fa-times-circle"></i></strong> '. $message . '
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
}

/**
 * @param location Where it should redirect to.
 */
function redirect_timeout($location) {
    echo 
    '
    <script>
    window.setTimeout(() => {
        window.location.href = "'. $location .'";
    }, 5000);
    </script>
    ';
}

/**
 * {@link login.php} This function handles the login.
 * @param license The license the user is loging in with.
 */
function login($license) {
    global $conn; // database connection

    $licenseObj = get_license($license);

    if ($licenseObj != null) { // License exists!

        if (!is_license_expired($license)) { // License has not expired!

            if (!is_license_full($license)) { // License is not full!

                add_license_count($license);
                $_SESSION["logged_in"] = true;
                $_SESSION["license"] = $license;
                $_SESSION["is_admin"] = $licenseObj['isAdmin'];

                print_success("Sie sind nun angemeldet. Sie werden in 5 Sekunden weitergeleitet!");
                redirect_timeout("./");
            

            } else { // License has reached uses limit!
                print_danger("Die Lizenz hat die maximale Anzahl an Nutzungen erreicht.");
            }

        } else { // License expired!
            print_danger("Die Lizenz ist abgelaufen.");
        }

    } else { // License does not exist!
        print_danger("Diese Lizenz existiert nicht.");
    }

}

/**
 * This function generates a token.
 */
function generate_token($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

/**
 * This function creates a license.
 */
function create_license($days = 30, $email = null, $uses = 0, $admin = 0) {
    global $conn; // database connection

    $newDate = date('y-m-d', time() + ($days * 86400));
    $timestamp = strtotime($newDate);
    if ($days == 0) $timestamp = -1;
    $license = generate_token(25);

    $statement = $conn->prepare("INSERT INTO license (token, email, expireDate, usesLimit, isAdmin) VALUES(?, ?, ?, ?, ?)");
    $statement->bind_param("sssii", $license, $email, $timestamp, $uses, $admin);
    $statement->execute();

    return $license;
}

/**
 * This function gets all license datas.
 * @param license The license you need information from.
 */
function get_license($license) {
    global $conn; // database connection

    $statement = $conn->prepare("SELECT * FROM license WHERE token = ?");
    $statement->bind_param("s", $license);
    $statement->execute();

    $result = $statement->get_result();

    if ($result->num_rows == 0) return null;
    else return $result->fetch_assoc();
}

/**
 * This function gets gets the license by id.
 * @param id The id of the license
 */
function get_license_by_id($licenseId) {
    global $conn; // database connection

    $statement = $conn->prepare("SELECT token FROM license WHERE id = ?");
    $statement->bind_param("s", $licenseId);
    $statement->execute();

    $result = $statement->get_result();

    if ($result->num_rows == 0) return null;
    $row = $result->fetch_assoc();

    return $row["token"];
}

/**
 * This function gets all licenses.
 */
function get_licenses() {
    global $conn; // database connection

    $statement = $conn->prepare("SELECT * FROM license");
    $statement->execute();

    return $statement->get_result();
}

/**
 * This function deletes a license
 * @param licenseId The id of the license
 */
function delete_license($licenseId) {
    global $conn; // database connection

    $statement = $conn->prepare("DELETE FROM license WHERE id = ?");
    $statement->bind_param("s", $licenseId);
    $statement->execute();
}

/**
 * {@link login.php} This function checks if the license expired.
 * @param license The license that should be checked.
 */
function is_license_expired($license) {
    global $conn; // database connection

    $row = get_license($license);
    $licenseExpire = $row['expireDate'];

    $currentDate = new DateTime();
    $currentTimestamp = $currentDate->getTimestamp(); 

    if ($licenseExpire == -1) return false;
    return $currentTimestamp > $licenseExpire;
}


/**
 * {@link login.php} This function checks if the license uses limit has been reached.
 * @param license The license that should be checked.
 */
function is_license_full($license) {
    global $conn; // database connection

    $row = get_license($license);
    $licenseUses = $row['uses'];
    $licenseLimit = $row['usesLimit'];

    if ($licenseLimit == null || $licenseLimit == 0) return false;
    return $licenseUses >= $licenseLimit;
}

/**
 * {@link login.php} This function adds a count on a license.
 * @param license The license the count should be updated in.
 */
function add_license_count($license) {
    global $conn; // database connection

    $row = get_license($license);
    $count = $row['uses'] + 1;

    $statement = $conn->prepare("UPDATE license SET uses = ? WHERE token = ?");
    $statement->bind_param("is", $count, $license);
    return $statement->execute();
}

/**
 * {@link projects.php} This function gets all projects with limited data.
 */
function get_project_embeds() {
    global $conn; // database connection

    $query = "SELECT p.*, tc.tags FROM project p 
              LEFT JOIN (SELECT t.projectId, GROUP_CONCAT(t.tag) AS tags FROM project_tags t GROUP BY t.projectId) tc ON tc.projectId = p.id";

    $statement = $conn->prepare($query);
    $statement->execute();

    return $statement->get_result();
}

/**
 * This function provides information about a project.
 * @param projectId The project you need information from.
 */
function get_project($projectId) {
    global $conn; // database connection

    $query = "SELECT p.*, tc.tags, ic.images FROM project p 
    LEFT JOIN (SELECT t.projectId, GROUP_CONCAT(t.tag) AS tags FROM project_tags t GROUP BY t.projectId) tc ON tc.projectId = p.id
    LEFT JOIN (SELECT i.projectId, GROUP_CONCAT(i.imageToken) AS images FROM project_images i GROUP BY i.projectId) ic ON ic.projectId = p.id
    WHERE p.id = ?";

    $statement = $conn->prepare($query);
    $statement->bind_param("i", $projectId);
    $statement->execute();

    $result = $statement->get_result();

    if ($result->num_rows == 0) return null;
    else return $result->fetch_assoc();
}

/**
 * This function gets the image description.
 * @param imageId The id of the image.
 */
function get_image_description($imageId) {
    global $conn; // database connection

    $statement = $conn->prepare("SELECT imageDescription FROM project_images WHERE id = ?");
    $statement->bind_param("i", $imageId);
    $statement->execute();

    $result = $statement->get_result();

    if ($result->num_rows == 0) return null;
    $row = $result->fetch_assoc();
    return $row['imageDescription'];
}

/**
 * This function gets the amount of public projects.
 */
function get_public_projects() {
    global $conn; // database connection

    $statement = $conn->prepare("SELECT COUNT(id) FROM project WHERE private = 0");
    $statement->execute();

    $result = $statement->get_result();

    if ($result->num_rows == 0) return 0;
    $row = $result->fetch_assoc();
    return $row['COUNT(id)'];
}

/**
 * This function creates a project.
 * @param title The title of the project
 * @param tags The tags of the project
 * @param description The description of the project
 * @param startDate The date when the project started
 * @param endDate The date when the project was finished
 * @param developer The developer of the project
 * @param version The version of the project
 * @param workplace The place you worked on the project
 * @param professor The teacher that helped you through the project
 * @param type The type of the project (School, Freetime, Job)
 * @param difficulty The difficulty of the project (Easy, Middle, Hard)
 * @param downloadUrl The download url of the project
 * @param githubUrl The github url of the project
 * @param files The screenshot files of the project
 * @param private Whether the project is public 
 */
function create_project($title, $tags, $description, $startDate, $endDate, $developer, $version, $workplace, $professor, $type, $difficulty, $downloadUrl, $githubUrl, $files, $private) {
    global $conn; // database connection

    $date = date('Y-m-d H:i:s');
    $timestamp = strtotime($date);

    $statement = $conn->prepare("INSERT INTO project (title, description, startDate, endDate, releaseDate, developer, version, workplace, professor, type, difficulty, downloadUrl, githubUrl, private) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $statement->bind_param("sssssssssiissi", $title, $description, $startDate, $endDate, $timestamp, $developer, $version, $workplace, $professor, $type, $difficulty, $download, $github, $private);
    
    if ($statement->execute()) {
        echo 
        '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-check"></i> Projekt wurde erfolgreich erstellt!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    } else {
        echo 
        '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-times"></i> Es gab einen Fehler beim Erstellen des Projekts!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
        return;
    }

    $projectId = $conn->insert_id;

    foreach($tags as $tag) {
        $statement = $conn->prepare("INSERT INTO project_tags(projectId, tag) VALUES(?, ?)");
        $statement->bind_param("is", $projectId, $tag);
        $statement->execute();
    }

    $_FILES = $files;
    $fileCount = count($_FILES['file']['name']);
    
    $filesArray = $_FILES['file']['name'];
    $filesArray = array_filter($filesArray);

    if (!empty($filesArray)) {
        $cdnDirectory = "/screenshots/";
        
        for($i = 0; $i < $fileCount; $i++){
            $imageName = uniqid();

            $sourcePath = $_FILES['file']['tmp_name'][$i];
            $extension = pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION);
            $targetPath = dirname(getcwd()) .$cdnDirectory.$imageName. "." .$extension;
            move_uploaded_file($sourcePath, $targetPath) or die("Can't move file: " . $_FILES["file"]["error"][$i]);

            $imageToken = $imageName . "." . $extension;

            $statement = $conn->prepare("INSERT INTO project_images(projectId, imageToken) VALUES(?, ?)");
            $statement->bind_param("is", $projectId, $imageToken);
            $statement->execute();

        }

    }

}

/**
 * This function updates an existing project.
 * @param projectId The id of the project that should be updated
 * @param title The title of the project
 * @param tags The tags of the project
 * @param description The description of the project
 * @param startDate The date when the project started
 * @param endDate The date when the project was finished
 * @param developer The developer of the project
 * @param version The version of the project
 * @param workplace The place you worked on the project
 * @param professor The teacher that helped you through the project
 * @param type The type of the project (School, Freetime, Job)
 * @param difficulty The difficulty of the project (Easy, Middle, Hard)
 * @param downloadUrl The download url of the project
 * @param githubUrl The github url of the project
 * @param files The screenshot files of the project
 * @param private Whether the project is public 
 */
function update_project($projectId, $title, $tags, $description, $startDate, $endDate, $developer, $version, $workplace, $professor, $type, $difficulty, $downloadUrl, $githubUrl, $private) {
    global $conn; // database connection

    $statement = $conn->prepare("UPDATE project SET title = ?, description = ?, startDate = ?, endDate = ?, developer = ?, version = ?, workplace = ?, professor = ?, type = ?, difficulty = ?, downloadUrl = ?, githubUrl = ?, private = ? WHERE id = ?");
    $statement->bind_param("ssssssssiissii", $title, $description, $startDate, $endDate, $developer, $version, $workplace, $professor, $type, $difficulty, $download, $github, $private, $projectId);
    
    if ($statement->execute()) {
        echo 
        '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-check"></i> Projekt wurde erfolgreich bearbeitet!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    } else {
        echo 
        '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-times"></i> Es gab einen Fehler beim Bearbeiten des Projekts!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
        return;
    }

    $statement = $conn->prepare("DELETE FROM project_tags WHERE projectId = ?");
    $statement->bind_param("i", $projectId);
    $statement->execute();

    foreach($tags as $tag) {
        $statement = $conn->prepare("INSERT INTO project_tags(projectId, tag) VALUES(?, ?)");
        $statement->bind_param("is", $projectId, $tag);
        $statement->execute();
    }
}

/**
 * This function deletes a project.
 * @param projectId The project that should be removed
 */
function delete_project($projectId) {
    global $conn; // database connection

    $statement = $conn->prepare("DELETE FROM project WHERE id = ?");
    $statement->bind_param("s", $projectId);
    $statement->execute();
}

?>