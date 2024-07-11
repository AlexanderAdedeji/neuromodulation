<?php
include_once '../../src/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $scores = [];
    for ($i = 1; $i <= 12; $i++) {
        $scores[] = $_POST["q$i"];
    }
    $totalScore = array_sum(array_slice($scores, 1));

    $conn = getDBConnection();
    $sql = "UPDATE PainInventory SET q1 = ?, q2 = ?, q3 = ?, q4 = ?, q5 = ?, q6 = ?, q7 = ?, q8 = ?, q9 = ?, q10 = ?, q11 = ?, q12 = ?, total_score = ? WHERE id = ?";
    $params = array_merge($scores, [$totalScore, $id]);

    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    header('Location: admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Record</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</head>
<body>
    <div class="container">
        <h1>Edit Record</h1>
        <form action="edit_record.php" method="post">
            <?php
            $id = $_GET['id'];
            $data = getAllData();
            $record = array_filter($data, fn($item) => $item['id'] == $id)[0];
            ?>
            <input type="hidden" name="id" value="<?= $id ?>">
            <?php for ($i = 1; $i <= 12; $i++): ?>
                <div class="form-group">
                    <label for="q<?= $i ?>">Question <?= $i ?></label>
                    <input type="number" class="form-control" id="q<?= $i ?>" name="q<?= $i ?>" value="<?= $record["q$i"] ?>" required>
                </div>
            <?php endfor; ?>
            <button type="submit" class="btn btn-primary mt-3">Save</button>
        </form>
    </div>
</body>
</html>
