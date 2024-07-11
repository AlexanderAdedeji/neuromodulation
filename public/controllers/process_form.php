<?php
include_once '../../src/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $surname = $_POST['surname'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $patientID = insertPatient($firstName, $surname, $dateOfBirth);

    $scores = [];
    for ($i = 1; $i <= 12; $i++) {
        $scores[] = $_POST["q$i"];
    }

    insertPainInventory($patientID, $scores);

    header('Location: admin.php');
}
?>
