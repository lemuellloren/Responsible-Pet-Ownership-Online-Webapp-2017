<?php 
$getPet = $pets->where(array('user_id' => $getID))->all();
$result = $users->where(array('id' => $getID))->first();
$results = $users->where(array('id' => $getID))->all();
foreach ($results as $user) {
}
$result_pet = $pets->where(array('user_id' => $getID))->all();
if ($result_pet->count() < 1) {
    $result_pet = $pets->all();
    foreach ($result_pet as $pet) {
    }
}
?>

<div class="reveal" id="edit-profile" data-animation-out="fade-out" data-animation-in="fade-in" data-reveal>
    <div class="modal-header">
        <h3><?php echo $page->editProfile_button_text()->upper() ?></h3>
    </div>
    <br>
    
    <!-- display user image -->
    <div class="circle-profile align-center">
        <?php if ($user->image() == null): ?>
            <img id="previewingUser" src="<?php echo url() ?>/assets/images/users/avatar/default.png" alt="Profile Image" class="icon-choose-image">
        <?php else: ?>
            <img id="previewingUser" src="<?php echo url() . '/assets/images/users/avatar/' .  $result->image;?>" />
        <?php endif ?> 
    </div>
    <!-- display user image -->

    <!-- form to delete user image -->
    <form method="POST" action="api/deleteUserImage" id="deleteUserImage" style="display: none">
        <input type="hidden" name="userid" id="userid" value="<?php echo $getID; ?>"/>
    </form>
    <!-- end form to delete user image -->

    <!-- form to delete user image -->
    <form method="POST" action="api/deleteAccount" id="deleteAccount" style="display: none">
        <input type="hidden" name="userid" id="userid" value="<?php echo $getID; ?>"/>
    </form>
    <!-- end form to delete user image -->

    <!-- display upload image for profile -->
    <div style="text-align: center;">
        <div class="profile-actions" >
            <div style="display: inline-block; vertical-align: middle;"></div>
            <div style="display: inline-block; vertical-align: middle;"></div>
            <?php $users = db::table('users'); if($checkIfImageNull = $users->select(array('image'))->where(array('id' => $getID))->all()) ?>
            <?php foreach ($checkIfImageNull as $imageNull): $has_image = $imageNull->image == null; ?>
                <form id="uploadForm" method="post" style="display: inline-block;">
                    <div id="targetOuter">
                        <input type="hidden" name="userid" id="userid" value="<?php echo $getID; ?>"/>
                        <div class="fileUpload btnOne radial" style="display: <?php echo $has_image ? 'inline-block' : 'none' ?>; width: 150px; vertical-align: middle;margin:0;">
                            <span><?php echo $page->upload_image_text()->text() ?></span>
                            <input name="userImage" id="userprofImage" type="file" class="upload inputFile" accept="image/x-png,image/gif,image/jpeg,image/png"  onChange="showPreview(this);" />
                        </div>
                        <button id="delete-image" class="btnOne radial" style="display: <?php echo $has_image ? 'none' : 'inline-block' ?>"><?php echo $page->delete_image_text()->text() ?></button>
                    </div>
                    

                </form>
            <?php endforeach ?>
        </div>
        <!-- end display user profile image -->

        <!-- form to upload user image -->
        <form id="uploadprofileImage" method="post" style="display: block;">
            <div class="grid-x grid-padding-x" id="form-gr">
                <div class="large-6 cell">
                    <input type="text" value="<?php echo $result->firstname;?>" name="firstname" id="firstname" required="" placeholder="First Name">
                </div>

                <div class="large-6 cell" id="form-gr-child">
                    <input type="text" value="<?php echo $result->lastname;?>" name="lastname" id="lastname" required="" placeholder="Last Name">
                </div>
            </div>

            <div class="grid-x grid-padding-x" id="form-gr">
                <div class="large-6 cell">
                    <input type="text" value="<?php echo $result->postcode;?>" name="postcode" id="postcode" required="" placeholder="Post Code">
                </div>
                <div class="large-6 cell" id="form-gr-child">
                    <input type="email" value="<?php echo $result->email;?>" name="email" id="email" required="" placeholder="Email">
                </div>
            </div>
            <input type="hidden" name="userid" id="userid" value="<?php echo $getID; ?>"/>
        </form>
        <!-- end form to upload user image -->

        <!-- select pet dropdown -->
        <span class="sep-line"></span>
        <select id="select-pet">
            <option value="0">Choose pet</option>
            <?php
                foreach( $getPet as $pet ){
                    snippet('petselect', compact('pet'));
                }
            ?>
            <option value="Add Pet"><?php echo $page->addPet_button_text()->text() ?></option>
        </select>
        <div id="pet-hidden-input">    
            <?php 
                foreach($getPet as $pet){
                    snippet('pethiddeninput', compact('pet'));
                }
            ?>
            <!-- end select pet dropdown -->
        </div>

        <!-- form to Delete pet image -->
        <form method="POST" action="api/deletePetImage" id="deletePetImage" style="display: none">
            <input type="hidden" name="userid" id="userid" value="<?php echo $getID; ?>"/>
        </form>
        <!-- end form to Delete pet image -->

    <div class="hidden petInfo">
        <!-- form for editing or renaming pet -->
        <form id="editPetForm" method="POST">
            <div id="petForm">
                <div class="form-group" style="width: 100%">
                    <input type="text" name="ppetname" id="ppetname" value="" required/ placeholder="Pet Name">
                    <input type="hidden" name="ppetid" id="ppetid" value="0" />
                </div>

                <div class="circle-profile" id="previewingPetexist" style="display: block; margin: 0 auto; ">
                    <img id="previewingPet" src="<?php echo url() . '/assets/images/pets/' .  $result->image;?>" />
                </div>
            </div>
        </form>
        <!-- end form for editing or renaming pet -->

        <!-- form for adding new pet -->
        <form id="uploadNewPet" action="api/uploadNewPet" method="post">
            <div id="targetOuter">
                <input type="hidden" name="ppetid" id="ppetid" value="0" />
                <input type="hidden" name="pppetid" id="pppetid" value="0" />
                <input type="text" name="pppetname" id="pppetname" value="" required placeholder="Pet Name">

                <div class="circle-profile" style="display: block; margin: 0 auto; ">
                    <img id="previewingNewPet" src="<?php echo url() ?>/assets/images/pets/default2.png" />
                </div>

                <div class="fileUpload btnOne radial" style="width: 150px; display: inline-block; vertical-align: middle;">
                    <span><?php echo $page->upload_image_text()->text() ?></span>
                    <input name="petNewImage" id="usernnewpetImage" type="file" class="upload inputFile" accept="image/x-png,image/gif,image/jpeg,image/png" onChange="showNewPreviewPet(this);" />
                </div>
            </div>
        </form>
        <!-- end form for adding new pet -->

        <!-- Query if user's pet has image -->
        <?php $pets = db::table('pets'); if($checkIfPetImageNull = $pets->select(array('image'))->where(array('id' => $pet->id()))->all()) ?>
        <?php foreach ($checkIfPetImageNull as $petimageNull) : ?>
            <?php if($petimageNull->image =! null) : ?>
                <!-- End Query if user's pet has image -->
                <!-- Upload image from Dropdown -->
                <div id="showuploadFormPet" style="width: 100%; text-align: center; display: none; ">
                    <form id="uploadFormPet" action="api/uploadPetImageProfile" method="post" style="display: inline-block; text-align: center;width: 100%;padding-top: 10px;">
                        <div id="targetOuter">
                            <input type="hidden" name="ppetid" id="ppetid" value="0" />
                            <div class="grid-x">
                                <div class="small-6 cell deletePetCont" style="text-align: right;"><button class="btnThree radial" id="deletePet" style="display: inline;margin-right: 10px;min-width: 150px;"><?php echo $page->deletePet_button_text()->text() ?></button></div>
                                <div class="small-6 cell changeButton" style="text-align: left;" >
                                    <div class="deleteme">
                                       <button id="delete-petimage" class="btnOne radial " style="min-width: 150px;margin: 0 0 0 10px;"><?php echo $page->delete_image_text()->text() ?></button>
                                   </div>
                                   <div class="uploadme">
                                    <div class="fileUpload btnOne radial " style="display: inline-block; margin: 0 0 0 10px;min-width: 150px;text-align: center;">
                                        <span><?php echo $page->upload_image_text()->text() ?></span>
                                        <input name="petImage" id="userpetImage" type="file" class="upload inputFile" accept="image/x-png,image/gif,image/jpeg,image/png" onChange="showPreviewPet(this);" />
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </form>
            </div>
            <!-- End Upload image from Dropdown -->
        <?php else : ?>
            <!-- CTA if student select from dropdown -->
            <div style="text-align: center; padding-top: 15px;">    
                <div class="grid-x" style="display: inline">
                    <div class="small-6 cell" style="text-align: right; padding-right: 10px;"><button class="btnThree radial" id="deletePet" style="min-width: 150px;"><?php echo $page->deletePet_button_text()->text() ?></button></div>
                    <div class="small-6 cell changeButton" style="text-align: left; padding-left: 10px;"><button id="delete-petimage" class="btnOne radial" style="min-width: 150px;"><?php echo $page->delete_image_text()->text() ?></button></div>
                </div>
            </div>
            <!-- CTA if student select from dropdown -->
        <?php endif ?>
    <?php endforeach ?>
