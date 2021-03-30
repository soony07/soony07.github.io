$('#contactform').on('submit', function (e) {
    $(this).attr("disabled", true);
    $('.contact-submit').text('...');
    var dataString = $("#sendemail form").serialize();
    $.ajax({
        type: 'POST',
        url: "contact.php",
        data: dataString,
        success: function () {
            $('#sendemail form').hide();
            $('#sendemail').html("<div id='message'></div>");
            $('#message').html("<h5>Wir haben Ihre Nachricht erhalten und werden sie schnellst möglichst bearbeiten!</h5>")
                .append("<p>Danke.</p>");
        },
        error: function (data) {
            console.log('Silent failure.');
        }
    });
    return false;
});
