<div class="align-left-div profile">
    <div class="grid-x">
        <div class="profile-name small-8 cell">
            <h1 class="name"><?php echo $user->firstname() . ' ' . $user->lastname() ?></h1>
            <p class="email"><?php echo $user->email() ?></p>
        </div>

        <div class="align-img small-4 cell">
            <div class="circle-profile">
                <?php if ($user->image() == null): ?>
                    <img id="imgs" src="<?php echo url() ?>/assets/images/users/avatar/default.png" alt="Profile Image">
                <?php else: ?>
                    <img id="imgs" src="<?php echo url() . '/assets/images/users/avatar/' . $user->image() ?>" alt="Profile Image">
                <?php endif ?>  
            </div>
        </div>
    </div>
</div>