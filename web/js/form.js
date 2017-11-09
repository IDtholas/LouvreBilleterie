$(function () {
    $( "input.datepicker_js" ).datepicker({
        dateFormat: "dd-mm-yy"});
    $('input.datepicker_birth').each(function () {
        $(this).after('<p class="help-text lead">Format demandé : 25-12-1985</p>');
    })
});