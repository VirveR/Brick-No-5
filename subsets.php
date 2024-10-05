<!-- Subsets @ Lego-no-5, Virve Rajasärkkä 2024 -->
<?php 
  $title = 'Sets | Brick N:o 5';
  include '.settings.php';
  include 'header.php';
  $decade = 0;
  if (isset($_GET['cat'])) { 
    $cat = $_GET['cat']; 
    $_SESSION['cat'] = $cat;
    if ($cat == '1950s' || $cat == '1960s' || $cat == '1970s' || $cat == '1980s' || $cat == '1990s')
      { $decade = intval(substr($cat, 0, 4));} 
    $title = $cat . ' sets | Brick N:o 5'; 
  }

  //get the sets
  if ($decade > 0) {
    $sql = "SELECT setid, sname, syear, sown FROM sets WHERE syear >= $decade AND syear < $decade + 10 ORDER BY syear, setid;";
  }
  else {
    $sql = "SELECT setid, sname, syear, sown FROM sets WHERE 1 ORDER BY syear, setid;";
  }
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $sets = $stmt->fetchAll();
  $stmt = null;

  for ($i = 0; $i < count($sets); $i++) {
    $sets[$i]['snumber'] = substr($sets[$i]['setid'], 0, -2);
  }
  $_SESSION['sets'] = $sets;
?>

<script>document.title = "<?php echo $title; ?>";</script>

<!-- HTML content -->
<main class="page-content inset-box">
  <!-- bread crumb trail -->
  <p class="bread-crumbs">
    <?php 
      echo '<span onclick="window.location.href=`index.php`;" role="link" class="pointer" tabindex=0>Home</span> > ';
      echo '<span onclick="window.location.href=`sets.php`;" role="link" class="pointer" tabindex=0>Sets</span> > ';
      echo '<span>' . $cat . '</span>';
    ?>
  </p>

  <?php if ($decade == 0) { $heading = 'All sets'; }
    else { $heading = $cat . ' sets'; } ?>

  <h2 id="sets-heading"><?php echo $heading; ?></h2>

  <article aria-labelledby="sets-heading">
    <section>
      <p>Categories section coming here</p>
    </section>

    <!-- table showing the sets -->
    <section>
      <table id="sets-table">

        <thead>
          <tr>
            <th>year</th>
            <th>number</th>
            <th>name</th>
            <th>own</th>
            <th></th>
          </tr>
        </thead>

        <tbody>
          <!-- add new set -->
          <tr><form id="add-set-form">
            <td><input type="number" name="add-set-year" id="add-set-year" min="1949" max="2024"></td>
            <td><input type="text" name="add-set-id" id="add-set-id" style="width:60px"></td>
            <td><input type="text" name="add-set-name" id="add-set-name" style="width:200px"></td>
            <td><input type="number" name="add-set-own" id="add-set-own" style="width:60px">
            <td><input type="submit" name="add-set-btn" id="add-set-btn" value="+"></td>
          </form></tr>
          <?php for ($i = 0; $i < count($sets); $i++) {
            echo '<tr onclick="window.location.href=`set.php?setid=' . $sets[$i]['setid'] . '`;" role="link">';
              echo '<td>' . $sets[$i]['syear'] . '</td>';
              echo '<td>' . $sets[$i]['snumber'] . '</td>';
              echo '<td>' . $sets[$i]['sname'] . '</td>';
              echo '<td>';
                if ($sets[$i]['sown'] > 999) { echo '<img src="img/check.png" class="icon">'; }
              echo '</td>';
              echo '<td></td>';
            echo '</tr>'; }
          ?>
        </tbody>

      </table>

    </section>
  </article>
</main>

<!-- script -->
<script src= "setscripts.js"></script>

<?php include 'footer.php'; ?>