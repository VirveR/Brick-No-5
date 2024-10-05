<?php
header('Content-Type: application/json');
include '.settings.php';

try {
  //add parts to collection
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add-coll-part-colid'])) {
    //read post data
    $colid = $_POST['add-coll-part-colid'];
    $corow = $_POST['add-coll-part-corow'];
    $cototal = $_POST['add-coll-part-total'];
    $coamount = $_POST['add-coll-part-amount'];
    $cototal += $coamount;

    //insert new set
    $sql = "UPDATE collparts1 SET cototal = ? WHERE colid = ? AND corow = ?;"; 
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cototal, $colid, $corow]);
    $stmt = null;
    unset($_POST);

    //send success response
    echo json_encode([
      'success' => true,
      'total' => $cototal,
      'corow' => $corow
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