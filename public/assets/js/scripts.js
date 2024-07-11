// scripts.js

document.addEventListener('DOMContentLoaded', function() {
    // For the form page
    if (document.getElementById('neuromodulationForm')) {
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
    }

    // For the admin page
    if (document.getElementById('adminTableBody')) {
        $('#adminTableBody').on('click', '.btn-delete', function() {
            let id = $(this).data('id');
            if (confirm('Are you sure you want to delete this record?')) {
                $.post('../controllers/delete_record.php', { id: id }, function() {
                    alert('Record deleted successfully!');
                    location.reload();
                });
            }
        });
    }
});
