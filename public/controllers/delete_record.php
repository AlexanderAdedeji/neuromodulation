<?php
include_once '../src/functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    deleteRecord($id);

    header('Location: admin.php');
}
?>
