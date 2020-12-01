

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Customer</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_edit.php" onsubmit="return validateForm();">
                <input type="hidden" class="userid" name="id">
                <div class="form-group">
                    <label for="edit_email" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control emailU" id="edit_email" name="email" onkeyup="emailValidate('register')" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_password" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="edit_password" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_firstname" name="firstname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_lastname" name="lastname">
                    </div>
                </div>

                  <div class="form-group">
                      <label for="edit_address" class="col-sm-3 control-label">Home Address</label>

                      <div class="col-sm-9">
                          <input type="text" class="form-control" id="edit_address" name="address" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="edit_age" class="col-sm-3 control-label">Age</label>

                      <div class="col-sm-9">
                          <input type="text" class="form-control" id="edit_age" name="age" onkeypress="return /[0-9]/i.test(event.key)" maxlength="3" required>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="edit_gender" class="col-sm-3 control-label">Gender</label>

                      <div class="col-sm-9">
                          <select class="form-control" type="check" id="edit_gender" name="gender"  required>\
                              <option value="" selected disabled>Select Gender ...</option>
                              <option value="male">Male</option>
                              <option value="female">Female</option>
                          </select>
                      </div>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_delete.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>DELETE Customer</p>
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>


<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Add New Customer</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="user_add.php?return=<?php echo basename($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control emailU" name="email" onkeyup="emailValidate('register')"  required>
                        </div>
                    </div>


                    <div class="form-group change-pass" id="change-pass" >
                        <label for="password" class="col-sm-3 control-label">Password</label>

                        <div class="col-sm-9">
                            <input class="form-control inputTxt passwordU" type="password" name="password" onkeyup="CheckPassword()" required><span class="fa fa-eye eyespan" style="margin-top: -30px;"></span>
                            <span class="tooltiptextU"><label class="miniCharacters">* 8 Characters minimum</label><br><label class="special_character" >* Has special character</label><br><label class="lowercase" >* Has lowercase character</label><br><label class="uppercase" >* Has uppercase character</label><br><label class="hasNumber" >* Has a number</label></span>


                        </div>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-sm-3 control-label"></label>

                        <div class="col-sm-9">
                            <div class="form-group"><label for="password-input">Confirm Password&nbsp;</label><input class="form-control inputTxtU password-inputU" type="password"  name="current_password"  onkeyup="matchPassword()" required></div>
                            <span class="passwordMatchU"></span></div>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                        <div class="col-sm-9">
                            <input class="form-control firstnameU" type="text"  name="firstname"  onkeypress="return /[a-z]/i.test(event.key)" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                        <div class="col-sm-9">
                            <input class="form-control lastnameU" type="text"  name="lastname"  onkeypress="return /[a-z]/i.test(event.key)" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_address" class="col-sm-3 control-label">Home Address</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit_address" name="address" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_age" class="col-sm-3 control-label">Age</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit_age" name="age" onkeypress="return /[0-9]/i.test(event.key)" maxlength="3" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_gender" class="col-sm-3 control-label">Gender</label>

                        <div class="col-sm-9">
                            <select class="form-control" type="check" id="edit_gender" name="gender"  required>\
                                <option value="" selected disabled>Select Gender ...</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-sm-3 control-label">mobile</label>

                        <div class="col-sm-9">
                            <input class="form-control mobileU" type="text"  name="mobile" onkeyup="ValueKeyPress('mobile');" required>
                            <span class="verifyU"></span>
                        </div>
                        <hr>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat" name="save"><i class="fa fa-check-square-o"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    let ValidationU = false;
    let mobileValidatedU = false;
    let emailvalidationU = false;
    let validatedpasswordU = false;
    let strongpasswordU = false;


    function ValueKeyPress(trigger) {

        if (trigger === 'mobile') {
            var mobile = $('.mobileU').val();

            if (mobile.length === 0) {
                $('.verifyU').html('');
            }

            if (mobile.length < 10) {
                $('.verifyU').css('color', 'red').html('<i>**the number is invalid!**</i>');
                mobileValidatedU = false;
            }

            if ((mobile.length === 10 && mobile[0] === "0" && (mobile[1] === "6" || mobile[1] === "7" || mobile[1] === "8"))
                || (mobile.length === 11 && mobile[0] === "2" && mobile[1] === "7")) {
                $('.verifyU').css('color', 'Green').html(' <i>the number is valid</i>');
                mobileValidatedU = true;
            } else if (mobile.length > 10) {
                $('.verifyU').css('color', 'red').html('<i>**the number is invalid!**</i>');
                mobileValidatedU = true;
            }
            else {
                $('.verifyU').css('color', 'red').html('<i>**the number is invalid!**</i>');
                mobileValidatedU = false;
            }
        }
    }


    function emailValidate(n) {
        if (n === 'register') {
            var count =0;
            let email = $('.emailU').val();
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
                emailvalidationU = true;
                $('.emailU').css('borderColor', '#ced4da');
            }
            else if (count2 >1 ) {
                emailvalidationU = true;
                $('.emailU').css('borderColor', '#ced4da');
            } else if (email.length === 0) {
                $('.emailU').css('borderColor', '#ced4da');
                emailvalidationU = true;
            } else {
                $('.email').css('borderColor', 'darkred');
                emailvalidationU = false;
            }


            if(afterDot !== '.com'&& afterDot !== '.za'&& afterDot !== '.org'&& afterDot !== '.net'&& afterDot !== '.uk'){
                $('.emailU').css('borderColor', 'darkred');
                emailvalidationU = false;
            }
            var iChars = "!#$%^&*()+=,~[]\\\';/{}|\":<>?";
            for (var i = 0; i < email.length; i++) {
                if (iChars.indexOf(email.charAt(i)) != -1) {

                    $('.email').css('borderColor', 'darkred');
                    emailvalidationU = false;
                }
            }
        }
    }

    function CheckPassword()
    {

        let n = $('.passwordU').val();
        let passwordPatten=  /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[ -/:-@\[-`{-~]).{8,64}$/;
        if(n.length > 0) {
            if (n.match(passwordPatten)) {
                $('.strongPasswordU').css('color', 'Green').html('<i>strong</i>');
                strongpasswordU = true;
            } else {
                $('.strongPasswordU').css('color', 'red').html('<i>weak</i>');
                strongpasswordU = false;
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
            $('.strongPasswordU').html('');
            strongpasswordU = false;
        }

        if ($(".tooltiptextU > label").css('color') == 'rgb(0, 128, 0)' ){
            strongpasswordU = true;
        }
    }

    function matchPassword(){
        let password = $('.passwordU').val();
        let password_confirm = $('.password-inputU').val();
        if (password_confirm.length === 0) {
            $('.passwordMatchU').html('');
            validatedpasswordU=false;
            return;
        }

        if (password === password_confirm) {
            $('.passwordMatchU').css('color', 'Green').html('<i>Match!</i>');
            validatedpasswordU = true;
            return;
        }
        else {
            $('.passwordMatchU').css('color', 'red').html('<i>**Don\'t Match!**</i>');
            validatedpasswordU=false;
            return;
        }
    }

    function sendForm(){
        if (mobileValidatedU && validatedpasswordU && emailvalidationU && strongpasswordU){
            ValidationU = true;
            return true;
        }

        if (!mobileValidatedU){
            $('.mobileU').focus();
            return false;
        }
        if (!validatedpasswordU){
            $('.password-inputU').focus();
            return false;
        }
        if (!emailvalidationU){
            $('.emailU').focus();
            return false;
        }
        if (!strongpasswordU){
            $('.passwordU').focus();
            return false;
        }

    }

    function validateForm() {
        if ($('.emailU').css('borderColor') == 'darkred') {

            console.log($('.emailU').css('borderColor'));
            return false;
        }
    }
    $('.eyespan').on('click', function (e){
        let type = $('.inputTxtU');
        $('.fa-eye').toggleClass('fa-eye-slash');
        if (type.attr('type') == 'text'){
            type.attr({type:"password"});
        }else{
            type.attr({type:"text"});
        }

    });

</script>
