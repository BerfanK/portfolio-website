<?php

session_start();

// Get the directory of the current file
$fullPath = getcwd();
$pathArray = explode(DIRECTORY_SEPARATOR, $fullPath);
$directory = $pathArray[count($pathArray) - 1];

// Redirect user to login if not logged in already!
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] === false) {

    if ($directory == 'admin')
        die ("<script>window.location.href = '../login'</script>");
    else 
        die ("<script>window.location.href = './login'</script>");

}

if ($directory == 'admin')
    include_once ("../manager/utils.php"); 
else 
    include_once ("./manager/utils.php");

$license = $_SESSION['license'];
$licenseObj = get_license($license);
$admin = $licenseObj['isAdmin'];

if ($licenseObj == null)  {

    if ($directory == 'admin')
        die ("<script>window.location.href = '../logout'</script>");
    else 
        die ("<script>window.location.href = './logout'</script>");

}

if (!$admin && $directory == 'admin') 
    die ("<script>window.location.href = '../'</script>");

?>