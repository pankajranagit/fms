$(document).ready(function () {
    $('.refreshCaptcha').on('click', function () {
        var base_url = $('#base_url_captcha').val();
        $.get(base_url, function (data) {
            $('#captImg').html(data);
        });
    });
})
