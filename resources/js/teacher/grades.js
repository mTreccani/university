import { showConfirmation } from "../components/dialog.js";

const confirmButton = document.getElementById('confirm-grades');

confirmButton.addEventListener('click', confirmGrades);

function confirmGrades() {
    showConfirmation(submitForm);
}
function submitForm() {
    document.getElementById('grades-form').submit();
}

