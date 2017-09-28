<?php 
    $host = $_SERVER['HTTP_HOST'];
    $folder = "/lancer";
    $mainPath = $host.$folder
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

   
    <title>Courses</title>
</head>
<body>
<nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="//<?=$mainPath?>/courses">Courses</a></li>
        <li><a href="//<?=$mainPath?>/students">Students</a></li>
        <li><a href="//<?=$mainPath?>/lecturers">Lecturers</a></li>
      </ul>
    </div>
  </nav>
<div class="container">

