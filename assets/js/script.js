$(document).ready(function() {
    $("#neuromodulationForm input[type='number']").on('input', function() {
        let totalScore = 0;
        for (let i = 2; i <= 12; i++) {
            let value = parseInt($(`#q${i}`).val());
            totalScore += isNaN(value) ? 0 : value;
        }
        $("#totalScore").val(totalScore);
    });
});
