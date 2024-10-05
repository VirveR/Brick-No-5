<!-- header @ Brick-no-5, Virve Rajasärkkä 2024 -->

<?php 
  session_start();
  $_SESSION['cur_year'] = date('Y');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <link href='https://fonts.googleapis.com/css?family=PT+Mono' rel='stylesheet'>
    <link rel="icon" href="img/title.png" type="image/icon type">
    <title><?php echo $title; ?></title>
  </head>
  
  <body>
    <!-- "whole-page" ends in footer -->
    <div class="whole-page">
    <header class="row">
      <h1 class="inset-box">Brick N:o 5</h1>
      <div class="col">
        <!-- search for sets -->
        <section id="search" role="search">
          <form class="row" action="setsearch.php" method="post">
            <label for="search-set">Search</label>
            <input type="text" name="search-set" id="search-set-name">
            <button type="submit" name="search-set-btn" id="search-set-btn"><img src="img/search.png" class="icon"></button>
          </form>
        </section>

        <!-- navigation -->
        <nav class="row">
          <p class="nav-item pointer" onclick="window.location.href='index.php';" role="link" tabindex="0">Home</p>
          <p class="nav-item pointer" onclick="window.location.href='sets.php';" role="link" tabindex="0">Sets</p>
          <p class="nav-item pointer" onclick="window.location.href='parts.php';" role="link" tabindex="0">Parts</p>
          <p class="nav-item pointer" onclick="window.location.href='collection.php';" role="link" tabindex="0">Collection</p>
          <p class="nav-item pointer" onclick="window.location.href='links.php';" role="link" tabindex="0">Links</p>
        </nav>
      </div>
    </header>
    