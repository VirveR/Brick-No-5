<!-- Parts @ Brick-N:o-5, Virve Rajasärkkä 2024 -->
<?php 
  $title = 'Parts | Brick N:o 5';
  include '.settings.php';
  include 'header.php';

  //get the parts
  $sql = "SELECT pnumber, pdescr, pfrom, pto FROM parts1 WHERE 1 ORDER BY pdescr, pnumber;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $parts = $stmt->fetchAll();
  $stmt = null;
  $_SESSION['parts'] = $parts;

?>

<script>document.title = "<?php echo $title; ?>";</script>

<!-- HTML content -->
<div class="page-content inset-box">
  <!-- bread crumb trail -->
  <p class="bread-crumbs">
    <?php 
      echo '<span onclick="window.location.href=`index.php`;" role="link" class="pointer" tabindex=0>Home</span> > ';
      echo '<span>Parts</span>';
    ?>
  </p>

  <h2 id="parts-heading">All Parts</h2>

  <article aria-labelledby="parts-heading">

    <!-- table showing the parts -->
    <table id="parts-table">

      <thead>
        <tr>
          <th>number</th>
          <th>descr</th>
          <th>from</th>
          <th>to</th>
        </tr>
      </thead>

      <tbody>
        <?php for ($i = 0; $i < count($parts); $i++) {
          echo '<tr onclick="window.location.href=`part.php?part=' . $parts[$i]['pnumber'] . '`;" role="link">';
            echo '<td>' . $parts[$i]['pnumber'] . '</td>';
            echo '<td>' . $parts[$i]['pdescr'] . '</td>';
            echo '<td>' . $parts[$i]['pfrom'] . '</td>';
            echo '<td>' . $parts[$i]['pto'] . '</td>';
            echo '<td></td>';
          echo '</tr>'; }
        ?>

        <!-- add new part -->
        <tr><form id="add-part-form">
          <td><input type="text" name="add-part-number" id="add-part-number"></td>
          <td><input type="text" name="add-part-descr" id="add-part-descr"></td>
          <td><input type="number" name="add-part-from" id="add-part-from" min="1964" max="2024"></td>
          <td><input type="number" name="add-part-to" id="add-part-to" min="1964" max="2024"></td>
          <td><input type="submit" name="add-part-btn" id="add-part-btn" value="+"></td>
        </form></tr>

      </tbody>

    </table>

  </article>
</div>

<!-- script -->
<script>
  $(document).ready(function () {
    $('#add-part-form').on('submit', function(e) {
      e.preventDefault();
      let addPartNumber = $('#add-part-number').val();
      let addPartDescr = $('#add-part-descr').val();
      let addPartFrom = $('#add-part-from').val();
      let addPartTo = $('#add-part-to').val();
      $.ajax({
        type: 'POST',
        url: 'parthandler.php',
        data: {
          addPartNumber: addPartNumber,
          addPartDescr: addPartDescr,
          addPartFrom: addPartFrom,
          addPartTo: addPartTo
        },
        success: function(response) {
          try {
            if (response.success) {
              $('#parts-table tr:last').before(
                `<tr>
                  <td>${addPartNumber}</td>
                  <td>${addPartDescr}</td>
                  <td>${addPartFrom}</td>
                  <td>${addPartTo}</td>
                  <td><img src="img/delete.png" alt="delete row" class="icon"></td>
                </tr>`
              );
              $('#add-part-number').val('');
              $('#add-part-descr').val('');
              $('#add-part-from').val('');
              $('#add-part-to').val('');
            }
          }
          catch (error) {
            console.error('response error:', error);
          }
        },
        error: function(error) {
          console.error('ajax error: ', error);
        }
      });
    });
  });
</script>

<?php include 'footer.php'; ?>