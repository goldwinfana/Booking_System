<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>
    <style>
        .eyespan{
            float: right;
            margin-right: 6px;
            margin-top: -40px;
            position: relative;
            z-index: 2;
            color: black;
            font-size: larger;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                New Administrator
            </h1>
            <ol class="breadcrumb">
                <li><a href="./home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">New Administrator</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
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
                    <form class="form-horizontal" method="POST" action="admin_add.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control email" id="email" name="email" onkeyup="emailValidate('register')"  required>
                            </div>
                        </div>


                        <div class="form-group change-pass" id="change-pass" >
                            <label for="password" class="col-sm-3 control-label">Password</label>

                            <div class="col-sm-9">
                                <input class="form-control inputTxt password" type="password" id="password" name="password" onkeyup="CheckPassword()" required><span class="fa fa-eye eyespan" style="margin-top: -30px;"></span>
                                <span class="tooltiptext"><label class="miniCharacters">* 8 Characters minimum</label><br><label class="special_character" >* Has special character</label><br><label class="lowercase" >* Has lowercase character</label><br><label class="uppercase" >* Has uppercase character</label><br><label class="hasNumber" >* Has a number</label></span>


                            </div>
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="col-sm-3 control-label"></label>

                            <div class="col-sm-9">
                                <div class="form-group"><label for="password-input">Confirm Password&nbsp;</label><input class="form-control inputTxt password-input" type="password" id="password-input" name="current_password"  onkeyup="matchPassword()" required></div>
                                <span class="passwordMatch"></span></div>
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                            <div class="col-sm-9">
                                <input class="form-control firstname" type="text" id="firstname" name="firstname"  onkeypress="return /[a-z]/i.test(event.key)" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                            <div class="col-sm-9">
                                <input class="form-control lastname" type="text" id="lastname" name="lastname"  onkeypress="return /[a-z]/i.test(event.key)" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">mobile</label>

                            <div class="col-sm-9">
                                <input class="form-control mobile" type="text" id="mobile" name="mobile" onkeyup="ValueKeyPress('mobile');" required>
                                <span class="verify"></span>
                            </div>
                        </div>
                        <hr>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-flat" name="save"><i class="fa fa-check-square-o"></i> Submit</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
    <?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<script>

    let ValidationA = false;
    let mobileValidatedA = false;
    let emailvalidationA = false;
    let validatedpasswordA = false;
    let strongpasswordA = false;


    function ValueKeyPress(trigger) {

        if (trigger === 'mobile') {
            var mobile = $('input[name=mobile]').val();

            if (mobile.length === 0) {
                $('.verify').html('');
            }

            if (mobile.length < 10) {
                $('.verify').css('color', 'red').html('<i>**the number is invalid!**</i>');
                mobileValidatedA = false;
            }

            if ((mobile.length === 10 && mobile[0] === "0" && (mobile[1] === "6" || mobile[1] === "7" || mobile[1] === "8"))
                || (mobile.length === 11 && mobile[0] === "2" && mobile[1] === "7")) {
                $('.verify').css('color', 'Green').html(' <i>the number is valid</i>');
                mobileValidatedA = true;
            } else if (mobile.length > 10) {
                $('.verify').css('color', 'red').html('<i>**the number is invalid!**</i>');
                mobileValidatedA = true;
            }
            else {
                $('.verify').css('color', 'red').html('<i>**the number is invalid!**</i>');
                mobileValidatedA = false;
            }
        }
    }


    function emailValidate(n) {
        if (n === 'register') {
            var count =0;
            let email = $('.email').val();
            let atpos = email.indexOf("@");
            let dotpos = email.indexOf(".");
            let afterDot = email.substr(dotpos,email.length -1);

            var iChar = "@";
            for (var i = 0; i < email.length; i++) {
                if (iChar.indexOf(email.charAt(i)) != -1) {
                    count= count+1;
                }
            }

            var iChar2 = ".";
            var count2=0;
            for (var i = 0; i < email.length; i++) {
                if (iChar2.indexOf(email.charAt(i)) != -1) {
                    count2= count2+1;
                }
            }

            if (atpos > 1 && dotpos > atpos && email.length > dotpos + 1 && count == 1) {
                emailvalidationA = true;
                $('.email').css('borderColor', '#ced4da');
            }
            else if (count2 >1 ) {
                emailvalidationA = true;
                $('.email').css('borderColor', '#ced4da');
            } else if (email.length === 0) {
                $('.email').css('borderColor', '#ced4da');
                emailvalidationA = true;
            } else {
                $('.email').css('borderColor', 'darkred');
                emailvalidationA = false;
            }


            if(afterDot !== '.com'&& afterDot !== '.za'&& afterDot !== '.org'&& afterDot !== '.net'&& afterDot !== '.uk'){
                $('.email').css('borderColor', 'darkred');
                emailvalidationA = false;
            }
            var iChars = "!#$%^&*()+=,~[]\\\';/{}|\":<>?";
            for (var i = 0; i < email.length; i++) {
                if (iChars.indexOf(email.charAt(i)) != -1) {

                    $('.email').css('borderColor', 'darkred');
                    emailvalidationA = false;
                }
            }
        }
    }

    function CheckPassword()
    {

        let n = $('.password').val();
        let passwordPatten=  /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[ -/:-@\[-`{-~]).{8,64}$/;
        if(n.length > 0) {
            if (n.match(passwordPatten)) {
                $('.strongPassword').css('color', 'Green').html('<i>strong</i>');
                strongpasswordA = true;
            } else {
                $('.strongPassword').css('color', 'red').html('<i>weak</i>');
                strongpasswordA = false;
            }
            if(n.length > 7){
                $('.miniCharacters').css('color','green');
            }else {
                $('.miniCharacters').css('color','black');
            }
            if(/[a-z]/.test(n)){
                $('.lowercase').css('color','green');
            }else{
                $('.lowercase').css('color','black');
            }
            if(/[A-Z]/.test(n)){
                $('.uppercase').css('color','green');
            }else{
                $('.uppercase').css('color','black');
            }
            if(/[0-9]/.test(n)){
                $('.hasNumber').css('color','green');
            }else{
                $('.hasNumber').css('color','black');
            }
            if(/[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(n)){
                $('.special_character').css('color','green');
            }else{
                $('.special_character').css('color','black');
            }
        }else{
            $('.strongPassword').html('');
            strongpasswordA = false;
        }

        if ($(".tooltiptext > label").css('color') == 'rgb(0, 128, 0)' ){
            strongpasswordA = true;
        }
    }

    function matchPassword(){
        let password = $('.password').val();
        let password_confirm = $('.password-input').val();
        if (password_confirm.length === 0) {
            $('.passwordMatch').html('');
            validatedpasswordA=false;
            return;
        }

        if (password === password_confirm) {
            $('.passwordMatch').css('color', 'Green').html('<i>Match!</i>');
            validatedpasswordA = true;
            return;
        }
        else {
            $('.passwordMatch').css('color', 'red').html('<i>**Don\'t Match!**</i>');
            validatedpasswordA=false;
            return;
        }
    }

    function sendForm(){
        if (mobileValidatedA && validatedpasswordA && emailvalidationA && strongpasswordA){
            ValidationA = true;
            return true;
        }

        if (!mobileValidatedA){
            $('.mobile').focus();
            return false;
        }
        if (!validatedpasswordA){
            $('.password-input').focus();
            return false;
        }
        if (!emailvalidationA){
            $('.email').focus();
            return false;
        }
        if (!strongpasswordA){
            $('.password').focus();
            return false;
        }

    }

    $('.eyespan').on('click', function (e){
        let type = $('.inputTxt');
        $('.fa-eye').toggleClass('fa-eye-slash');
        if (type.attr('type') == 'text'){
            type.attr({type:"password"});
        }else{
            type.attr({type:"text"});
        }

    });

</script>

</body>
</html>