</div>

<!-- Edit Profile Footer -->    
<div style="text-align: center" class="addPet-Container">
    <span class="sep-line"></span>
    <div class="grid-x show-for-large hide-for-small">
        <div class="small-6 cell" id="divdelete-account"><button id="delete-account" class="btnThree radial"><?php echo $page->delete_account_text()->text() ?></button></div>
        <div class="small-6 cell" id="divsave-profile"><button id="saveProfile" class="btnOne radial" ><?php echo $page->edit_profile_save_button()->text() ?></button></div>
    </div>
    <div class="grid-x hide-for-large show-for-small">
        <div class="small-12 cell" ><button id="delete-accountM" class="btnThree radial"><?php echo $page->delete_account_text()->text() ?></button></div>
        <div class="small-12 cell" style="padding-top: 10px;"><button id="saveProfileM" class="btnOne radial" ><?php echo $page->edit_profile_save_button()->text() ?></button></div>
    </div>
    <div class="alert-box alert-box-save success callout hide" data-closable>
        <div class="text">
        </div>
        <button class="close-button-alert" aria-label="Dismiss alert" type="button" data-close>
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
<!-- End Edit Profile Footer --> 

<!-- Modal Close button -->
<button class="close-button" data-close aria-label="Close modal" type="button" autofocus>
    <img src="<?php echo url() ?>/assets/images/modal-close.png" alt="close" >
