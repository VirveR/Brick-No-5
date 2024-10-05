<!-- set search @ Lego-no-5, Virve Rajasärkkä 2024 -->
<?php 
  $title = 'Search results | Lego no 5';
  include '.settings.php';
  include 'header.php';

  //gather the search terms
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search-set-btn'])) {
    if (!(empty($_POST['search-set']))) {
      $search = '%' . trim($_POST['search-set']) . '%';
    }
    else {
      $search = '%';
    }
  }

  //get results
  $sql = "SELECT setid, sname, syear, sown FROM sets WHERE sname LIKE ? OR setid LIKE ? ORDER BY syear, setid;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$search, $search]);
  $sets = $stmt->fetchAll();
  $stmt = null;
  unset($_POST);
?>

<!-- HTML content -->
<main class="page-content inset-box">
  <h2 id="sets-heading">Search results</h2>
  <article aria-labelledby="search-heading">

    <!-- table showing the sets -->
    <table id="searched-sets-table">

      <thead>
        <tr>
          <th>year</th>
          <th>id</th>
          <th>name</th>
          <th>own</th>
          <th></th>
        </tr>
      </thead>

      <tbody>
        <?php for ($i = 0; $i < count($sets); $i++) {
          echo '<tr onclick="window.location.href=`set.php?setid=' . $sets[$i]['setid'] . '`;" role="link">';
            echo '<td>' . $sets[$i]['syear'] . '</td>';
            echo '<td>' . $sets[$i]['setid'] . '</td>';
            echo '<td>' . $sets[$i]['sname'] . '</td>';
            echo '<td>';
              if ($sets[$i]['sown'] > 1000) { echo '<img src="img/check.png" class="icon">'; }
            echo '</td>';
            echo '<td></td>';
          echo '</tr>'; }
        ?>
      </tbody>

    </table>

  </article>
</main>

<?php include 'footer.php'; ?>