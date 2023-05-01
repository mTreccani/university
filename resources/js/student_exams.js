import $ from 'jquery';

$(function() {
    $('#book').on('click', function() {
        const examId = $(this).closest('tr').data('id');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajax({
            url: '/student/exams/' + examId,
            type: 'POST',
            data: {
                _token: csrfToken,
            },
            success: function(data) {
                if (data.success) {
                    const user_exam_id = data.user_exam_id;
                    $(this).closest('td').data('user_exam_id', user_exam_id);
                }
            },
        });
    });
});

$(function() {
    $('#delete').on('click', function() {
        const userExamId = $(this).closest('td').data('user_exam_id');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajax({
            url: '/student/exams/' + userExamId,
            type: 'DELETE',
            data: {
                _token: csrfToken,
            },
            success: function(data) {
                if (data.success) {
                    $(this).closest('td').data('user_exam_id', null);
                }
            },
        });
    });
});
