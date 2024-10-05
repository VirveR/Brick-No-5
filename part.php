<!-- Part @ Brick-no-5, Virve Rajasärkkä 2024 -->
<?php
  $pnumber = $_GET['part'];
  $colid = 1;
  $title = 'Part n:o ' . $pnumber . ' | Brick N:o 5';
  include '.settings.php';
  include 'header.php';

  //get this part
  $sql = "SELECT * FROM parts1 WHERE pnumber = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$pnumber]);
  $part = $stmt->fetch();
  $stmt = null;

  //get versions
  $sql = "SELECT * FROM versions1 WHERE vpart = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$pnumber]);
  $versions = $stmt->fetchAll();
  $stmt = null;

  //get coll part rows
  $sql = "SELECT * FROM collparts1 WHERE colid = ?;";
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
      echo '<span onclick="window.location.href=`parts.php`;" role="link" class="pointer" tabindex=0>Parts</span> > ';
      echo $pnumber; 
    ?>
  </p>

  <article aria-labelledby="part-heading">
    <section class="col" aria-label="part-details">
      <h2 id="part-heading"><?php echo $part['pnumber'] . ': ' . $part['pdescr'] . ' basic brick'; ?></h2>

      <!-- versions -->
      <?php 
      $j = 0;
        for ($i = 0; $i < count($versions); $i++) {
          //version headers
          echo '<h3>' . $versions[$i]['vpart'] . '-' . $versions[$i]['vversion'] . '</h3>';
          echo '<h4 style="margin:0">from ' . $versions[$i]['vfrom'] . ' to c. ' . $versions[$i]['vto'] . '</h4>';
          //version container
          echo '<div class="part-version-container row">';
            //version images -half
            echo '<div class="col" style="max-width:400px">';
              //first img + info
              echo '<div class="part-version-imgs row">';
                echo '<img src="img/parts/' . $versions[$i]['vsideimg'] . '.png">';
                echo '<div class="col part-version-info">';
                  echo '<h4>outside</h4>';
                  echo '<p>injection mark: ' . $versions[$i]['vpip'] . '</p>';
                  echo '<p>logo: ' . $versions[$i]['vlogo'] . '</p>';
                echo '</div>';
              echo '</div>';
              //second img + info
              echo '<div class="part-version-imgs row">';
                echo '<img src="img/parts/' . $versions[$i]['vinnimg'] . '.png">';
                echo '<div class="col part-version-info">';
                  echo '<h4>inside</h4>';
                  echo '<p>structures: ' . $versions[$i]['vinner'] . '</p>';
                echo '</div>';
              echo '</div>';
              //third img + info
              echo '<div class="part-version-imgs row">';
                echo '<img src="img/parts/' . $versions[$i]['vbotimg'] . '.png">';
                echo '<div class="col part-version-info">';
                  echo '<h4>at the bottom</h4>';
                  echo '<p>markings: ' . $versions[$i]['vmark'] . '</p>';
                  echo '<p>mold identifier: ' . $versions[$i]['vmold'] . '</p>';
                  echo '<p>inside stud cavity: ' . $versions[$i]['vcavity'] . '</p>';
                echo '</div>';
              echo '</div>';
              if ($versions[$i]['vcomment']) {
                echo '<div class="part-version-imgs row">';
                  //comments
                  echo '<img src="img/warning.png">';
                  echo '<div class="col part-version-info">';
                    echo '<h4>comments</h4>';
                    echo '<p>' . $versions[$i]['vcomment'] . '</p>';
                  echo '</div>';
                echo '</div>';
              }
            echo '</div>';
            //second half - colors
            echo '<div class="part-version-imgs col" style="margin:20px">';
              echo '<table>';
                echo '<thead>';
                  echo '<tr><th>color</th>';
                  echo '<th>total</th>';
                  echo '<th></th>';
                  echo '<th>free</th></tr>';
                echo '</thead>';
                echo '<tbody>';
                  while ($j < count($coparts) && $coparts[$j]['coversion'] == $versions[$i]['vversion']) {
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
          echo '</div>';        
        }
      ?>
    </section>
  </article>

</main>

<?php
  include 'footer.php';
?>