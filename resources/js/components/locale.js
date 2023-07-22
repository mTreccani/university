$(document).ready(function() {
    $('#locale').on('change', function() {
        const selectedLocale = $(this).val();

        $.ajax({
            url: '/api/locale',
            method: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json',
                "X-Requested-With":"XMLHttpRequest",
            },
            data: { locale: selectedLocale },
            success: function(response) {
                window.location.reload();
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
});
