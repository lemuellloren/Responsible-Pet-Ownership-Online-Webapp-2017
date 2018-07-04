<?php
    /*
     *  Template for each user's pet in select dropdown
     *  Displayed in user accounts page, edit profile modal
     *  also used for ajax query
     */
?> 
<option class="js-pet-select-option" value="<?php echo $pet->id();?>"><?php echo $pet->name(); ?></option>