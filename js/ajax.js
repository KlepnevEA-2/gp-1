$('#submit').on('click', function(e) {
    e.preventDefault();
    var name = $('#name').val(),
        email = $('#email').val(),
        phone = $('#phone').val();
        street = $('#street').val();
        home = $('#home').val();
        part = $('#part').val();
        appt = $('#appt').val();
        floor = $('#floor').val();
        comment = $('#comment').val();


    $.ajax({
        url: '/login.php',
        method: 'POST',
        dataType: 'json',
        data: {
            name: name,
            phone: phone,
            email: email,
            street: street,
            home: home,
            part: part,
            appt: appt,
            floor : floor,
            comment: comment
        }
    }).done(function(data) {
        console.log(data);
        // var html = 'email: ' + data.mail + ';name: ' + data.name + ';phone: ' + data.tel;
        // console.log(html);
    });

});

