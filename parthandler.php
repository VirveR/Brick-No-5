<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '.settings.php';

try {
  //add part
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addPartNumber'])) {
    //read post data
    $pnumber = $_POST['addPartNumber'];
    $pdescr = $_POST['addPartDescr'];
    $pfrom = $_POST['addPartFrom'];
    $pto = $_POST['addPartTo'];

    //insert new part
    $sql = "INSERT INTO parts1 (pnumber, pdescr, pfrom, pto) VALUES (?, ?, ?, ?);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$pnumber, $pdescr, $pfrom, $pto]);
    $stmt = null;
    unset($_POST);

    //send success response
    echo json_encode([
      'success' => true
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