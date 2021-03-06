<?php
include 'includes/session.php';
include 'includes/format.php';
?>
<?php
    $today = date('Y-m-d');
    $year = date('Y');
    if(isset($_GET['year'])){
        $year = $_GET['year'];
    }

$stmt = $conn->prepare("SELECT COUNT(*) AS num FROM booking where booking_status IN (1,2) AND cust_id =:id");
$stmt->execute(['id'=>$admin['id']]);
$rows = $stmt->fetch();


if($rows['num']>0){
    header('location: request_accepted.php');
}

    $conn = $pdo->open();
?>
<?php include 'includes/header.php'; ?>
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header" style="z-index: 9;background: #ecf0f5">
                <h1>
                    Request Truber
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Request Truber</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content" style="padding-top: 0">
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

                <?php
                try{
                    $id = $admin['id'];
                    $requested = null;
                    $stmt = $conn->prepare("SELECT booking_status FROM booking WHERE cust_id =:id AND booking_status=0");
                    $stmt->execute(['id'=>$id]);
                    $row = $stmt->fetch();
                    $requested = $row['booking_status'];

                }
                catch(PDOException $e){
                    echo $e->getMessage();
                }


                if($requested == null){

                echo '

                <div class="row">
                <button class="face1" onclick="closeFace();" style="z-index: 9;position: relative;border: none"><< Hide</button>
                <button class="face2" onclick="openFace();" style="z-index: 9;position: relative;border: none" hidden>Show >></button>
                    <div class="col-lg-6 col-xs-6 adjust">
                    
                        <!-- small box -->
                        <form id="book-form" class="form" method="POST" action="handle_requests.php" onsubmit="return request_confirmed();">
                            <div class="inputContainer">
                                <i class="fa fa-money fa-2x icon"> </i>

                            <select class="form-control Field" style="text-align-last:center;" name="payment" onchange="selectCard(this.value);"  required >
                                <option value="" selected disabled hidden>Choose Payment Type</option>
                                <option value="cash">Cash</option>
                                
                                ';

                                    try{
                                        $stmts = $conn->prepare("SELECT * FROM card WHERE id=:id");
                                        $stmts->execute(['id'=>$admin['id']]);

                                        if(empty($stmts)){
                                            echo' <option value="card">Card</option>';
                                        }else{
                                            foreach($stmts as $row){

                                                $count = $row['cardnumber'];
                                                $new = substr('****************',0,strlen(substr($count,0,-3))).substr_replace($count,'',0,-3);

                                                echo "<option style='background:lightgrey' value=".$row['cardnumber'].">".substr($row['bankname'],0,3)." ".$new."</option>";
                                            }
                                            echo' <option value="card"></i>Add New Card</option>';
                                        }
                                    }
                                    catch(PDOException $e){
                                        echo $e->getMessage();
                                    }

                                echo'
                               
                            </select>
                            </div>
                            <br/>

                            <div class="inputContainer">
                                <i class="fa fa-cab fa-2x icon"> </i>

                                <select class="form-control Field" style="text-align-last:center;" name="type" onchange=" selectVehicle();" required >
                                    <option value="" selected disabled>Choose Vehicle Type</option>
                   ';

                                    try{
                                        $stmt = $conn->prepare("SELECT * FROM vehicle_type ");
                                        $stmt->execute();
                                        foreach($stmt as $row){

                                            echo "<option id=".$row['id']." class=".$row['image']." value=".$row['name'].">".str_replace('_',' ',$row['name'])."</option>";
                                        }
                                    }
                                    catch(PDOException $e){
                                        echo $e->getMessage();
                                    }

                                echo '
                                </select><br/>
                                <img name="vehicles" width="250" hidden>
                            </div>
                            <br/>
                            
                        <input class="trip-distance" hidden>
                        <input name="cord" hidden> 

                        <strong class="error-adr" style="color: red"></strong><br/>
                        <div class="inputContainer">
                            <i class="fa fa-street-view fa-2x icon"> </i>
                            <input class="form-control Field" type="text" required="" placeholder="Pick-Up Address" autocomplete="off" name="start" onkeydown="getMap()">
                             <table class="all-info"></table>
                        </div>
                            <br/>
                        <div class="inputContainer">
                            <i class="fa fa-map-marker fa-2x icon"> </i>
                            <input class="form-control Field" type="text" required="" placeholder="Destination Address" autocomplete="off" name="destination" onkeydown="getMap2()" disabled>
                               <table class="all-info2"></table>
                        </div>
                       
                            <button class="btn btn-primary btn-block btn-lg btn-signin" name="push-req" type="submit">Request</button>
                        </form>
                        <br/>
                        
                      

                    </input>
                ';
                }
                else{
                    echo '
                      <h3 class="waiting">Please wait while we look for your driver <i class="fa fa-circle-o-notch fa-spin fa-2x fa-fw"></i>
                        <span class="sr-only">Loading...</span></h3>
                      ';
                }
                ?>

                </div>
                <br/>
                <!-- /.row -->
                <div class="row">
                    <div class="col-xs-12">

                        <div id="map" class="map"></div>
                        <script src="../maps/js/leaflet.js"></script>
                        <script src="../maps/js/leaflet-routing-machine.js"></script>
                        <script src="../maps/js/index.js"></script>
                        <script src='../maps/js/turf.min.js'></script>

                    </div>
                </div>
        </div>

        </body>
        <!-- right col -->
    </div>
