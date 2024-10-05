<!-- Sets @ Brick-N:o-5, Virve Rajasärkkä 2024 -->
<?php 
  $title = 'Sets | Brick N:o 5';
  include '.settings.php';
  include 'header.php';
?>

<script>document.title = "<?php echo $title; ?>";</script>

<!-- HTML content -->
<main class="page-content inset-box">
  <!-- bread crumb trail -->
 <p class="bread-crumbs">
    <?php 
      echo '<span onclick="window.location.href=`index.php`;" role="link" class="pointer" tabindex=0>Home</span> > ';
      echo '<span>Sets</span> > ';
    ?>
  </p>

  <!-- links to set decades -->
  <section aria-labelledby="set-by-decade-heading">
    <h2 id="sets-by-decade-heading">Sets by decade</h2>

    <div class="row">

      <div id="by-decade-50s" class="cat-container pointer" role="link" tabindex="0" onclick="window.location.href='subsets.php?cat=1950s';">
        <h3>1950s</h3>
        <img src="img/sets/306-2.jpg" class="img-m">
      </div>

      <div id="by-decade-60s" class="cat-container pointer" role="link" tabindex="0" onclick="window.location.href='subsets.php?cat=1960s';">
        <h3>1960s</h3>
        <img src="img/sets/326-1.jpg" class="img-m">
      </div>

      <div id="by-decade-70s" class="cat-container pointer" role="link" tabindex="0" onclick="window.location.href='subsets.php?cat=1970s';">
        <h3>1970s</h3>
        <img src="img/sets/349-1.jpg" class="img-m">
      </div>

      <div id="by-decade-80s" class="cat-container pointer" role="link" tabindex="0" onclick="window.location.href='subsets.php?cat=1980s';">
        <h3>1980s</h3>
        <img src="img/sets/6365-1.jpg" class="img-m">
      </div>

      <div id="by-decade-90s" class="cat-container pointer" role="link" tabindex="0" onclick="window.location.href='subsets.php?cat=1990s';">
        <h3>1990s</h3>
        <img src="img/sets/6075-1.jpg" class="img-m">
      </div>

    </div>
  </section>
</main>

<?php include 'footer.php'; ?>