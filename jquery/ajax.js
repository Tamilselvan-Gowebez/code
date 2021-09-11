// AJAX to Transfer Form Data
// =========================================================
function sendFeedback() {

    $.ajax({
        url: 'actions/act.php',
        type: 'POST',
        data: $("#login-form").serialize() + '&action=signin',
        dataType: 'JSON',
        async: false
    }).done(function (response) {
        if (response['status'] == 'Success') {
            toastr.success(response['message']);
        }
        else {
            toastr.error(response['message']);
        }
    }).fail(function (error) {
        console.error(error);
        toastr.error('Failed to Submit');
    })
}