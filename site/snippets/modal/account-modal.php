<section id="account-modals">
    <div class="reveal" id="sign-in" data-animation-out="fade-out" data-animation-in="fade-in" data-reveal>
        <div class="modal-header">
            <h3><?php echo page('accounts')->signIn_modal_title()->upper() ?></h3>
        </div>
        <p><b><?php echo page('accounts')->signIn_modal_enterinfo()->text() ?></b></p>
        <div id="loginFlashBox" class="alert callout" data-closable>
            <p></p>
        </div>
        <form action="" id="loginUserForm">
            <div class="form-group">
                <input type="text" class="form-control" name="email" id="email" required />
                <label for="email" class="animated-label"><?php echo page('accounts')->signinplaceholderemail()->text() ?></label>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="userpass" required/>
                <label for="userpass" class="animated-label"><?php echo page('accounts')->signinplaceholderpasss()->text() ?></label>
            </div>
            <a href="javascript:void(0)" data-open="forgot-password"><?php echo page('accounts')->signIn_modal_forgotpass()->text() ?></a>
            <button type="submit" class="btnOne radial"><?php echo page('accounts')->signIn_button_text()->text() ?></button>
        </form>
        <p><?php echo page('accounts')->SignIn_modal_noaccount()->html() ?></p>
        <div class="modal-footer">
            <button class="create-acct btnThree radial" data-open="create-acct"><?php echo page('accounts')->createAccount_button_text() ?></button>
        </div>
        <button class="close-button" data-close aria-label="Close modal" type="button" autofocus>    
            <img src="<?php echo url() ?>/assets/images/modal-close.png" alt="close" >
        </button>
    </div>

    <!-- forgot password -->

    <div class="reveal" id="forgot-password" data-animation-out="fade-out" data-animation-in="fade-in" data-reveal>
        <div class="modal-header">
            <h3><?php echo page('accounts')->signIn_modal_forgotpass()->upper() ?></h3>
        </div>
        <p><b>Please enter your registered email address</b></p>
        <div id="forgot-password-alert"></div>
        <form id="changepasswords" method="post">
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="femail" required placeholder="Your email" />
            </div>
            <button type="submit" class="btnOne radial">Submit</button>
        </form>
        <button class="close-button" data-close aria-label="Close modal" type="button" autofocus>
            <img src="<?php echo url() ?>/assets/images/modal-close.png" alt="close" >
        </button>
    </div>


<!-- create account -->
    <div class="reveal" id="create-acct" data-animation-out="fade-out" data-animation-in="fade-in" data-reveal>
        <div class="modal-header">
            <h3><?php echo page('accounts')->createaccount_modal_title()->upper() ?></h3>
        </div>
        <p><b><?php echo page('accounts')->createaccount_modal_enterinfo() ?></b></p>
        <form action="" id="addUserForm">
            <div class="form-group">
                <div id="add-user-alert"></div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="firstname" id="firstname" required />
                <label for="firstname" class="animated-label"><?php echo page('accounts')->fname_placeholder() ?></label>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="lastname" id="lastname" required/>
                <label for="lastname" class="animated-label"><?php echo page('accounts')->lname_placeholder() ?></label>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="cemail" required/>
                <label for="cemail" class="animated-label"><?php echo page('accounts')->c_email_placeholder() ?></label>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="userpass" id="cuserpass" data-maxlength="8" required/>
                <label for="cuserpass" class="animated-label"><?php echo page('accounts')->cpassword_placeholder() ?></label>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="confirmPassword" id="cuserpassc" required/>
                <label for="cuserpassc" class="animated-label"><?php echo page('accounts')->cc_password_placeholder() ?></label>
            </div>
            <div id="checkvalidate" class="checkhide">
                <p id="checklength" class="check-not">* Password should be 8 or more characters long.</p>
                <p id="checkmatch"class="check-not">* Password and Confirm password should match.</p>
            </div>
            <div class="form-group">
                <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" name="postcode" id="postcode" required/>
                <label for="postcode" class="animated-label"><?php echo page('accounts')->cpostcode_placeholder() ?></label>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="petname" id="petname"/>
                <label for="petname" class="animated-label"><?php echo page('accounts')->petname_placeholder() ?></label>
            </div>
            <p> <?php echo page('accounts')->petname_message() ?></p>
            <div class="button-align">
                <button id="btnSubmit" type="submit" class="btnOne radial"><?php echo page('accounts')->createaccountbutton() ?></button>
            </div>
        </form>
        <div class="modal-footer">
            <p>
                <?php echo page('accounts')->termandconditions_agreement_text() ?>
                <button data-open="terms"><?php echo $site->terms_link() ?></button>
            </p>
        </div>
        <button class="close-button" data-close aria-label="Close modal" type="button" autofocus>
            <img src="<?php echo url() ?>/assets/images/modal-close.png" alt="close" >
        </button>
    </div>
