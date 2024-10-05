<!-- index @ Brick-no-5, Virve Rajasärkkä 2024 -->
<?php 
  $title = 'Brick N:o 5';
  include '.settings.php';
  include 'header.php';

  //get the sets
  $sql = "SELECT setid, sname, syear, sown FROM sets WHERE 1 ORDER BY syear, setid;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $sets = $stmt->fetchAll();
  $stmt = null;
  for ($i = 0; $i < count($sets); $i++) {
    $sets[$i]['snumber'] = substr($sets[$i]['setid'], 0, -2);
  }

  //store sets in session
  $_SESSION['sets'] = [];
  $_SESSION['sets'] = $sets;
?>

<!-- HTML content -->
<main class="page-content inset-box">
  <h2>...and trumpets!</h2>
  <p>Welcome to the Brick N:o 5.</p>
</main>

<?php include 'footer.php'; ?>
