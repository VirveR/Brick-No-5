<!-- set own -->
<div style="display:flex;align-items:center;position:relative">
  <?php 
    echo '<div id="sown-stmt" class="info-line-cont">';
      $sownstmt = 'Not marked own yet';
      if ($set['sown'] == 1000) {
        $sownstmt = 'Own since childhood';
      }
      else if ($set['sown'] == 1900 || $set['sown'] == 3000) {
        $sownstmt = 'Own since when?';
      }
      else if ($set['sown'] > 1900) {
        $sownstmt = 'Own since ' . $set['sown'];
      }
      if ($set['sown'] > 0) { 
        echo '<img src="img/check.png" class="icon">';
        echo '<p class="info-line">' . $sownstmt . '</p>';
      }
      else {
        echo '<img src="img/no.png" class="icon">';
        echo '<p class="info-line">' . $sownstmt . '</p>';
      }
    echo '</div>';
  ?>
          
  <!-- edit set own -->
  <img src="img/edit.png" alt="edit own" class="open-btn icon pointer" toggle="edit-box-set-own">
  <div class="openable pop-form" id="edit-box-set-own">
    <img src="img/close.png" alt="close pop-up" class="close-btn icon pointer" toggle="edit-box-set-own">  
    <h4>edit set own</h4>
    <form id="edit-set-own-form" style="font-size:0.8em">
      <input type="radio" name="edit-set-own" class="edit-set-own" value="0">
      <label for="edit-sown-no">I don't own this</label><br>
      <input type="radio" name="edit-set-own" class="edit-set-own" value="1000">
      <label for="edit-sown-child">Own since childhood</label><br>
      <input type="radio" name="edit-set-own" class="edit-set-own" value="1900">
      <label for="edit-sown-adult">Own since I don't know when</label><br>
      <input type="radio" name="edit-set-own" class="edit-set-own" value="3000">
      <label for="edit-set-own">Own since </label>
      <label for="edit-set-own">year </label><input type="number" min="1900" max="<?php echo $_SESSION['cur_year']; ?>" name="edit-set-own-year" id="edit-set-own-year"><br>
      <input type="hidden" name="edit-sown-setid" id="edit-sown-setid" value="<?php echo $setid; ?>">
      <input type="submit" name="edit-sown-btn" id="edit-sown-btn" value="save">
    </form>
  </div>
</div>
        
<!-- set built -->
<div style="display:flex;align-items:center;position:relative;">
  <div id="sbuilt-stmt" class="info-line-cont">
    <?php 
      if ($set['sown'] > 0) {
        if ($set['sbuilt']) {
          echo '<img src="img/built.png" class="icon">';
          echo '<p class="info-line">Built</p>';
        }
        else {
          echo '<img src="img/box.png" class="icon">';
          echo '<p class="info-line">Boxed</p>';
        }
      }
    ?>
  </div>

  <!-- edit set built -->
  <?php if ($set['sown']) {
    echo '<img src="img/edit.png" alt="edit built" class="open-btn icon pointer" toggle="edit-box-set-built">';
  } ?>
  <div class="openable pop-form" id="edit-box-set-built">
    <img src="img/close.png" alt="close pop-up" class="close-btn icon pointer" toggle="edit-box-set-built">

    <div id="edit-sbuilt-options">
      <?php
        if ($set['sbuilt']) {  
          echo '<h4>mark as boxed</h4>';
          echo '<img src="img/box.png" class="icon-xl">';
        }
        else {
          echo '<h4>mark as built</h4>';
          echo '<img src="img/built.png" class="icon-xl">';
        }
      ?>
      <form id="edit-set-built-form">
        <input type="hidden" name="edit-set-built-setid" id="edit-set-built-setid" value="<?php echo $setid; ?>">
        <input type="hidden" name="edit-set-built" id="edit-set-built" value="<?php echo $set['sbuilt'];  ?>">
        <input type="submit" name="edit-set-built-btn" id="edit-set-built-btn" value="save">
      </form>
    </div>
  </div>
</div>

<!-- set instructions -->
  <div style="display:flex;align-items:center;position:relative;">
  <div id="sinstr-stmt" class="info-line-cont">
    <?php 
      if ($set['sinstr']) {
        echo '<img src="img/instr.png" class="icon">';
        echo '<p class="info-line">Instructions on paper</p>';
      }
      else {
        echo '<img src="img/www.png" class="icon">';
        echo '<p class="info-line">Instructions online</p>';
      }
    ?>
  </div>

  <!-- edit set instructions -->
  <img src="img/edit.png" alt="edit instructions" class="open-btn icon pointer" toggle="edit-box-set-instr">
  <div class="openable pop-form" id="edit-box-set-instr">
    <img src="img/close.png" alt="close pop-up" class="close-btn icon pointer" toggle="edit-box-set-instr">

    <div>
      <?php
        if ($set['sinstr']) {  
          echo '<h4>Instructions online</h4>';
          echo '<img src="img/www.png" class="icon-xl">';
        }
        else {
          echo '<h4>Instructions on paper</h4>';
          echo '<img src="img/instr.png" class="icon-xl">';
        }
      ?>
      <form id="edit-set-instr-form">
        <input type="hidden" name="edit-set-instr-setid" id="edit-set-instr-setid" value="<?php echo $setid; ?>">
        <input type="hidden" name="edit-set-instr" id="edit-set-instr" value="<?php echo $set['sinstr']; ?>">
        <input type="submit" name="edit-set-instr-btn" id="edit-set-instr-btn" value="save">
      </form>
    </div>
  </div>
</div>

<!-- set bricklink -->
<div style="display:flex;align-items:center;position:relative;">
  <div id="sbl-stmt" class="info-line-cont">
    <img src="img/bricklink.png" class="icon">
    <p class="info-line"><a href="https://www.bricklink.com/v2/catalog/catalogitem.page?S=<?php echo $setid; ?>#T=I" target="blank">See in Bricklink</a></p>
  </div>
</div>

<!-- set toysperiod -->
<div style="display:flex;align-items:center;position:relative;">
  <div id="stp-stmt" class="info-line-cont">
    <img src="img/toysperiod.png" class="icon">
    <?php 
      if ($set['toysperiod'] == null) {
        echo '<p class="info-line">Add link to ToysPeriod</p>';
      }
      else {
        echo '<p class="info-line"><a href="' . $set['toysperiod'] . '">See in ToysPeriod</a></p>';
      }
    ?>
  </div>

  <!-- edit toysperiod -->
  <img src="img/edit.png" alt="edit toysperiod" class="open-btn icon" toggle="edit-box-set-tp">
  <div class="openable pop-form" id="edit-box-set-tp">
    <img src="img/close.png" alt="close pop-up" class="close-btn icon" toggle="edit-box-set-tp">

    <div>
      <h4>edit ToysPeriod link</h4>
      <form id="edit-set-tp-form">
        <input type="hidden" name="edit-set-tp-setid" id="edit-set-tp-setid" value="<?php echo $setid; ?>">
        <input type="text" name="edit-set-tp" id="edit-set-tp" value="<?php echo $set['toysperiod']; ?>">
        <input type="submit" name="edit-set-tp-btn" id="edit-set-tp-btn" value="save">
      </form>
    </div>
  </div>
</div>

    
