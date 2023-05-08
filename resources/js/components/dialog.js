export function showConfirmation(confirmCallback, cancelCallback) {
    const dialog = document.getElementById('confirmation-dialog');
    const confirmButton = document.getElementById('confirm');
    const cancelButton = document.getElementById('cancel');

    dialog.classList.remove('hidden');
    console.log(dialog.classList);

    confirmButton.addEventListener('click', function() {
        confirmCallback();
        dialog.classList.add('hidden');
    });

    cancelButton.addEventListener('click', function() {
        if (cancelCallback) {
            cancelCallback();
        }
        dialog.classList.add('hidden');
    });
}
