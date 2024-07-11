<?php
include_once '../../src/functions.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $result = deleteRecord($id);
    if ($result) {
        echo "Record deleted successfully";
    } else {
        echo "Failed to delete record";
    }
    exit();
} else {
    echo "ID not set";
    exit();
}
?>
