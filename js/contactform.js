$('#contactform').on('submit', function (e) {
    $(this).attr("disabled", true);
    $('.contact-submit').text('Sending Message...');
    var dataString = $("#sendemail form").serialize();
    $.ajax({
        type: 'POST',
        url: "contact.php",
        data: dataString,
        success: function () {
            $('#sendemail form').hide();
            $('#sendemail').html("<div id='message'></div>");
            $('#message').html("<h2>Thanks, We got your Message!</h2>")
                .append("<p>We will be in touch soon.</p>");
        },
        error: function (data) {
            console.log('Silent failure.');
        }
    });
    return false;
});
