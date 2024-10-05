<?php
header('Content-Type: application/json');
include '.settings.php';

try {
  //add set
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addSetid'])) {
    //read post data
    $setid = $_POST['addSetid'];
    $sname = $_POST['addSetName'];
    $syear = $_POST['addSetYear'];
    $sown = $_POST['addSetOwn'];
    $sbuilt = 0;
    $sinstr = 0;

    //insert new set
    $sql = "INSERT INTO sets (setid, sname, syear, sown, sbuilt, sinstr) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$setid, $sname, $syear, $sown, $sbuilt, $sinstr]);
    $stmt = null;
    unset($_POST);

    //send success response
    echo json_encode([
      'success' => true
    ]);
  }

  //edit sown, options: 0, 1000, 1900, 3000
  else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editSetOwn'])) {
    $setid = $_POST['editOwnSetid'];
    $sown = $_POST['editSetOwn'];
    if ($sown == '3000') {
      if (!empty($_POST['edit-sown-year'])) {
        $sown = $_POST['edit-sown-year'];
      }
    }

    $sownstmt = '<p class="info-line">Not marked own yet</p>';
    if ($sown == 1000) {
      $sownstmt = '<img src="img/check.png" class="icon"><p class="info-line">Own since childhood</p>';
    }
    else if ($sown == 1900 || $sown == 3000) {
      $sownstmt = '<img src="img/check.png" class="icon"><p class="info-line">Own since when?</p>';
    }
    else if ($sown > 1900) {
      $sownstmt = '<img src="img/check.png" class="icon"><p class="info-line">Own since ' . $sown . '</p>';
    }

    $sql = "UPDATE sets SET sown = ? WHERE setid = ?;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$sown, $setid]);
    $stmt = null;
    unset($_POST);

    //send success response
    echo json_encode([
      'success' => true,
      'sownstmt' => $sownstmt
    ]);
  }

  //edit set built
  else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editSbuiltSetid'])) {
    $setid = $_POST['editSbuiltSetid'];
    $sbuilt = 1;
    if ($_POST['editSbuilt'] == 1) { $sbuilt = 0; }

    $sbuiltstmt = '<img src="img/box.png" class="icon"><p class="info-line">Boxed</p>';
    if ($sbuilt) {
      $sbuiltstmt = '<img src="img/built.png" class="icon"><p class="info-line">Built</p>';
    }

    $sql = "UPDATE sets SET sbuilt = ? WHERE setid = ?;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$sbuilt, $setid]);
    $stmt = null;
    unset($_POST);

    //send success response
    echo json_encode([
      'success' => true,
      'sbuiltstmt' => $sbuiltstmt,
      'sbuiltopt' => $sbuiltopt
    ]);
  }

  //edit set instructions
  else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editSinstrSetid'])) {
    $setid = $_POST['editSinstrSetid'];
    $sinstr = 1;
    if ($_POST['editSinstr'] == 1) { $sinstr = 0; }

    $sinstrstmt = '<img src="img/www.png" class="icon"><p class="info-line">Instructions online</p>';
    if ($sinstr) {
      $sinstrstmt = '<img src="img/instr.png" class="icon"><p class="info-line">Instructions on paper</p>';
    }

    $sql = "UPDATE sets SET sinstr = ? WHERE setid = ?;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$sinstr, $setid]);
    $stmt = null;
    unset($_POST);

    //send success response
    echo json_encode([
      'success' => true,
      'sinstrstmt' => $sinstrstmt
    ]);
  }

  //edit set Bricklink link
  else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editSblSetid'])) {
    $setid = $_POST['editSblSetid'];
    $sbl = $_POST['editSbl'];

    $sblstmt = '<img src="img/bricklink.png" class="icon"><p class="info-line"><a href="' . $sbl . '">See in Bricklink</a></p>';

    $sql = "UPDATE sets SET bricklink = ? WHERE setid = ?;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$sbl, $setid]);
    $stmt = null;
    unset($_POST);

    //send success response
    echo json_encode([
      'success' => true,
      'sblstmt' => $sblstmt
    ]);
  }

  //edit set ToysPeriod link
  else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editStpSetid'])) {
    $setid = $_POST['editStpSetid'];
    $stp = $_POST['editStp'];

    $stpstmt = '<img src="img/toysperiod.png" class="icon"><p class="info-line"><a href="' . $stp . '">See in ToysPeriod</a></p>';

    $sql = "UPDATE sets SET toysperiod = ? WHERE setid = ?;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$stp, $setid]);
    $stmt = null;
    unset($_POST);

    //send success response
    echo json_encode([
      'success' => true,
      'stpstmt' => $stpstmt
    ]);
  }

  //delete row from set
  else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delRowNumber'])) {
    //read post data
    $rsetid = $_POST['delRowSetid'];
    $rnumber = $_POST['delRowNumber'];

    //delete row
    $sql = "DELETE FROM setrows WHERE (rsetid = ? AND rnumber = ?);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$rsetid, $rnumber]);
    unset($_POST);

    //send success response
    echo json_encode([
      'success' => true
    ]);
  }

  //add row to set
  else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addRowSetid'])) {
    //read post data
    $rsetid = $_POST['addRowSetid'];
    $rpart = $_POST['addRowPart'];
    $rcolor = $_POST['addRowColor'];
    $rneeds = $_POST['addRowNeeds'];
    if (isset($_POST['rhas'])) { $rhas = $_POST['addRowHas']; }
      else { $rhas = 0; }

    //find the right row number
    $sql = "SELECT MAX(rnumber) AS maxrow FROM setrows WHERE rsetid = ?;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$rsetid]);
    $result = $stmt->fetch();
    $rnumber = $result['maxrow'] ? $result['maxrow'] + 1 : 1;

    //find the part descr
    $sql = "SELECT pdescr FROM parts1 WHERE pnumber = ?;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$rpart]);
    $result = $stmt->fetch();
    $pdescr = $result['pdescr'];

    //add new row
    $sql = "INSERT INTO setrows (rsetid, rnumber, rpart, rcolor, rneeds, rhas) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$rsetid, $rnumber, $rpart, $rcolor, $rneeds, $rhas]);
    unset($_POST);

    //send success response
    $response = [];
    $response['success'] = true;
    $response['rnumber'] = $rnumber;
    $response['pdescr'] = $pdescr;
    echo json_encode($response);
  }

  else {
    echo json_encode([
      'success' => false,
      'message' => 'invalid request'
    ]);
  }
}

catch (PDOException $e) {
  //send other fail response
  echo json_encode([
    'success' => false,
    'message' => 'database error:' . $e->getMessage()
  ]);
}

exit;