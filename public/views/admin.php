<?php
include_once '../../src/functions.php';
$data = getAllData();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin View</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</head>
<body>
    <div class="container">
        <h1>Admin View</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date of Submission</th>
                    <th>First Name</th>
                    <th>Surname</th>
                    <th>Age</th>
                    <th>Date of Birth</th>
                    <th>Total Score</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= $row['date_of_submission'] ?></td>
                        <td><?= $row['first_name'] ?></td>
                        <td><?= $row['surname'] ?></td>
                        <td><?= $row['age'] ?></td>
                        <td><?= $row['date_of_birth']->format('Y-m-d') ?></td>
                        <td><?= $row['total_score'] ?></td>
                        <td>
                            <a href="edit_record.php?id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                            <a href="delete_record.php?id=<?= $row['id'] ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
