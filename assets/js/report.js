function generateRep(){
    $('#download').attr('disabled',false);
    $('#example1 thead').html('');
    $('#example1 tbody').html('');
    let type = $('#type').val();
    let from = $('[name=fromD]').val();
    let to = $('[name=toD]').val();

    if (type == null){
        $('#type').focus();
        return;
    }
    if (from == ''){
        $('[name=fromD]').focus();
        return;
    }
    if (to == ''){
        $('[name=toD]').focus();
        return;
    }

    if (from > to){
        $('.date-error').css('color','red').html('Start Date can not be greater than End Date !!');
        return;
    }

    if(type =='bookings') {

        $.ajax({
            type: 'POST',
            url: './../admin/reports_row.php',
            data: {
                type: type,
                startDate: from,
                endDate: to
            },
            success: function (response) {
                $('#example1 thead').html(
                "<th>Booking ID</th>"+
                    "<th>Date</th>"+
                     "<th>Customer</th>"+
                    "<th>Driver</th>"+
                    "<th>Destination</th>"+
                    "<th>Pick Up</th>"+
                    "<th>Payment Type</th>");

                var posts = JSON.parse(response);
                var i=0;
                if (posts === false || posts == '') {
                    $('#example1 tbody').html('<h2>No Data Found</h2>');
                } else {
                    $.each(posts, function () {

                        $('#example1 tbody').append(
                            "<tr>" +
                            "<td>" + posts[i].book_id + "</td>" +
                            "<td>" + posts[i].date + "</td>" +
                            "<td>" + posts[i].cust_name + "</td>" +
                            "<td>" + posts[i].driver_name+ "</td>" +
                            "<td>" + posts[i].end_address + "</td>" +
                            "<td>" + posts[i].start_address + "</td>" +
                            "<td>" + posts[i].payment_type + "</td>" +
                            "</tr>"
                        );
                        i++;
                    });
                }

            },
            error: function (error) {
                console.error(error);
            }
        });
    }
    if(type =='customers') {


        $.ajax({
            type: 'POST',
            url: './../admin/reports_row.php',
            data: {
                type: type,
                startDate: from,
                endDate: to
            },
            success: function (response) {
                $('#example1 thead').html(
                    "<th>Customer Names</th>"+
                    "<th>Mobile Number</th>"+
                    "<th>Email</th>"+
                    "<th>Date</th>");

                var posts = JSON.parse(response);
                var i=0;
                if (posts === false || posts == '') {
                    $('#example1 tbody').html('<h2>No Data Found</h2>');
                } else {

                    $.each(posts, function () {

                        $('#example1 tbody').append(
                            "<tr>" +
                            "<td>" + posts[i].firstname + "</td>" +
                            "<td>" + posts[i].mobile + "</td>" +
                            "<td>" + posts[i].email + "</td>" +
                            "<td>" + posts[i].date_created + "</td>" +
                            "</tr>"
                        );
                        i++;
                    });



                }



            },
            error: function (error) {
                console.error(error);
            }
        });
    }


    if(type =='history') {


        $.ajax({
            type: 'POST',
            url: './../admin/reports_row.php',
            data: {
                type: type,
                startDate: from,
                endDate: to
            },
            success: function (response) {
                $('#example1 thead').html(
                    "<th>Customer</th>"+
                    "<th>Driver</th>"+
                    "<th>Trip Cost</th>"+
                    "<th>Driver Cut</th>"+
                    "<th>Truber Cut</th>");

                var posts = JSON.parse(response);
                var i=0;
                if (posts === false || posts == '') {
                    $('#example1 tbody').html('<h2>No Data Found</h2>');
                } else {

                    $.each(posts, function () {

                        $('#example1 tbody').append(
                            "<tr>" +
                            "<td>" + posts[i].cust_name+"</td>" +
                            "<td>" + posts[i].driver_name + "</td>" +
                            "<td>R" + + posts[i].amount+"</td>" +
                            "<td>" + posts[i].driver_amount+"</td>" +
                            "<td>R" + posts[i].truber_amount + "</td>" +
                            "</tr>"
                        );
                        i++;
                    });



                }



            },
            error: function (error) {
                console.error(error);
            }
        });
    }
}


