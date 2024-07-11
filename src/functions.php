<?php
require_once 'db.php';

function getAllData() {
    $conn = getDBConnection();
    $sql = "SELECT * FROM Patients";
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

function insertPatient($firstName, $surname, $dateOfBirth) {
    $conn = getDBConnection();
    $sql = "INSERT INTO Patients (first_name, surname, date_of_birth) OUTPUT INSERTED.ID VALUES (?, ?, ?)";
    $params = [$firstName, $surname, $dateOfBirth];

    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    return $row['ID'];
}

function insertPainInventory($patientID, $scores) {
    $conn = getDBConnection();
    $totalScore = array_sum(array_slice($scores, 1));
    $sql = "INSERT INTO PainInventory (patient_id, q1, q2, q3, q4, q5, q6, q7, q8, q9, q10, q11, q12, total_score) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = array_merge([$patientID], $scores, [$totalScore]);

    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}

function deleteRecord($id) {
    $conn = getDBConnection();
    $sql = "DELETE FROM PainInventory WHERE id = ?";
    $params = [$id];

    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>
