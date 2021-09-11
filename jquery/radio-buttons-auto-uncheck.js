// Radio Button Check and Uncheck function
// ==========================================================
$(':radio').on('change', function () {
    var radioButtonClass = $(this).attr('class');
    $('.' + radioButtonClass).prop('checked', false);
    $(this).prop('checked', true);
});