</button>
<!-- End Modal Close button -->
</div>


<!-- add pet -->
<?php snippet('addpet') ?>

<script type="text/javascript">
    $(document).ready(function (e) {
        // if user uploaded an profile image > submit #uploadForm
        $('#userprofImage').change(function() {
            $('#uploadForm').submit();
        });
        // if user uploaded an pet image > submit #uploadFormPet
        $('#userpetImage').change(function() {
            $('#uploadFormPet').submit();
        });

        // jquery for upload new pet form 
        $("#uploadNewPet").on('submit',(function(e) {
            var pppetname = $('#pppetname').val();
            var pppetid = $('#pppetid').val();
            e.preventDefault();
            $.ajax({
                url: "api/uploadNewPet?pppetname="+pppetname+'&pppetid='+pppetid,
                type: "POST",
                data:  new FormData(this),
                beforeSend: function(){$("#body-overlay").show(); disableButtons();},
                contentType: false,
                processData:false,
                dataType: 'json',
                success: function(data)
                {
                    $("#previewingNewPet").html(data);
                    setInterval(function() {$("#body-overlay").hide(); },500);
                    disableButtons(false);
                    updatePetList(data.pet_id, 'add', data.html);
                    $('#uploadNewPet')[0].reset();
                },
                error: function() 
                {
                    disableButtons(false);
                }           
            });
        }));

        // confirmation if user deletes an account
        $('#delete-account, #delete-accountM').click(function(e) {
            e.preventDefault();
            confirmBox('Are you sure?','Deleting your account is immediate and permanent', function(){
                deletethisaccount();
            });
        });

        // jquery deleting pet image
        $("#delete-petimage").click(function (e) {
            var ppetid = $('#ppetid').val();
            var form = $('#deletePetImage')[0];
            $.ajax({
                url: 'api/deletePetImage?ppetid='+ppetid,
                type: "POST",
                data:  new FormData(form),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    $("#editPetForm .circle-profile").append('<div class="loadingshit" style="position: relative;top: -110%;background: rgba(255, 255, 255, 0.77);width: 80px;height: 80px;margin: 0;padding: 21% 5% 0 0;color: #da4b08;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>')
                },
                complete: function(){
                    $("#editPetForm .circle-profile .loadingshit").remove();
                },
                success: function(data){
                    var alert = alertBox('Pet Image deleted!', 'success');
                    $('.addPet-Container').append(alert);
                    autoHide('', '');
                    $(".reveal-overlay").animate({ scrollTop: $(document).height() }, 1000);

                    $('#previewingPet').attr('src','<?php echo url() ?>/assets/images/pets/default2.png');
                    $('#uploadimagehide').css('display', 'inline-block');
                    $('#uploadFormPet .changeButton').addClass('deleteaction');
                    $('#uploadFormPet .deleteme').hide();
                    $('#uploadFormPet .uploadme').show();
                    $("#uploadFormPet .changeButton").removeClass('deleteaction');
                    
                },
                error: function(data){

                    var alert = alertBox(data.message, 'error');
                    $('.addPet-Container').append(alert);
                    autoHide('', '');
                    $(".reveal-overlay").animate({ scrollTop: $(document).height() }, 1000);
                }          
            });
        });

        // jquery for uploading pet image
        $("#uploadFormPet").on('submit',(function(e) {
            var ppetid = $('#ppetid').val();
            e.preventDefault();
            
            $.ajax({
                url: "api/uploadPetImageProfile?ppetid="+ppetid,
                type: "POST",
                data:  new FormData(this),
                beforeSend: function(){$("#body-overlay").show(); disableButtons(); },
                contentType: false,
                processData:false,
                beforeSend: function(){
                    $("#editPetForm .circle-profile").append('<div class="loadingshit" style="position: relative;top: -110%;background: rgba(255, 255, 255, 0.77);width: 80px;height: 80px;margin: 0;padding: 21% 5% 0 0;color: #da4b08;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>')
                },
                complete: function(){
                    $("#editPetForm .circle-profile .loadingshit").remove();
                },
                success: function(data)
                {   
                    var ibaseimae = $("#previewingPet").attr('src');
                    if (ibaseimae.indexOf("default2.png") >= 0 || $("#uploadFormPet .changeButton").hasClass('deleteaction')) {
                        $("#uploadFormPet .uploadme").show();
                        $("#uploadFormPet .deleteme").hide();
                    } else {
                        $("#uploadFormPet .uploadme").hide();
                        $("#uploadFormPet .deleteme").show();
                    }   
                    $("#uploadFormPet .changeButton").removeClass('deleteaction');
                    $("#previewingPet").html(data);
                    setInterval(function(){
                        $("#body-overlay").hide(); 
                        disableButtons(false);
                    },500);
                    updatePetList(data.pet_id, 'edit', data.html);
                },
                error: function(data) 
                {

                    var alert = alertBox('Error uploading image', 'error');
                    $('.petInfo').append(alert);
                    autoHide('', '');
                    disableButtons(false);
                }           
            });
        }));

        // jquery for user profile image
        $("#uploadForm").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "api/uploadUserImageProfile",
                type: "POST",
                data:  new FormData(this),
                beforeSend: function(){$("#body-overlay").show(); disableButtons(); },
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    $("#edit-profile > .circle-profile").append('<div class="loadingshit" style="position: relative;top: -110%;background: rgba(255, 255, 255, 0.77);width: 80px;height: 80px;margin: 0;padding: 21% 5% 0 0;color: #da4b08;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>')
                },
                complete: function(){
                    $("#edit-profile > .circle-profile .loadingshit").remove();
                },
                success: function(data)
                {
                    $('#imgs').attr('src',e.target.result);
                    $("#previewingUser").html(data);
                    setInterval(function() {
                        $("#body-overlay").hide(); 
                        disableButtons(false);
                    },500);
                    var ibaseimae = $("#previewingUser").attr('src');
                    
                    if (ibaseimae.indexOf("default.png") >= 0) {
                        $("#uploadForm").find(".fileUpload").show();
                        $("#uploadForm").find("#delete-image").hide();
                    } else {
                        $("#uploadForm").find(".fileUpload").hide();
                        $("#uploadForm").find("#delete-image").show();
                    }                    
                },
                error: function(data) 
                {
                    var alert = alertBox('Sorry, only JPG, JPEG, PNG & GIF files are allowed.', 'error');
                    $('.addPet-Container').append(alert);
                    autoHide('', '');
                    $(".reveal-overlay").animate({ scrollTop: $(document).height() }, 1000);
                    disableButtons(false);
                }           
            });
        }));

        // disable enter in add new pet
        $('#uploadNewPet').keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });

        // jquery updating user profile
        $("#saveProfile, #saveProfileM").click(function (e) {
            var petname = $('#pppetname').val();
            var selectpet = $('#select-pet').val();

            if( selectpet.toLowerCase() != 'add pet'){
                $('#uploadprofileImage').submit();
                $('#uploadNewPet').submit();
                $('#editPetForm').submit();

                var alert = alertBox('Saved Successfully', 'success');
                $('.addPet-Container').append(alert);
                $(".reveal-overlay").animate({ scrollTop: $(document).height() }, 1000);

            } else {
                if(petname.trim() == ""){

                   var alert = alertBox('Pet Name is Required', 'error');
                   $('.addPet-Container').append(alert);
                   autoHide('', '');
                   $(".reveal-overlay").animate({ scrollTop: $(document).height() }, 1000);

                } else {
                    $('#uploadprofileImage').submit();
                    $('#uploadNewPet').submit();
                    $('#editPetForm').submit();

                    var alert = alertBox('Saved Successfully', 'success');
                    $('.addPet-Container').append(alert);
                    $(".reveal-overlay").animate({ scrollTop: $(document).height() }, 1000);
                }
        }  
    });


        

        // jquery delete user profile image
        $("#delete-image").click(function (e) {
            var userid = $('#userid').val(),
            $btn_del = $(this),
            $btn_upl = $('#userprofImage').parent();
            var form = $('#deleteUserImage')[0];
            $.ajax({
                url: 'api/deleteUserImage?userid='+userid,
                type: "POST",
                data:  new FormData(form),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(data){
                    disableButtons(true);
                },
                success: function(data){
                    $btn_del.hide();
                    $btn_upl.show();
                    disableButtons(false);
                    $('#previewingUser').attr('src','<?php echo url() ?>/assets/images/users/avatar/default.png');
                    $('#imgs').attr('src','<?php echo url() ?>/assets/images/users/avatar/default.png');
                    var alert = alertBox('User Image deleted!', 'success');
                    $('.profile-actions').append(alert);
                    autoHide('', '');


                },
                error: function(data){
                    var alert = alertBox(data.message, 'error');
                    $('.profile-actions').append(alert);
                    autoHide('', '');
                    disableButtons(false);
                }          
            });
        });

        // jquery deleting pet
        $("#deletePet").click(function (e) {
            e.preventDefault();
            var ppetid = $("#ppetid").val();
            var form = $('#editPetForm')[0];
            confirmBox('Are you sure?',"This action is permanent and can't be undone.", function(){
                $.ajax({
                    url: 'api/deletepets?ppetid='+ppetid,
                    type: "POST",
                    data:  new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data){
                        $('#petForm').hide(100);
                        var alert = alertBox('Pet Deleted!', 'success');
                        $('.addPet-Container').append(alert);
                        $(".reveal-overlay").animate({ scrollTop: $(document).height() }, 1000);
                        autoHide('', '');
                        updatePetList(ppetid, 'delete');

                        // reset select pet to choose pet
                        $('#select-pet').val(0).trigger('change');
                    },
                    error: function(data){
                        var alert = alertBox(data.message, 'success');
                        $('.addPet-Container').append(alert);
                        $(".reveal-overlay").animate({ scrollTop: $(document).height() }, 1000);
                        autoHide('', '');
                    }          
                });
            });
        });

        var ispetsomechanged = false;

        $('#editPetForm').change(function(){
            ispetsomechanged = true;
        });

        $("#editPetForm").on('submit',(function(ex) {
            ex.preventDefault();

            var ppetid = $("#ppetid").val();
            var ppetname = $("#ppetname").val();

            $.ajax({
                url: 'api/renamepets?ppetid='+ppetid+'&ppetname='+ppetname,
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){
                    autoHide('', '');
                    if(data.html.list !== ''){
                        updatePetList(data.pet_id, 'edit', data.html);
                    }
                },
                error: function(data){
                    var alert = alertBox(data.message, 'error');
                    $('.addPet-Container').append(alert);
                    autoHide('', '');
                    $(".reveal-overlay").animate({ scrollTop: $(document).height() }, 1000);
                } 
            });
        }));

        var isprofilechecked = false;

        $('form#uploadprofileImage input').change(function(){
            isprofilechecked = true;
        });

        $("form#uploadprofileImage").on('submit',(function(e) {
            e.preventDefault();

            var getfirstname = $("#firstname").val();
            var getlastname = $("#lastname").val();
            var getpostcode = $("#postcode").val();
            var getemail = $("#email").val();
            var getuserid = $("#userid").val();
            var image = $("#profileimageUser").val();


            $.ajax({
                url: 'api/changeuserinfo',
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){
                    autoHide('', '');
                    updateUserProfile(data.html);
                },
                error: function(data){
                   var alert = alertBox(data.message, 'error');
                   $('.addPet-Container').append(alert);
                   autoHide('', '');
                   $(window).animate({scrollTop: $(document).height() + $(window).height()});
               }          
           });
            ischecked = false;            
        }));
    });

