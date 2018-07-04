<div class="reveal" id="change-pass" data-animation-out="fade-out" data-animation-in="fade-in" data-reveal>
    <div class="modal-header">
        <h3><?php echo $page->changePass_button_text()->upper() ?></h3>
    </div>
    <div id="changepass_success"></div>
    <form id="form-changepass" method="put" >
        <div class="form-group">
            <input type="password" class="form-control" name="oldpassword" id="oldpassword" required/>
            <label for="oldpassword" class="animated-label"><?php echo page('accounts')->current_password_text()->text()?></label>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="newpassword" data-maxlength="8" id="newpassword" required/>
            <label for="newpassword" class="animated-label"><?php echo page('accounts')->new_password_text()->text()?></label>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="cnewpassword" id="cnewpassword" required/>
            <label for="cnewpassword" class="animated-label"><?php echo page('accounts')->confirm_password_text()->text()?></label>
        </div>
        <p id="checkmatchpass" class="checkhide check-not"><?php echo page('accounts')->error_msg_if_password_not_matched()->text()?></p>
        <p id="checklengthpass" class="checkhide check-not"><?php echo page('accounts')->error_msg_if_password_is_short()->text()?></p>  
        <div class="modal-footer">
            <button class="btnOne radial" type="submit" href="#"><?php echo $page->change_password_submit_button()->text() ?></button>
        </div>
    </form>
    <button class="close-button" data-close aria-label="Close modal" type="button" autofocus>
        <img src="<?php echo url() ?>/assets/images/modal-close.png" alt="close" >
    </button>
</div>

    