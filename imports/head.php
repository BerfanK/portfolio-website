<?php 

// Get the directory of the current file
$fullPath = getcwd();
$pathArray = explode(DIRECTORY_SEPARATOR, $fullPath);
$directory = $pathArray[count($pathArray) - 1];

// Include the database
if ($directory == 'admin')
    include_once ("../manager/utils.php");
else 
    include_once ("./manager/utils.php");

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="Berfan Korkmaz" />
    <meta property="og:description" content="Sie brauchen eine Lizenz um den Inhalt zu sehen.">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.berfan-korkmaz.ch/">
    <meta name="msapplication-TitleColor" content="#0000FF">
    <meta name="theme-color" content="#0000FF">

    <meta property="og:image" content="https://ibb.co/yN8B1GG" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@berfankorkmaz">
    <meta name="twitter:creator" content="@berfankorkmaz">

    <link rel="apple-touch-icon" sizes="180x180" href="<?php if ($directory == 'admin') echo "../"; ?>assets/icons/apple-touch-icon-180x180.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php if ($directory == 'admin') echo "../"; ?>assets/icons/favicon-32x32.ico">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php if ($directory == 'admin') echo "../"; ?>assets/icons/favicon-96x96.png">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="<?php if ($directory == 'admin') echo "../"; ?>assets/css/style.css" rel="stylesheet">

    <title>Portfolio Template<title>
</head>