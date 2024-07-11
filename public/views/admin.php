<?php
include_once '../../src/functions.php';
$data = getAllData();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin View</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
      
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .btn-warning {
            background-color: #ffc107;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
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
            <tbody id="adminTableBody">
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= $row['date_of_submission'] ?></td>
                        <td><?= $row['first_name'] ?></td>
                        <td><?= $row['surname'] ?></td>
                        <td><?= date_diff(date_create($row['date_of_birth']), date_create('today'))->y ?></td>
                        <td><?= $row['date_of_birth'] ?></td>
                        <td><?= $row['total_score'] ?></td>
                        <td>
                            <a href="../controllers/edit_record.php?id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                            <button class="btn btn-danger btn-delete" data-id="<?= $row['id'] ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
    $(document).ready(function() {
        $('#adminTableBody').on('click', '.btn-delete', function() {
            let id = $(this).data('id');
            if (confirm('Are you sure you want to delete this record?')) {
                $.post('../controllers/delete_record.php', { id: id }, function(response) {
                    alert(response);
                    location.reload();
                });
            }
        });
    });
</script>

</body>
</html>
