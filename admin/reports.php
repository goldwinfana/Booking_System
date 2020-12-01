
<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Reports
      </h1>
      <ol class="breadcrumb">
        <li><a href="./home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reports</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" >
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>


      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              
              <div class="pull-right">
                  <div class="form-group">
                     <label for="type" class="col-sm-3 control-label">Report Type</label>

                      <div class="col-sm-9">
                          <select name="type" id="type" class="form-control" onchange="clearVal();" required>
                              <option selected disabled>Select report type</option>
                              <option value="vehicles">Vehicle</option>
                              <option value="customers">Customers</option>
                              <option value="bookings">Booking</option>
                              <option value="history">History</option>
                          </select>
                      </div>
                  </div>
                  <div class="input-group">
                      Search Keys:
                      <input type="text" id="search" name="search" class="form-control" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" />
                      <br/>
                  </div>
              </div>
            </div>

              <div style="padding-left: 30%;">
                  <div class="input-group calenda">
                      Start Date: <span class="fromdate"><span class="fa fa-calendar-times-o"></span></span>
                      <input type="date" name="fromD" class="form-control" placeholder="Date" required />
                        <br/>
                      End Date: <span class="todate"><span class="fa fa-calendar-times-o"></span></span>
                      <input type="date" name="toD" class="form-control" placeholder="Date" required />
                  </div>
                  <br/>
                  <span class="date-error"></span><br/>
                  <button name="generate" class="btn btn-success" onclick="generateRep()"><i class="fa fa-gears"></i> Generate Report</button>
                  <button id="download" name="download" class="btn btn-warning" onclick="" disabled><i class="fa fa-download"></i> Download Report</button>
              </div>

            <div class="box-body" id="summery-report" >
                <h3 id="text-primary" class="card-title text-primary"></h3>
                <table id="example1" class="table table-bordered">
                    <thead></thead>
                    <tbody></tbody>
                </table>
          </div>
        </div>

      </div>
    </section>

  </div>
  	<?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<script>

    function clearVal(){
        var name =$('#type').val();
        $('input[name=fromD]').val('');
        $('input[name=toD]').val('');
        $('#example1 thead').html('');
        $('#example1 tbody').html('');
        if(name == 'customers'){
            $('.text-primary').html('Customers Report');
            $('#download').attr('disabled',true);
            $('#search').attr('placeholder','Search using customer name..');
        }
        if(name == 'bookings'){
            $('.text-primary').html('Bookings Report');
            $('#download').attr('disabled',true);
            $('#search').attr('placeholder','Search using booking ID..');
        }
        if(name == 'history'){
            $('.text-primary').html('Ride History Report');
            $('#download').attr('disabled',true);
            $('#search').attr('placeholder','Search using customer name..');
        }
            if(name == 'vehicles'){
                $('#download').attr('disabled',false);
                $('#search').attr('placeholder','Search using vehicle type..');
                $('.text-primary').html('Ride History Report');
                $('.text-primary').html('Vehicles Report');
                $('.calenda').hide();
                $('button[name=generate]').hide();

                $.ajax({
                    type: 'POST',
                    url: 'reports_row.php',
                    data: {
                        type: name
                    },
                    success: function (response) {
                        $('#example1 thead').html(
                            "<th>Vehicle Reg No.</th>"+
                            "<th>Vehicle Name</th>"+
                            "<th>Driver</th>"+
                            "<th>Vehicle Type</th>");

                        var posts = JSON.parse(response);
                        var i=0;
                        if (posts === false || posts == '') {
                            $('#example1 tbody').html('<h2>No Data Found</h2>');
                        } else {
                            $.each(posts, function () {

                                $('#example1 tbody').append(
                                    "<tr>" +
                                    "<td>" + posts[i].reg_number + "</td>" +
                                    "<td>" + posts[i].vehicle_name + "</td>" +
                                    "<td>" + posts[i].driver_name+ "</td>" +
                                    "<td>" + posts[i].name + "</td>" +
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

            }else{
                $('.calenda').show();
                $('button[name=generate]').show();
            }
    }

    function myFunction() {
        var name =$('#type').val();
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("example1");
        tr = table.getElementsByTagName("tr");

        if(name == 'customers') {
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        if(name == 'bookings') {
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        if(name == 'vehicles') {
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[3];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        if(name == 'history') {

                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }


            // if(tr.length == 1){
            //     for (i = 0; i < tr.length; i++) {
            //         td = tr[i].getElementsByTagName("td")[1];
            //         if (td) {
            //             txtValue = td.textContent || td.innerText;
            //             if (txtValue.toUpperCase().indexOf(filter) > -1) {
            //                 tr[i].style.display = "";
            //             } else {
            //                 tr[i].style.display = "none";
            //             }
            //         }
            //     }
            // }
        }

    }

</script>
<script type="application/javascript" src="../assets/js/report.js"></script>
<script type="application/javascript" src="../assets/js/pdf.js"></script>
</body>
</html>