<!-- create-acct -->
</section>


<script type="text/javascript">
    $(function(){
        //validate email
        $('#cemail').keyup(validateEmail);
        function validateEmail() {
            if($('#cemail').val() == "") {
                $('#cemail').removeClass("emailvalidate");
            } else{
                $('#cemail').addClass("emailvalidate");
            }
        }
        //check length on password
        $('#cuserpass').keyup(validateCharLength);

        function validateCharLength() {

            $('#checkvalidate').removeClass("checkhide");
            var text = $(this).val();
            var maxlength = $(this).data('maxlength');

            if(text.length >= maxlength){
                $('#checklength').addClass("checkhide");
            } else {
                $('#checklength').removeClass("checkhide");
            }
        }

        //check pass and confirm pass match
        $('#cuserpassc').keyup(validatePassMatch);

        function validatePassMatch() {
            var curpass = $('#cuserpass').val();
            var confirmpass = $(this).val();

            if(curpass == confirmpass){
                $("#checkmatch").addClass("checkhide");
            } else {
                $("#checkmatch").removeClass("checkhide");
            }
        }

        //add user
        $('#addUserForm').on('submit', function(e){
            e.preventDefault();
            var form = $(this);
            var email = document.getElementById('cemail');
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var error = '';
            //validate form

            //check if 'password' and 'confirm password' doesn't match, return error message.
            if($("#cuserpass").val() !== $("#cuserpassc").val()) {
                error = alertBox("Passwords don't match","error");
            } else if($("#cuserpass").val().length < 8 ) {
                error = alertBox("Password should be at least 8 characters long.","error");
            } else if (!filter.test(email.value)) {  
                error = alertBox("Invalid email format","error");
            } else {
                // submit request for registering user.
                $.ajax({
                    url: '<?php echo url() ?>/api/users',
                    type: 'POST',
                    data: form.serialize(),
                    success: function(data){
                        window.location = data.data.url;
                        // clearing the form
                        $("#cemail").removeClass("emailvalidate");
                        form[0].reset();
                        $('#create-acct').foundation('close');           
                    },
                    error: function(error){
                        $("#add-user-alert").html( alertBox(error.responseJSON.message,"error") );
                    }
                });
            }

            if(error !== '') $("#add-user-alert").html(error);
        });
    });

    (function(){
        // get the values on all fields on the form.
        var loginUser = {
            init: function(){ // call this function to start running our api.
                this.cacheDOM();
                this.bindEvents();
            },
            cacheDOM: function(){
                this.$form = $('#loginUserForm');
                this.$flashBox = $('#loginFlashBox');
                this.$p = this.$flashBox.find('p');
            },
            bindEvents: function(){
                this.$form.on('submit', this.loginUser.bind(this)); // we will bind the context into our parent object - loginUser
            },
            loginUser: function(e){
                e.preventDefault();
                // fire a request to the server.
                $.ajax({
                    url: '<?php echo url() ?>/api/users/login',
                    type: 'GET',
                    data: this.$form.serialize(),
                    success: this.loginRequestSuccess.bind(this),
                    error: this.loginRequestError.bind(this)
                });
            },
            loginRequestSuccess: function(data){
                // redirect to the my account page
                window.location = data.data.url;
            },
            loginRequestError: function(error){
                // this will render an html
                this.render(error.responseJSON.message);
            },
            render: function(errMsg){
                // we will display the flashbox.
                this.$flashBox.css('display', 'block').fadeTo('fast', 0.3).fadeTo('fast', 1).fadeTo('fast', 0.3).fadeTo('fast', 1);
                // displaying the message on the paragraph.
                this.$p.html(errMsg);
            }
        }

        // we will user our api loginUser
        // invoke the init method.
        loginUser.init();
    })();

    $('form#changepasswords').on('submit', function(e){
        e.preventDefault();
        var getEmail = $('#femail').val();
        $.ajax({
            url: "<?php echo url() ?>/api/forgotpassword",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                var msg = alertBox('Your new password was sent to your email',"success");
                $('#forgot-password-alert').html(msg);
                autoHide('reload');
            },
            error: function(data){
                var msg = alertBox('Your email is not registered!',"error");
                $('#forgot-password-alert').html(msg);
            }          
        })
    });
</script>
