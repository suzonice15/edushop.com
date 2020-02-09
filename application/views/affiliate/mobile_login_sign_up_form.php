<div class="container">
    <div class="row">
        <div class="col-md-6" style="margin-top: 70px">


            <form action="<?php echo base_url() ?>affiliate/mobile_login_check" method="post">
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <h6 class="form-text text-danger"><?php if (isset($error)) {
                                echo $error;
                            } ?></h6>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> Mobile Number</label>
                            <input type="text" class="form-control" name="user_email"
                                   placeholder="Enter Your Mobile Number" value="<?php if (isset($email)) {
                                echo $email;
                            }; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Password </label>
                            <input type="password" class="form-control" name="user_password"
                                   placeholder="Enter Your password" value="<?php if (isset($email)) {
                                echo $email;
                            }; ?>">
                        </div>
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">

                            <div class="btn-group mr-2" role="group" aria-label="Second group">
                                <input type="submit" id="user_login"  style="background-color: #138496" class="btn btn-success " value="Sign In">
                            </div>
                            <div class="btn-group" role="group" aria-label="Third group">
                                <a target="_blank" href="<?php echo base_url() ?>home/password_reset"
                                   style="margin-top: 11px;margin-left: 18px;">Forgot Your Password ?</a>

                            </div>
                        </div>
                    </div>
                </div>
            </form>


        </div>
        <div class="col-md-6">


            <form action="<?php echo base_url() ?>affiliate/mobile_sign_up_user" method="post">
                <div class="card">
                    <div class="card-header">
                        Signup
                    </div>
                    <div class="card-body">
                        <h6 class="form-text text-danger"><?php if (isset($signerror)) {
                                echo $signerror;
                            } ?></h6>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> Name</label>
                            <input type="text" name="user_f_name" class="form-control"
                                   placeholder="Enter Your Full Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Mobile </label>
                            <input name="user_mobile" id="mobile_user_mobile" type="text" class="form-control"
                                   placeholder="Enter your mobile">
                            <p id="mobile_user_mobile_error"></p>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Email </label>
                            <input name="user_email" id="mobile_user_email" type="email" class="form-control"
                                   placeholder="Enter your email">
                            <p id="mobile_user_email_error"></p>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> Password </label>
                            <input name="user_password" type="password" id="mobile_user_passwor_signup" class="form-control"
                                   placeholder="Enter your password">
                            <p id="mobile_user_passwor_signup_error"></p>


                        </div>
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">

                            <div class="btn-group mr-2" role="group" aria-label="Second group">
                                <input type="submit" style="background-color: #138496" id="user_login" class="btn btn-success btn-sm" value="Signup">
                            </div>

                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>

</div>
<script>
    $(document).ready(function () {

        $('#mobile_user_email').blur(function () {
            var error_email = '';
            var email = $('#mobile_user_email').val();
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!filter.test(email)) {
                $('#mobile_user_email_error').html('<label class="text-danger">Email address format is not correct</label>');
                $('#mobile_user_email_error .text-danger').fadeOut(50000000);


            }
            else {
                $('#mobile_user_email_error').html('');

                $.ajax({
                    url: "<?php echo base_url()?>Affiliate/email_check",
                    method: "POST",
                    data: {email: email},
                    success: function (result) {
                        if (result == 'unique') {
// $('#user_email_error').html('<label class="text-success">Ok,Unique</label>');

                        }
                        else {
                            $('#mobile_user_email_error').html('<label class="text-danger">Duplicated email Enter another email</label>');

                        }
                    }
                })
            }
        });


        $('#mobile_user_mobile').blur(function () {
            var error_email = '';
            var user_mobile = $('#mobile_user_mobile').val();
            if (!/^01\d{9}$/.test(user_mobile)) {
                $('#mobile_user_mobile_error').html("<span class='text-danger'>Invalid phone number: must have exactly 11 digits and begin with</span> ");
            } else {
                $('#mobile_user_mobile_error').html("");


                $.ajax({
                    url: "<?php echo base_url()?>Affiliate/phone_check",
                    method: "POST",
                    data: {phone: user_mobile},
                    success: function (result) {
                        if (result == 'unique') {
// $('#user_email_error').html('<label class="text-success">Ok,Unique</label>');

                        }
                        else {
                            $('#mobile_user_mobile_error').html('<label class="text-danger">This number already been registered, please reset your password or use another number . </label>');
                            $('#signUp"]').attr('disabled', 'disabled');

                        }
                    }
                });
            }
        });

        $('#mobile_user_passwor_signup').blur(function () {

            var passowrd = $('#mobile_user_passwor_signup').val();

            if (passowrd.length < 8) {
                $('#mobile_user_passwor_signup_error').html("<span class='text-danger'>Enter at least 8 digit password</span> ");
            } else {
                $('#mobile_user_passwor_signup_error').html("");
            }
        });

    });
</script>