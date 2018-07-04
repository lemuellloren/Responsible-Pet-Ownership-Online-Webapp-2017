<div class="reveal" id="changeImagePets" data-animation-out="fade-out" data-animation-in="fade-in" data-reveal>
    <div class="modal-header">
        <h3>Update image</h3>
    </div>
    <form action="api/uploadpetimage" enctype="multipart/form-data" method="post">
        <input type="file" name="file" data-multiple-caption="{count} files selected" class="inputfilet" id="forPetIme"/>
        <button style="text-align: center;" class="btnTwo radial" value="upload" id="editPetImage" type="submit">Change Image</button>
    </form>
    <button class="close-button" data-close aria-label="Close modal" type="button" autofocus>
        <img src="<?php echo url() ?>/assets/images/modal-close.png" alt="close" >
    </button>
</div>
