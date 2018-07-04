<?php 
$getUsers = $users->where(array('id' => $getID))->first(); 
?>
<section id="contact-section" class="grid-container">
    <div class="row">
        <div class="section-boxSectionTitle2">
            <h2><?php echo $site->contact_title()->upper() ?></h2>
        </div>
        <center>
            <div class="contactPadding">
                <?php echo $site->cta_text()->kt() ?>
            </div>
            <?php if($site->cta_button_text()->isNotEmpty()): ?>
            <button class="btnOne radial contact" data-open="contact-modal"><?php echo $site->cta_button_text() ?></button>
            <?php endif; ?>
        </center>
    </div>
</section>

<!-- CONTACT MODAL --> 
<div class="reveal" id="contact-modal" data-animation-out="fade-out" data-animation-in="fade-in" data-reveal>
    <div class="modal-header">
        <h3><?php echo $site->contact_modal_text()->upper(); ?></h3>
    </div>
    <?php echo $site->contact_modalhead_text()->kt() ?>
    <form id="contact-form" data-success-msg="<?php echo $site->success_msg() ?>" method="post" name="desktop-form" >
        <div class="form-group">
            <div id="contact-modal-alert"></div>
        </div>
        <!--check if signed in-->
        <?php if(Session::hasOnlineAccess()): ?>
            <div class="signed-in-name">
                <h3></h3>
                <p></p>
            </div>
            <!--end of signed in-->
            <!--check if guest-->
        <?php endif; ?>

        <?php if(!Session::hasOnlineAccess()): ?>
            <div class="form-group">
                <input type="text" class="form-control" name="yourname" id="yourname" required/>
                <label for="yourname" class="animated-label"><?php echo $site->name_placeholder()->text(); ?></label>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="ctemail" id="ctemail" required/>
                <label for="ctemail" class="animated-label"><?php echo $site->email_placeholder()->text(); ?></label>
            </div>
        <?php else : ?> 
            <input type="hidden" name="yourname" id="yourname" value="<?php echo $getUsers->firstname(); ?>">
            <input type="hidden" name="ctemail" id="ctemail" value="<?php echo $getUsers->email() ?>">
        <?php endif ?> 

        <!--end of guest-->
        <div class="form-group">
            <input type="text" class="form-control" name="contactnum" id="contactnum" />
            <label for="contactnum" class="animated-label"><?php echo $site->phone_placeholder()->text(); ?></label>
        </div>
        <div class="form-group">
            <select class="" name="questions" id="questions" required/>
                <option value="0"><?php echo $site->subject_placeholder()->text() ?></option>
                <?php $siteData = $site->email_items()->toStructure();
                foreach($siteData as $item): ?>
                    <option value="<?php echo $item->reciever_email(); ?>"><?php echo $item->subject(); ?></option>
                <?php endforeach;?>
                <input type="hidden" name="getsubject" id="getsubject" value="0">
                <input type="hidden" name="getemail" id="getemail" value="0">
            </select>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="message" id="message" rows="6" /></textarea>
            <label for="message" class="animated-label-textarea"><?php echo $site->message_placeholder()->text() ?></label>
        </div>
        <div class="button-align">
            <button type="reset" class="btnThree radial"><?php echo $site->contact_modalbtn_reset() ?></button>
            <button type="submit" class="btnOne radial"><?php echo $site->contact_modalbtn_send() ?></button>
        </div>
        <div class="alert-box warning callout hide" id="alert-box-check" data-closable>
            <div class="text">
            </div>
            <button class="close-button-alert" aria-label="Dismiss alert" type="button" data-close>
                <span aria-hidden="true">&times;</span>
            </button>
        </div>    
    </form>
    <div class="modal-footer">
        <p>
            <?php echo $site->contact_privacy_text()?>
            <button data-open="privacy"><?php echo $site->privacy_link() ?>.</button>
        </p>
    </div>
    <button class="close-button" data-close aria-label="Close modal" type="button" autofocus>
        <img src="<?php echo url() ?>/assets/images/modal-close.png" alt="close" >
    </button>
</div>

<!-- END OF CONTACT MODAL -->
<script>
    $(function() {
        $('#contactnum').on('focusout', function(){
            if($(this).val() != ''){
                $(this).addClass('custom-control');
            }else{
                $(this).removeClass('custom-control');
            }
        });
        
        $('#message').on('focusout', function(){
            if($(this).val() != ''){
                $(this).addClass('custom-control');
            }else{
                $(this).removeClass('custom-control');
            }
        });

        $('select').on('change', function() {
            if ($(this).val()) {
                return $(this).css('color', '#000000');
            } else {
                return $(this).css('color', '#999b9c');
            }
        });

        // Contact modal 

        //get subject and email of the selected index on select element
        $('#questions').change(getSubjectEmail)
        function getSubjectEmail() {
            //get and assign the data of the selected index on variables  
            var getSubject =  $('option:selected',this).text();
            var getEmail = $('option:selected',this).val();
            $('#getsubject').val(getSubject);
            $('#getemail').val(getEmail);
        }

        // AJAX-FORM-VALIDATE        
        $('form#contact-form').on('submit',function(e){
            e.preventDefault();
            var form = $(this);
            var successMsg = $(this).data('success-msg');
            var getemail = $('option:selected',this).val();
            var getsubject =  $('option:selected',this).text();
            var contactnum = $('#contactnum').val();
            var message = $('#message').val();
            var email = document.getElementById('ctemail');
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var num_only = /^\d+$/;
            var $alert_box = $('#contact-modal-alert');
            var error_msg = '';

            if(false){

            }

            <?php if(!Session::hasOnlineAccess()): // guest user ?>
                else if($('#yourname').val() == '') {   
                    error_msg = alertBox("Please enter your name","error");
                } else if (!filter.test($('#ctemail').val())) {   
                    error_msg = alertBox("Please enter a valid email","error");
                }
            <?php endif; ?>

            else if($('#getemail').val() == "0"){   
                error_msg = alertBox("Please enter proper subject for the email","error");
            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo url() ?>/api/mailFormData',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(result){
                        // form data successfully reached form processor api
                        if(result.success){
                            // message successfully sent
                            <?php if(!Session::hasOnlineAccess()): // guest user ?>
                                $('#yourname').val("");
                                $('#ctemail').val("");
                            <?php endif; ?>
                            $('#contactnum').val("");
                            $('#message').val("");

                            $alert_box.html( alertBox(successMsg, "success") );
                            autoHide('reload');
                        } else {
                            // an issue was encountered
                            if(result.errors == undefined || result.errors == null || result.errors.length == 0){
                                // no validation errors - an email sending error was encountered
                                error_msg = alertBox("Please fill the the fields correctly!", "error");
                            } else {
                                // a validation error was encountered
                                if(result.errors.indexOf('yourname') != -1){
                                    error_msg = alertBox("Field 'Your Name' must not be empty.", "error");
                                }
                                if(result.errors.indexOf('ctemail') != -1){
                                    error_msg = alertBox("Please fill 'Your Email' field correctly!", "error");
                                }
                            }
                            $alert_box.html(error_msg);
                        }
                    },
                    error: function(result,statTxt){
                        //the form was unable to reach processor api
                        msg = 'Error '+ result.status + ' - unable to process form: ' + result.statusText + " (" + statTxt + ")";

                        error_mgs = alertBox('Please provide valid email!', "error");
                        $alert_box.html(error_msg);
                    }    
                });
            }
            $alert_box.html(error_msg);
        });
    });
</script>