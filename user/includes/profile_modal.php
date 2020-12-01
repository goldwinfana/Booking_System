<!-- Add -->
<div class="modal fade" id="profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Customer Profile</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="profile_update.php?return=<?php echo basename($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="email" name="email" onkeyup="emailValidate('register')" value="<?php echo $admin['email']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group " id="change">
                        <div class="col-sm-9">
                            <button  onclick="changePass()">Change Password</button>
                        </div>
                    </div>

                    <div class="form-group change-pass" id="change-pass" hidden>
                        <label for="password" class="col-sm-3 control-label">Password</label>

                        <div class="col-sm-9">
                            <input class="form-control inputTxt" type="password" id="password" name="password" value="<?php echo $admin['password'] ?>" onkeyup="CheckPassword()" required>
                            <span class="tooltiptext"><label id="miniCharacters">* 8 Characters minimum</label><br><label id="special_character" >* Has special character</label><br><label id="lowercase" >* Has lowercase character</label><br><label id="uppercase" >* Has uppercase character</label><br><label id="hasNumber" >* Has a number</label></span>
                            <div class="form-group"><label for="password-input">Confirm Password&nbsp;</label><input class="form-control inputTxt" type="password" id="password-input" name="current_password" value="<?php echo $admin['password'] ?>" onkeyup="matchPassword()" required></div>
                            <span id="passwordMatch"></span>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="firstname" name="firstname" value="<?php echo $admin['firstname']; ?>"  onkeypress="return /[a-z]/i.test(event.key)" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="lastname" name="lastname" value="<?php echo $admin['lastname']; ?>" onkeypress="return /[a-z]/i.test(event.key)" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-sm-3 control-label">mobile</label>

                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="mobile" name="mobile" value="<?php echo $admin['mobile']; ?>" onkeyup="ValueKeyPress('mobile');" required>
                            <span id="verify"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="photo" class="col-sm-3 control-label">Photo</label>

                        <div class="col-sm-9">
                            <input type="file" id="photo" name="photo">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="curr_password" class="col-sm-3 control-label">Current Password:</label>

                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="curr_password" name="curr_password" placeholder="input current password to save changes" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="save"><i class="fa fa-check-square-o"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="./../assets/js/main.js">
</script>

<script type="text/javascript">
    function changePass(){
        document.getElementById('change-pass').style.display='block';
        document.getElementById('change').style.display='none';
        document.getElementById('password').value='';
        document.getElementById('password-input').value='';
    }
</script>