function deletethisaccount (){
    var form = $('#deleteAccount')[0];
    var userid = $('#userid').val();

    $.ajax({
        url: "api/deleteAccount?user_id"+userid,
        type: "POST",
        data:  new FormData(form),
        contentType: false,
        processData:false,
        success: function(data){
            window.location.href = "accounts"
        },
        error: function() 
        {
        }           
    });
}

function showNewPreviewPet(objFileInput) {
    if (objFileInput.files[0]) {
        disableButtons();
        $("#editPetForm .circle-profile").append('<div class="loadingshit" style="position: relative;top: -110%;background: rgba(255, 255, 255, 0.77);width: 80px;height: 80px;margin: 0;padding: 21% 5% 0 0;color: #da4b08;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
            $('#previewingNewPet').attr('src', e.target.result);
            disableButtons(false);
            $("#editPetForm .circle-profile .loadingshit").remove();
        }
        fileReader.readAsDataURL(objFileInput.files[0]);
    }
}

function showPreviewPet(objFileInput) {
    if (objFileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
            $('#previewingPet').attr('src', e.target.result);
        }
        fileReader.readAsDataURL(objFileInput.files[0]);
    }
}

function showPreview(objFileInput) {
    if (objFileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
            $('#blah').attr('src', '<?php echo url() ?>/' + e.target.result);
            $('#previewingUser').attr('src',e.target.result);
            $('#imgs').attr('src',e.target.result);
        }
        fileReader.readAsDataURL(objFileInput.files[0]);
    }
}

