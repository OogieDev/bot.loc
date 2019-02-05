$(document).ready(function () {

    $('.sidenav').sidenav();
    $('select').formSelect();
    $('.card-panel').mouseenter(function () {
        $(this).find('.cart-edit i').fadeIn();
    }).mouseleave(function () {
        $(this).find('.cart-edit i').fadeOut();
    });
});
