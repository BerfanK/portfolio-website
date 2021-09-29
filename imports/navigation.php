<?php
$path = substr($_SERVER['SCRIPT_NAME'], 1);
$file = basename($path, ".php");

$loggedIn = false;
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) $loggedIn = true;

$isAdmin = 0;
if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1) $isAdmin = 1;

// Get the directory of the current file
$fullPath = getcwd();
$pathArray = explode(DIRECTORY_SEPARATOR, $fullPath);
$directory = $pathArray[count($pathArray) - 1];
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item" style="margin: 0 !important">
                    <a class="nav-link ps-n5 <?php if ($file == 'index') echo 'current'; ?>" href="./<?php if ($directory == 'admin') echo "index"; ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($file == 'projects' || $file == 'project') echo 'current'; ?>" href="./projects">Projekte</a>
                </li>
                <?php if ($directory != 'admin') { ?>
                <li class="nav-item">
                    <a class="nav-link <?php if ($file == 'cv') echo 'current'; ?>" href="./cv">Lebenslauf</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($file == 'contact') echo 'current'; ?>" href="./contact">Kontakt</a>
                </li>
                <?php
                } else {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($file == 'licenses') echo 'current'; ?>" href="./licenses">Lizenzen</a>
                    </li>
                    <?php
                }

                if ($isAdmin && $directory != 'admin') {
                    echo
                    '
                    <li class="nav-item">
                        <a class="nav-link" href="./admin/index"><i class="fas fa-user-shield" style="font-size: 17px;"></i>&nbsp; Admin</a>
                    </li>
                    ';
                } else if ($isAdmin && $directory == 'admin') {
                    echo
                    '
                    <li class="nav-item">
                        <a class="nav-link" href="../"><i class="fas fa-user" style="font-size: 17px;"></i>&nbsp; User</a>
                    </li>
                    ';
                }

                ?>
            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php 

                $currentLogin = "current";
                if ($file !== 'login') $currentLogin = "";
                if (!$loggedIn) {
                    echo 
                    '
                    <li class="nav-item">
                        <a class="nav-link ' . $currentLogin . '" href="./login">Anmelden</a>
                    </li>
                    ';
                } else {
                    echo 
                    '
                    <li class="nav-item">
                        <a class="nav-link" href="./logout">Abmelden</a>
                    </li>
                    ';
                }

                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-user-circle"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="./deactivate"><?php if($loggedIn) echo 'Lizenz deaktivieren'; else echo '---'; ?></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>