@props(['title', 'message', 'confirmText' => 'Conferma', 'cancelText' => 'Annulla'])
<div id="confirmation-dialog" class="hidden">
    <div class="dialog-content">
        <div class="text-lg fw-bold">{{ $title }}</div>
        <p>{{ $message }}</p>
        <div class="buttons">
            <button id="cancel" class="secondary-button me-2">{{ $cancelText }}</button>
            <button id="confirm" class="primary-button">{{ $confirmText }}</button>
        </div>
    </div>
</div>
