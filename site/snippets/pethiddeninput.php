<?php
    /*
     *  Template for each user's pet hidden input
     *  Found in user accounts page, edit profile modal
     *  also used for ajax query
     */

    $image = $pet->image() == null ? 'default2.png' : $pet->image();
?> 
<input type="hidden" id="image-<?php echo $pet->id();?>" data-id="<?php echo $pet->id() ?>" value="<?php echo url() ?>/assets/images/pets/<?php echo $image ?>">