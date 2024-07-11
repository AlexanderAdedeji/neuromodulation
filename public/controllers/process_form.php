<?php
require '../../src/db.php';

$firstName = $_POST['firstName'];
$surname = $_POST['surname'];
$dateOfBirth = $_POST['dateOfBirth'];
$age = $_POST['age'];
$q1 = $_POST['q1'];
$q2 = $_POST['q2'];
$q3 = $_POST['q3'];
$q4 = $_POST['q4'];
$q5 = $_POST['q5'];
$q6 = $_POST['q6'];
$q7 = $_POST['q7'];
$q8 = $_POST['q8'];
$q9 = $_POST['q9'];
$q10 = $_POST['q10'];
$q11 = $_POST['q11'];
$q12 = $_POST['q12'];
$totalScore = $_POST['totalScore'];

$db = new Database();
$conn = $db->getConnection();

// Insert into Patients
$sql = "INSERT INTO Patients (first_name, surname, date_of_birth, age) VALUES (?, ?, ?, ?)";
$params = [$firstName, $surname, $dateOfBirth, $age];
$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
$patientId = sqlsrv_fetch_array(sqlsrv_query($conn, "SELECT SCOPE_IDENTITY() AS id"))['id'];

// Insert into PainInventory
$sql = "INSERT INTO PainInventory (patient_id, q1, q2, q3, q4, q5, q6, q7, q8, q9, q10, q11, q12, total_score) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$params = [$patientId, $q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10, $q11, $q12, $totalScore];
$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

echo json_encode(["success" => true]);