function validateFileType(){
    var idxDot = fileName.lastIndexOf(".") + 1;
    var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
    var image = $("#profileimageUser").val();
    if (extFile=="jpg" || extFile=="jpeg" || extFile=="png" || extFile=="png"){

    }else{
        $("#profileimageUser").val('');

        var alert = alertBox('Only image files are allowed. (.jpg, .png, .jpeg)', 'error');
        $('.addPet-Container').append(alert);
        autoHide('', '');
        $(".reveal-overlay").animate({ scrollTop: $(document).height() }, 1000);
    }
}

$(function () {
        //event
        $("#select-pet").change(getPetName);
        //functions
        function getPetName() {
            var $getName = $('option:selected', this).text();
            var $getId = $('option:selected', this).val();
            var $addnewpet = $('option:selected', this).val();
            var $changePetInfo = $('.petInfo');
            var image = $('#image-' + $getId).val();

            $('#previewingPet').attr('src', image);

            $('#ppetname').val($getName);
            $('#ppetid').val($getId);
            $('#petIdForImage').val($getId);



            if ($getId !== '0') {
                $changePetInfo.removeClass('hidden');
                $('#petForm').show(300);
                $('#showuploadFormPet').show(300);
            } else {
                $changePetInfo.addClass('hidden');
            }
            if(image !== undefined ){
                $(".changeButton > *").hide();
                if (image.indexOf("default2") >= 0) {
                    $('.changeButton > .uploadme').show();
                } else {
                    $('.changeButton > .deleteme').show();
                }
            }

            if ($addnewpet == 'Add Pet') {
                $('.changeButton > .uploadme').show();

                $('#ppetname').val('');
                $('#deletePet').css('display', 'none');
                $('#ppetname').css('display', 'none');
                $('#previewingPetexist').css('display', 'none');
                $('#uploadNewPet').css('display', 'block');
                $('#delete-petimage').css('display', 'none');
                $('#uploadFormPet .fileUpload').css('display', 'none');
            }
            else {
                $('#deletePet').css('display', 'inline');
                $('#ppetname').css('display', 'block');
                $('#previewingPetexist').css('display', 'block');
                $('#uploadNewPet').css('display', 'none');
                $('#delete-petimage').css('display', 'inline-block');
                $('#uploadFormPet .fileUpload').css('display', 'inline-block');
            } 
        }

        (function ($, window, document, undefined) {
            $('.inputfile').each(function () {
                var $input = $(this),
                $label = $input.next('label'),
                labelVal = $label.html();

                $input.on('change', function (e) {
                    var fileName = '';

                    if (this.files && this.files.length > 1)
                        fileName = (this.getAttribute('data-multiple-caption') || '').replace(
                            '{count}', this.files.length);
                    else if (e.target.value)
                        fileName = e.target.value.split('\\').pop();

                    if (fileName)
                        $label.find('span').html(fileName);
                    else
                        $label.html(labelVal);
                });

                // Firefox bug fix
                $input
                .on('focus', function () {
                    $input.addClass('has-focus');
                })
                .on('blur', function () {
                    $input.removeClass('has-focus');
                });
            });

            $('.inputfilepet').each(function () {
                var $input = $(this),
                $label = $input.next('label'),
                labelVal = $label.html();

                $input.on('change', function (e) {
                    var fileName = '';

                    if (this.files && this.files.length > 1)
                        fileName = (this.getAttribute('data-multiple-caption') || '').replace(
                            '{count}', this.files.length);
                    else if (e.target.value)
                        fileName = e.target.value.split('\\').pop();

                    if (fileName)
                        $label.find('span').html(fileName);
                    else
                        $label.html(labelVal);
                });

                // Firefox bug fix
                $input
                .on('focus', function () {
                    $input.addClass('has-focus');
                })
                .on('blur', function () {
                    $input.removeClass('has-focus');
                });
            });
        })(jQuery, window, document);

    });

