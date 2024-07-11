<?php
include_once 'db.php';

function insertPatient($firstName, $surname, $dateOfBirth) {
    $conn = getDBConnection();
    $sql = "{CALL InsertPatient(?, ?, ?, ?)}";
    $params = array(
        array($firstName, SQLSRV_PARAM_IN),
        array($surname, SQLSRV_PARAM_IN),
        array($dateOfBirth, SQLSRV_PARAM_IN),
        array(&$patientID, SQLSRV_PARAM_OUT)
    );

    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    return $patientID;
}

function insertPainInventory($patientID, $scores) {
    $conn = getDBConnection();
    $totalScore = array_sum(array_slice($scores, 1));
    $sql = "{CALL InsertPainInventory(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)}";
    $params = array_merge([$patientID], $scores, [$totalScore]);

    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}

function getAllData() {
    $conn = getDBConnection();
    $sql = "{CALL GetAllData}";
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $data = [];
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $data[] = $row;
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    return $data;
}

function deleteRecord($id) {
    $conn = getDBConnection();
    $sql = "{CALL DeleteRecord(?)}";
    $params = array($id);

    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>
