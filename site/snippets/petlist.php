<?php
    /*
     *  Template for each user's pet
     *  Displayed in user accounts page
     *  also used for ajax query
     */
?>   
<div class="align-left-div pet-container" data-id="<?php echo $pet->id() ?>">
    <div class="grid-x">
        <div class="pet-title small-8 cell">
            <h1 id="petName" data-petid="<?php echo $pet->id() ?>"><?php echo $pet->name() ?></h1>
        </div>
        <div class="align-img small-4 cell">
            <div class="circle-profile"> 
                <?php if ($pet->image() == null): ?>
                    <img src="<?php echo url() ?>/assets/images/pets/default2.png" alt="Pet Image">
                <?php else: ?>
                    <img src="<?php echo url() . '/assets/images/pets/' . $pet->image() ?>" alt="Pet Image">
                <?php endif ?>    
            </div> 
        </div>
    </div>
</div>