<?php
include_once '../../src/functions.php';
$questions = include '../../data/questions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Neuromodulation Form</title>
    <!-- <link rel="stylesheet" href="../../assets/style.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- <script src="../../assets/scripts.js"></script> -->
</head>
<body>
    <div class="container">
        <h1>Neuromodulation</h1>
        <form id="neuromodulationForm" action="../controllers/process_form.php" method="post">
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
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" class="form-control" id="age" name="age" readonly>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">Brief Pain Inventory (BPI)</div>
                <div class="card-body">
                    <?php foreach ($questions as $question): ?>
                        <?php if ($question['id'] == 'q1'): ?>
                            <p>The question below is from a scale of 0-100:</p>
                        <?php elseif ($question['id'] == 'q2'): ?>
                            <p>The remaining questions are to be answered on a scale of 0-10:</p>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="<?= $question['id'] ?>"><?= $question['text'] ?></label>
                            <input type="number" class="form-control" id="<?= $question['id'] ?>" name="<?= $question['id'] ?>" min="<?= $question['min'] ?>" max="<?= $question['max'] ?>" required>
                        </div>
                    <?php endforeach; ?>
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

    <script>
        document.getElementById('dateOfBirth').addEventListener('input', function() {
            let dob = new Date(this.value);
            let today = new Date();
            let age = today.getFullYear() - dob.getFullYear();
            let monthDifference = today.getMonth() - dob.getMonth();
            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dob.getDate())) {
                age--;
            }
            document.getElementById('age').value = age;
        });

        document.getElementById('neuromodulationForm').addEventListener('input', function() {
            let totalScore = 0;
            for (let i = 2; i <= 12; i++) {
                let score = parseInt(document.getElementById('q' + i).value) || 0;
                totalScore += score;
            }
            document.getElementById('totalScore').value = totalScore;
        });
    </script>
</body>
</html>
