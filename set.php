<!-- Set @ Brick-no-5, Virve Rajasärkkä 2024 -->
<?php
  $setid = $_GET['setid'];
  $title = $setid . ' | Brick N:o 5';
  include '.settings.php';
  include 'header.php';
  $cat = $_SESSION['cat'];

  //get next and prev sets in session sets
  function searchId($setid, $array) {
    foreach ($array as $key => $val) {
      if ($val['setid'] === $setid) {
        return $key;
      }
    }
    return null;
  }

  $sets = [];
  $sets = $_SESSION['sets'];
  $cur_index = searchId($setid, $sets);
  $prev_index = $cur_index - 1;
  $next_index = $cur_index + 1;
  
  //get this set
  $sql = "SELECT * FROM sets WHERE setid = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$setid]);
  $set = $stmt->fetch();
  $stmt = null;
  $set['snumber'] = substr($set['setid'], 0, -2);

  //get the set rows
  $sql = "SELECT * FROM (setrows INNER JOIN parts1 ON setrows.rpart = parts1.pnumber) WHERE setrows.rsetid = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$setid]);
  $rows = $stmt->fetchAll();
  $stmt = null;

  //get era appropriate parts
  $sql = "SELECT pnumber, pdescr FROM parts1 WHERE pfrom <= ? AND pto >= ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$set['syear'], $set['syear']]);
  $parts = $stmt->fetchAll();
  $stmt = null;

  //get era appropriate colors
  $sql = "SELECT ccolor FROM colors WHERE cfrom <= ? AND cto >= ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$set['syear'], $set['syear']]);
  $colors = $stmt->fetchAll();
  $stmt = null;

  $title = $set['snumber'] . ' ' . $set['sname'] . ' | Brick N:o 5';

?>

<script>document.title = "<?php echo $title; ?>";</script>

<!-- HTML content -->
<main class="page-content inset-box">
  <!-- bread crumb trail -->
  <p class="bread-crumbs">
    <?php 
      echo '<span onclick="window.location.href=`index.php`;" role="link" class="pointer" tabindex=0>Home</span> > ';
      echo '<span onclick="window.location.href=`sets.php`;" role="link" class="pointer" tabindex=0>Sets</span> > ';
      echo '<span onclick="window.location.href=`subsets.php?cat=' . $cat . '`"; role="link" class="pointer" tabindex=0>' . $cat . '</span> > ';
      echo $set['snumber'] . ' ' . $set['sname']; 
    ?>
  </p>

  <!-- links to previous and next set -->
  <div class="row next">
    <?php 
      if ($prev_index >= 0) {
        echo '<p onclick="window.location.href=`set.php?setid=' . $sets[$prev_index]['setid'] . '`;" role="link" class="pointer" tabindex=0>
          &#x2B9C; Previous set: ' . $sets[$prev_index]['snumber'] . ' ' . $sets[$prev_index]['sname'] . '</p>';
      }
      else { echo '<p></p>'; }
      if ($next_index < count($_SESSION['sets'])) {
        echo '<p onclick="window.location.href=`set.php?setid=' . $sets[$next_index]['setid'] . '`;" role="link" class="pointer" tabindex=0>
          Next set: ' . $sets[$next_index]['snumber'] . ' ' . $sets[$next_index]['sname'] . ' &#x2B9E;</p>';
      }
      else { echo '<p></p>'; }
    ?>
  </div>

  <article aria-labelledby="set-heading">

    <!-- set details -->
    <section class="row" id="set-details-sec" aria-label="set-details">
      <img src="img/sets/<?php echo $set['setid']; ?>.jpg" alt="boxfront of the set" class="set-img">

      <div class="col" id="set-info">
        <h2 id="set-heading"><?php echo $set['snumber'] . ': ' . $set['sname']; ?></h2>
        <h3><?php echo $set['syear']; ?></h3>

        <?php include 'setdetails.php'; ?>

      </div>
    </section>

    <!-- set contents -->
    <section id="set-content" aria-labelledby="set-content-heading">
      <h2 id="set-content-heading">Set Contents</h2>

      <?php include 'setcontent.php'; ?>

    </section>
  </article>
</main>

<!-- script -->
<script src= "setscripts.js"></script>
<script src= "commonscripts.js"></script>

<?php include 'footer.php'; ?>