function alertBox(message, type){

    var alert = '';

    if (type == 'success') {
        alert = '<div class="alert-box alert-box success callout" data-closable><div class="text">'+message+'</div><button class="close-button-alert" aria-label="Dismiss alert" type="button" data-close><span aria-hidden="true">&times;</span></button></div>';
    }
    else if (type == 'error') {
        alert = '<div class="alert-box alert-box alert callout" data-closable><div class="text">'+message+'</div><button class="close-button-alert" aria-label="Dismiss alert" type="button" data-close><span aria-hidden="true">&times;</span></button></div>';

    }

    return alert;
}

function autoHide(reload, url){
    setTimeout(    
        function()  
        {
            $('.alert-box').addClass('visible').fadeOut(function(){
                if(reload == 'reload' && typeof url !== 'undefined'){ 
                    window.location.href = url;
                }
                else if(reload == 'reload'){
                    window.location.reload();
                }
            });

        }, 
        2000
        );
}

function disableButtons(disable){
    var _disable = typeof disable !== 'undefined' ? disable : true;
    var $btns = $('#saveProfile, #delete-account, #delete-image, #deletePet, #userpetImage');
    $btns.prop('disabled', _disable);
}

/* 
 *  add, remove, edit pet listing
 *  params:
 *      id => accepts number or null
 *      action => accepts string ('add', 'delete', 'edit')
 *      data => object containing html strings for adding/edit in the list, select and hidden
 */
function updatePetList(id, action, data){
    var pet_id  = typeof id !== 'undefined' && typeof id === 'number' ? id : 0,
        //--- pet list
        $list   = $('#petProfile'),

        //--- select dropdown for pets
        $select = $('#select-pet'),

        //--- hidden input containing url for the pet images
        $hidden = $('#pet-hidden-input');

    if( action === 'add' ){
        $list.append(data.list);
        $select.find('.js-pet-select-option').last().after(data.select);
        $hidden.append(data.hidden);
    }
    else if( action === 'delete' ){
        $list.find('[data-id="' + id + '"]').remove();
        $select.find('[value="' + id + '"]').remove();
        $hidden.find('[data-id="' + id + '"]').remove();
    }
    else if( action === 'edit' ){
        $list.find('[data-id="' + id + '"]').html(data.list);
        $select.find('[value="' + id + '"]').html(data.select);
        $hidden.find('[data-id="' + id + '"]').html(data.hidden);
    }
}

function updateUserProfile(html){
    var $container = $('#userProfile');
    $container.html(html);
}
</script>