<?php include 'includes/footer.php'; ?>

    </div>
    <!-- Modal -->
<!-- Activate -->
<div class="modal fade" id="addcard">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Add Bank Card...</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="booking_row.php" onsubmit="return validateCard();">
                    <input type="hidden" class="userid" name="banking-details" hidden>

                    <div class="text-center">
                        <label for="card-number">Card Number</label>
                        <input  class="form-control" name="card-number" id="card-number" onkeypress="return /[0-9]/i.test(event.key);" onkeyup="enterCard()" required>
                        <span id="card-error" style="color: red"></span>
                    </div><br/>
                    <div class="text-center">
                        <label for="name">Bank Name</label>
                        <select class="form-control" name="name" id="bank" onchange="setBranch(this.id);enterCard()" required>
                            <option value="" disabled selected hidden>Select Bank</option>
                            <option id="470010" value="capitec">Capitec</option>
                            <option id="250655" value="fnb">FNB</option>
                            <option id="632005" value="absa">ABSA</option>
                            <option id="051001" value="standard-bank">Standard Bank</option>
                            <option id="198765" value="nedbank">Nedbank</option>
                        </select>
                    </div><br/>
                    <div class="text-center">
                        <label for="branch">Branch Code</label>
                        <input class="form-control" name="branch" id="branch" onkeypress="return /[0-9]/i.test(event.key)" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="activate"><i class="fa fa-check"></i> Add Card</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- Chart Data -->
<div class="modal fade" id="booking-confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Confirm Booking <i class="fa fa-hand-o-up"></i>...</b></h4>
            </div>
            <div class="modal-body">

                    <input type="hidden" name="booking_confirm" hidden>

                    <div class="text-center book-div">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="button" class="btn btn-success btn-flat send-form-to" data-dismiss="modal"><i class="fa fa-check"></i> Confirm</button>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="waiting-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Cancel Or Keep Trying <i class="fa fa-hand-o-up"></i>...</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="./booking_row.php">
                    <input name="reason" value="No drivers available" hidden>
                <div class="text-center">
                    <h2 class="">Unfortunately There are No Driver's Active, <span style="color: orange"> Try Again</span> Or <span style="color: red">Cancel</span></h2>
                </div>
                <?php
                try{
                    $stmt = $conn->prepare("SELECT * FROM booking WHERE booking_status=0 AND cust_id=:cust_id ");
                    $stmt->execute(['cust_id'=>$admin['id']]);
                    $drName = $stmt->fetch();
                }
                catch(PDOException $e){
                    echo $e->getMessage();
                }

                ?>
                    <input name="trip_id" id="trip_id" value="<?php echo $drName['book_id']?>" hidden>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning btn-flat pull-left" data-dismiss="modal"><i class="fa fa-refresh"></i> Try Again</button>
                <button type="submit" class="btn btn-danger" ><i class="fa fa-close"></i>  Cancel</button>

            </div>
            </form>
        </div>
    </div>
