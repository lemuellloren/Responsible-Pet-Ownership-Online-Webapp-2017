<?php 
    $getPets = $pets->where(array('user_id' => $getID))->all();
    $result_user = $users->where(array('id' => $getID))->all();
    $result_pet = $pets->where(array('user_id' => $getID))->all();

    foreach ($result_user as $user) { }
?>
<div class="grid-x" style="<?php echo (count($getPets) == 0)? 'padding: 20px 0;' : 'padding: 0;'; ?>">
    <div class="small-12 medium-6 cell">
        <div id="userProfile">
            <?php snippet('userprofile', compact('user')); ?>
        </div>
        <div id="petProfile">
            <?php
                if( !empty( $getPets ) ){
                    foreach( $getPets as $pet ){
                        snippet('petlist', compact('pet'));
                    }
                }
            ?>
        </div> 
    </div>
    <div class="small-12 medium-6 cell button-position">
        <div class="footer-buttons" style="<?php echo (count($getPets) == 0)? 'top: 0;' : 'top:45%;'; ?>">
            <button data-open="change-pass" class="btnThree radial changepass"><?php echo $page->changePass_modal_title()->text() ?></button>
            <button data-open="edit-profile" class="btnTwo radial editprofile"><?php echo $page->editProfile_modal_title()->text() ?></button>
        </div>
    </div>
</div>

<div class="reveal" id="change-user-image" data-animation-out="fade-out" data-animation-in="fade-in" data-reveal>
    <div class="modal-header">
        <h3>Update image</h3>
    </div>

    <form action="api/uploadpetimage" enctype="multipart/form-data" method="post">
        <div class="addpetInfo" style="text-align:center; padding-top: 20px;">
            <input type="hidden" name="petid" id="petIdForImage" value="<?php echo (isset($pet) ? $pet->id() : ""); ?>">
            <input type="file" name="file"  style="width: 60%;" />
            <button style="text-align: center;" class="btnTwo radial" value="upload" id="editPetImage" type="submit">Change Image</button>
        </div>
    </form>

    <button class="close-button" data-close aria-label="Close modal" type="button" autofocus>
        <img src="<?php echo url() ?>/assets/images/modal-close.png" alt="close" >
    </button>
</div>