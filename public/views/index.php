<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neuromodulation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Neuromodulation</h1>
        <form id="painForm">
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
                    <div class="form-group">
                        <label for="q1">How much relief have pain treatments or medications FROM THIS CLINIC provided? (0-100)</label>
                        <input type="number" class="form-control" id="q1" name="q1" max="100" required>
                    </div>
                    <div class="form-group">
                        <label for="q2">Please rate your pain at its WORST in the past week. (0-10)</label>
                        <input type="number" class="form-control" id="q2" name="q2" max="10" required>
                    </div>
         
                    <div class="form-group">
                        <label for="totalScore">Total Score</label>
                        <input type="number" class="form-control" id="totalScore" name="totalScore" readonly>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#dateOfBirth').on('change', function() {
                let dob = new Date($(this).val());
                let ageDifMs = Date.now() - dob.getTime();
                let ageDate = new Date(ageDifMs);
                $('#age').val(Math.abs(ageDate.getUTCFullYear() - 1970));
            });

            $('#painForm').on('input', function() {
                let totalScore = 0;
                for (let i = 2; i <= 12; i++) {
                    let val = parseInt($(`#q${i}`).val());
                    if (!isNaN(val)) {
                        totalScore += val;
                    }
                }
                $('#totalScore').val(totalScore);
            });

            $('#painForm').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                $.post('controllers/process_form.php', formData, function(response) {
                    if (response.success) {
                        alert('Form submitted successfully!');
                        $('#painForm')[0].reset();
                    } else {
                        alert('Failed to submit form');
                    }
                }, 'json');
            });
        });
    </script>
</body>
</html>