</div>

<?php $pdo->close(); ?>
<?php include 'includes/scripts.php'; ?>

<style>
    .inputContainer i {
        position: absolute;
    }
    .inputContainer {
        width: 100%;
        margin-bottom: 10px;
    }
    .icon {
        padding: 4px;
        padding-left: 8px;
        color: lightgrey;
        width: 80px;
        text-align: left;
    }
    .Field {
        text-align: center;
    }
</style>

<script type="application/javascript">

if ($('.waiting').is(':visible')){

    $('#map').hide();
}

    var myVar = setInterval(checkStatus, 5000);

    function checkStatus(){
        $.ajax({
            type: 'POST',
            url: 'booking_row.php',
            data: {id_check:1},
            dataType: 'json',
            success: function(response){
                if(response.booking_status){
                    location = 'request_accepted.php';
                }
            }
        });
    }

    var myVars = setInterval(requestTimeOut, 20000);

    function requestTimeOut(){

        if ($('#waiting-modal').is(':hidden')){

            if ($('.waiting').is(':visible')){

                $('#waiting-modal').modal('show');
            }
        }


    }

    function enterCard(){

        var num = $('#card-number').val();
        var bank = $('#bank').val();
        $.ajax({
            type: 'POST',
            url: 'booking_row.php',
            data: {check_card:num,
            bank:bank},
            dataType: 'json',
            success: function(response){
                if(response !=false){
                    $('#card-error').html('Card Already Exists !!!');
                }
                else{
                    $('#card-error').html('');
                }
            }
        });
    }

    function requestBalance(){

        var from =$('input[name=start]').val();
        var to =$('input[name=destination]').val();
        var payment  = $('select[name=payment]').val();
        var name =     $('select[name=type]').val();
        var distance = $('.trip-distance').val();


        $.ajax({
            type: 'POST',
            url: 'booking_row.php',
            data: {names_bal:name},
            dataType: 'json',
            success: function(response){

                var base_price = response.base_price;
                var price_per_km  = response.price_per_km;
                var total;

                if (payment !='cash'){
                    payment='card';
                }
                if(distance < 1){
                    total = Math.floor(base_price);
                }else{
                    total = Math.floor(parseFloat(base_price) + parseFloat((price_per_km*distance)));
                }

                $('.book-div').html(
                    '<strong>From : <i>'+from+'</i></strong><br/>'+
                    '<strong>To : <i>'+to+'</i></strong><br/>'+
                    '<strong>Distance : <i>'+distance+' km</i></strong><br/>'+
                    '<strong>Payment Type : <i>'+payment+'</i></strong><br/>'+
                    '<strong>Vehicle Type : <i>'+response.name+'</i></strong><br/>'+
                    '<strong>Total Amount : <i style="color: red"> R'+total+'</i></strong><br/>'
                );
            }
        });


        $('#booking-confirm').modal('show');
    }

    $('.send-form-to').on('click', function (e){
        $('#book-form').removeAttr('onsubmit');
        $('#book-form').submit();
    });

    function selectVehicle(){
        var name = $('select[name=type] :selected').attr('class');
        $('img[name=vehicles]').attr('src','./../assets/img/vehicles/'+name);
        $('img[name=vehicles]').show();
    }

    function selectCard(name){

        if(name =='card')
        {
            $('#addcard').modal('show');
            $('select[name=payment]').val('');
        }
    }
    function setBranch(){

        $('#branch').val($('#bank option:selected').attr('id'));
        // $('#branch').attr('disabled','disabled');
    }

    function validateCard(){
        if($('#card-error').html() !=''){
            $('#card-number').focus();
            return false;
        }
        if($('#card-number').html() =='Add New Card'){
            $('#card-number').html('');
            return false;
        }
        return true;
    }

    function openFace(){
        $('.adjust').fadeIn(600);
        $('.face2').hide();
        $('.face1').show();
    }

    function closeFace(){
        $('.adjust').fadeOut(100);
        $('.face1').hide();
        $('.face2').show();
    }
</script>

<script src="./../assets/js/maps.js"></script>

