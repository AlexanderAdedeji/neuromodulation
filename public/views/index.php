<?php
include_once '../../src/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Neuromodulation Form</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</head>
<body>
    <div class="container">
        <h1>Neuromodulation</h1>
        <form id="neuromodulationForm" action="process_form.php" method="post">
            <div class="card">
                <div class="card-header">Patient Details</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                    </div>
                    <div class="form-group">
                        <label for="surname">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname" required>
                    </div>
                    <div class="form-group">
                        <label for="dateOfBirth">Date of Birth</label>
                        <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" required>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">Brief Pain Inventory (BPI)</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="q1">How much relief have pain treatments or medications FROM THIS CLINIC provided?</label>
                        <input type="number" class="form-control" id="q1" name="q1" min="0" max="100" required>
                    </div>
                    <?php for ($i = 2; $i <= 12; $i++): ?>
                        <div class="form-group">
                            <label for="q<?= $i ?>">Question <?= $i ?></label>
                            <input type="number" class="form-control" id="q<?= $i ?>" name="q<?= $i ?>" min="0" max="10" required>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">Total Score</div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="number" class="form-control" id="totalScore" name="totalScore" readonly>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</body>
</html>
