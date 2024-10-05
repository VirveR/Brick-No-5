<h3>Bricks, basic</h3>

<!-- table view -->
<table id="content-table">
  <thead><tr>
    <th>#</th>
    <th>number</th>
    <th>descr.</th>
    <th>color</th>
    <th>needs</th>
    <th>has</th>
    <th></th>
  </tr></thead>
  <tbody>
    <?php 
      for ($i = 0; $i < count($rows); $i++) {
        echo '<tr>';
          echo '<td>' . $rows[$i]['rnumber'] . '</td>';
          echo '<td>' . $rows[$i]['rpart'] . '</td>';
          echo '<td>' . $rows[$i]['pdescr'] . '</td>';
          echo '<td><span class="color-box ' . $rows[$i]['rcolor'] . '"> </span>' . $rows[$i]['rcolor'] . '</td>';
          echo '<td>' . $rows[$i]['rneeds'] . '</td>';
          echo '<td>' . $rows[$i]['rhas'] . '</td>';
          echo '<td><img src="img/delete.png" alt="delete row" class="delete-btn icon" row-setid="' . $setid . '" row-number="' . $rows[$i]['rnumber'] . '"></td>';
        echo '</tr>';
      }
    ?>
    <!-- add new row -->
    <tr><form id="add-row-form">
      <td>#</td>
      <td><select id="add-row-part" name="add-row-part">
        <?php for ($i = 0; $i < count($parts); $i++) { echo '<option value="' . $parts[$i]['pnumber'] . '">' . $parts[$i]['pnumber'] . '</option>'; } ?>
      </select></td>
      <td>...</td>
      <td><select id="add-row-color" name="add-row-color">
        <?php for ($i = 0; $i < count($colors); $i++) { echo '<option value="' . $colors[$i]['ccolor'] . '">' . $colors[$i]['ccolor'] . '</option>'; } ?>
      </select></td>
      <td><input type="number" id="add-row-needs" name="add-row-needs" style="width:30px" value="1"></td>
      <td><input type="number" id="add-row-has" name="add-row-has" style="width:30px"></td>
      <td>
        <input type="hidden" name="add-row-setid" id="add-row-setid" value="<?php echo $setid ?>">
        <input type="submit" name="add-row-btn" id="add-row-btn" value="+"></td>
    </form></tr>
  </tbody>
</table>