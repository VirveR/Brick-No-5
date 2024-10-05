<!-- Collection @ Brick-no-5, Virve Rajasärkkä 2024 -->
<?php
  $colid = 1;
  $title = 'Your Collection | Brick N:o 5';
  include '.settings.php';
  include 'header.php';

  //get available parts + versions
  $sql = "SELECT pnumber, pdescr, vversion FROM (parts1 INNER JOIN versions1 ON pnumber = vpart) WHERE 1 
    ORDER BY pdescr, vversion;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $parts = $stmt->fetchAll();
  $stmt = null;  

  //get coll part rows
  $sql = "SELECT * FROM collparts1 WHERE colid = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$colid]);
  $coparts = $stmt->fetchAll();
  $stmt = null;

?>

<!-- HTML content -->
<main class="page-content inset-box">
  <!-- bread crumb trail -->
  <p class="bread-crumbs">
    <?php 
      echo '<span onclick="window.location.href=`index.php`;" role="link" class="pointer" tabindex=0>Home</span> > ';
      echo '<span>Collection</span>';
    ?>
  </p>

  <article aria-labelledby="coll-heading">
      <h2 id="part-heading"><?php echo 'Your Collection'; ?></h2>
      <h3>Bricks, basic: 1x1</h3>
      <div class="row" style="align-items:flex-start">
      <?php $j = 0;
        for ($i = 0; $i < count($parts); $i++) {
          echo '<div>';
          echo '<h4 style="margin-bottom:5px;margin-top:20px">' . $parts[$i]['pnumber'] . '-' . $parts[$i]['vversion'] . '</h4>';
          echo '<table>';
            echo '<thead>';
              echo '<tr><th>color</th>';
              echo '<th>total</th>';
              echo '<th></th>';
              echo '<th>free</th></tr>';
            echo '</thead>';

            echo '<tbody>';
            while ($j < count($coparts) && $coparts[$j]['copart'] == $parts[$i]['pnumber'] && $coparts[$j]['coversion'] == $parts[$i]['vversion']) {
              echo '<tr><td style="width:150px"><span class="color-box ' . $coparts[$j]['cocolor'] . '"> </span>' . $coparts[$j]['cocolor'] . '</td>';
              echo '<td id="coll-part-total' . $coparts[$j]['corow'] . '">' . $coparts[$j]['cototal'] . '</td>';
              echo '<td><form class="add-coll-part-form" style="display:inline;margin-right:20px">';
                echo '<input type="number" name="add-coll-part-amount" style="width:30px">';
                echo '<input type="hidden" name="add-coll-part-total" value="' . $coparts[$j]['cototal'] . '">';
                echo '<input type="hidden" name="add-coll-part-colid" value="' . $colid . '">';
                echo '<input type="hidden" name="add-coll-part-corow" value="' . $coparts[$j]['corow'] . '">';
                echo '<input type="submit" class="add-coll-part-btn" name="add-coll-part-btn" value="+">';
              echo '</form></td>';
              echo '<td>' . $coparts[$j]['cototal'] - $coparts[$j]['coass'] . '</td></tr>';
              $j++;
            }
            echo '</tbody>';
          echo '</table>';
          echo '</div>';
        }
      ?>
      </div>

  </article>

</main>

<script src="collectionscripts.js"></script>

<?php
  include 'footer.php';
?>