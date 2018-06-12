$('#submit').on('click', function(e) {
    e.preventDefault();
    var name = $('#name').val(),
        email = $('#email').val(),
        phone = $('#phone').val();;
    $.ajax({
        url: '/login.php',
        method: 'POST',
        dataType: 'json',
        data: {
            name: name,
            phone: phone,
            email: email
        }
    }).done(function(data) {
        console.log(data);
        // var html = 'email: ' + data.mail + ';name: ' + data.name + ';phone: ' + data.tel;
        // console.log(html);
    });

});

