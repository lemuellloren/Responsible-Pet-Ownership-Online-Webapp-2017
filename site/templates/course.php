<?php snippet('header'); ?>
<!-- HERO BANNER -->
<section id="hero-banner-course" class="grid-container">
    <div class="grid-x">
        <div class="left-banner-course small-12 medium-12 large-8 cell">
            <!-- Displays logo, course title and description -->
            <div class="medium-3 cell banner-logo">
                <?php if($img = $site->image($site->website_logo())):?>
                    <div style="display: inline;">
                        <img id="c_penrithlogo" class="penrithLogo" src="<?php echo $img->url() ?>" alt="<?php echo $page->title()->text() ?> Logo">
                    </div>
                <?php endif ?>
                <div id="c_title_desc_large" class="show-for-large hide-for-small">
                    <h1 class="orangeHeading"><?php echo $page->title(); ?></h1>
                    <?php echo $page->course_description()->kt() ?>
                </div>
            </div>

            <!-- Enroll button -->
            <form id="enroll" action="" method="post" style="text-align: center; ">
                <input type="hidden" value="<?php echo $page->uid() ?>" name="getCourse" id="getCourse">
                <input type="hidden" value="<?php echo $getID; ?>" name="getid" id="getid">
                <input type="hidden" value="<?php echo $page->title() ?>" name="title" id="title">
                <?php if($userCourses) : ?>
                    <button type="submit" id="submit" name="submit" class="btnOne radial" style="display: none;"><?php echo page('courses')->enrollNow_button_text()->text() ?></button>
                <?php else :?>
                    <?php if($getID) : ?>
                      <button name="sign-in" class="btnOne radial sign-in show-for-large hide-for-small" ><?php echo page('courses')->enrollNow_button_text()->text() ?></button>
                  <?php endif ?>
              <?php endif ?>
          </form>
          <!-- show progress bar if user is login for large screens --> 
          <?php if($userCourses) : ?>
             <div id="c_prgressbar_large" class="show-for-large hide-for-small">
                <p class="progress_count" style="text-align: right;margin-bottom: 0px;">Progress:  <?php echo '0%' ;?></p>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
            </div>
        <?php endif ?>
        <!-- Show course title and description for Mobile -->
        <div class="medium-9 cell heroArticle">
            <div class="hide-for-large">
                <h1 class="orangeHeading"><?php echo $page->title(); ?></h1>
                <?php echo $page->course_description()->kt() ?>
            </div>
            <form id="enroll1" action="" method="post" style="text-align: center;">
                <input type="hidden" value="<?php echo $page->uid() ?>" name="getCourse" id="mgetCourse">
                <input type="hidden" value="<?php echo $getID; ?>" name="getid" id="mgetid">
                <input type="hidden" value="<?php echo $page->title() ?>" name="title" id="mtitle">
                <?php if($userCourses) : ?>
                    <button type="submit" class="submit" name="submit" class="btnOne radial" style="display: none;"><?php echo page('courses')->enrollNow_button_text()->text() ?></button>
                <?php else :?>
                    <?php if($getID) : ?>
                      <button name="sign-in" class="btnOne radial sign-in show-for-small hide-for-large" ><?php echo page('courses')->enrollNow_button_text()->text() ?></button>
                  <?php endif ?>
              <?php endif ?>
          </form>
          <!-- PROGRESS BAR SIGNED IN -->
          <div class="banner-button">
            <!-- guest button -->
            <button class="btnOne radial hide sign-in" data-open="sign-in"><?php echo page('courses')->enrollNow_button_text()->text() ?></button>
            <!-- test pass buttons --><br>
            <button class="btnThree radial hide taketest" data-open="test-yourself"><?php echo page('courses')->tryTest_button_text()->text() ?></button>
            <a href="#" class="btnOne radial hide"><?php echo page('courses')->downloadCert_button_text()->text() ?></a>
            <!-- signed in buttons -->
            <?php if($userCourses) : ?>
                <div id="c_prgressbar_small" class="show-for-small hide-for-large">
                    <p class="progress_count" id="c_progress_count">Progress:  <?php echo '0%' ;?></p>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                </div>
            <?php endif ?>
            <div style="text-align: center;" id="alertwidthraw">
                <form id="frmWidthraw" method="post" style="display: inline; text-align: center">
                    <input type="hidden" value="<?php echo $page->uid() ?>" name="getCourse" id="wgetCourse">
                    <input type="hidden" value="<?php echo $getID; ?>" name="getid" id="wgetid">

                    <?php if($userCourses && $userCourses->status == 1) : ?>
                        <button type="submit" id="submitw" name="submit" class="btnThree radial" ><?php echo page('courses')->withdraw_button_text()->text() ?></button>
                    <?php endif ?>
                </form>
                <!-- Show download certificate if user meet requirements -->
                <?php if($userCourses && $userCourses->status == 1) : ?>
                  <button class="btnOne radial taketest trytest" style="display: <?php echo ($userCoursesScore->score() >= 8) ? 'inline-block' : 'none'; ?>;" data-open="test-yourself" id="take_test"><?php echo page('courses')->tryTest_button_text()->text() ?></button>
                  <div style="display: inline-block;" class="show-for-large hide-for-small">
                    <button style="display: <?php echo ($userCoursesScore->score() >= 8) ? 'block' : 'none'; ?>;" type="submit" class="btnOne radial" name="submit" id="submitCertDesktop"><?php echo page('courses')->downloadCert_button_text()->text() ?></button>
                </div>
                <button style="display: <?php echo ($userCoursesScore->score() < 8) ? 'inline-block' : 'none'; ?>;" class="btnOne radial taketest" data-open="test-yourself" id="take_test"><?php echo page('courses')->takeTest_button_text()->text() ?></button>
                <div class="show-for-small hide-for-large dlcertplaceholder" style="display: <?php echo ($userCoursesScore->score() >= 8) ? 'block' : 'none'; ?>;">
                    <button type="submit" class="btnOne mobilefixme radial" name="submit" id="submitCertMobile"><?php echo page('courses')->downloadCert_button_text()->text() ?></button>
                </div>                <?php endif ?>
            </div>

            <!-- show user's pet for desktop-->
            <div id="c_show_user_pet">
                <?php if($userCourses) : ?> 
                    <?php if($userCourses): ?>    
                        <form method="post" action="../api/dompdf" id="submitDomPdfDesktop" class="formss">
                            <p style="margin-bottom: 10px">Include in my certificate:</p> 
                            <?php
                            $thecurrent = "";
                            foreach (db::table('pets_courses')->select(array('created_at'))->where(array('user_id' => $getID, 'course_id' => $userCourses->course_id))->all() as $key => $value) {
                                $thecurrent = (strtotime($value->created_at()) > strtotime($thecurrent) ? $value->created_at() : $thecurrent);
                            }
                            $getperts = db::table('pets_courses')->select(array('user_id', 'course_id', 'pet_id'))->where(array('created_at' => $thecurrent, 'user_id' => $getID, 'course_id' => $userCourses->course_id))->all();
                            ?>
                            <?php $count = 1;
                            foreach($result_pet as $pets) :  ?>
                            <label class="checkboxContainer">
                                <?php

                                $pets_courses = db::table('pets_courses');
                                $getcourseid = $courses->select('id')->where(array('uri' => $page->uid()))->first();
                                $checkIfPetsSaved = $pets_courses->where(array('pet_id' => $pets->id(), 'course_id' => $getcourseid->id(), 'user_id' => $getID))->all();
                                if ($checkIfPetsSaved->count() !== 0){
                                    $checks = "checked";
                                } else {
                                    $checks = " ";
                                }
                                ?>
                                <p><input tabIndex="-1" type="checkbox" name="pets[]" <?php echo $checks; ?> value="<?php echo $pets->id();?>" onClick="savePetToDb('<?php echo $pets->id();?>')" class="savePetToDb" ><span tabindex="0" class="checkmark">
                                </span><?php echo ucwords($pets->name());?></p></label>

                                <?php $count ++; endforeach ?>
                                <?php foreach($result_user as $user) : ?>
                                    <?php foreach($result_pet as $pets) :  ?>
                                        <input type="hidden" name="getpetimage" value="<?php echo $pets->image();?>">
                                    <?php endforeach ?>
                                    <input type="hidden" name="getid" class="getid" value="<?php echo $getID ?>">
                                    <input type="hidden" name="getfirstname" id="getfirstname" value="<?php echo $user->firstname();?>">
                                    <input type="hidden" name="getlastname" id="getlastname" value="<?php echo $user->lastname();?>">
                                    <input type="hidden" name="getcourse_title" id="getcourse_title" value="<?php echo $getpagetitle?>">
                                    <input type="hidden" name="certificate_signatory" id="certificate_signatory" value="<?php echo $site->signatory()->text()?>">
                                    <input type="hidden" name="certificate_position" id="certificate_position" value="<?php echo $site->position()->text()?>">
                                    <input type="hidden" name="pageuid" id="pageuid" value="<?php echo $page->uid()?>">

                                    <?php if($img = $site->image($sigImage)):?>
                                        <input type="hidden" name="certificate_signature" id="certificate_signature" value="<?php echo thumb($img, array('height' => 73, 'quality' => 100))->filename(); ?>">
                                    <?php endif ?>
                                <?php endforeach;?>
                            </label>
                        </form>
                    <?php endif ?>
                <?php endif ?>
            </div>
            <?php if(!$getID) : ?>
                <div class="show-for-large hide-for-small" style="width: 90%; text-align: center; padding-left: 30%">    
                    <button class="btnOne radial sign-in" data-open="sign-in" aria-controls="sign-in" aria-haspopup="true" tabindex><?php echo page('courses')->enrollNow_button_text()->text() ?></button>
                </div>
                <div class="hide-for-large">    
                    <button class="btnOne radial sign-in" data-open="sign-in" aria-controls="sign-in" aria-haspopup="true" tabindex><?php echo page('courses')->enrollNow_button_text()->text() ?></button>
                </div>
            <?php endif ?>
            <!-- show user's pet for mobile devices -->
            <div id="showerror"></div>
        </div><br>
    </div>
</div>
<div class="right-banner-course show-for-large large-4 cell" style="background: url('<?php echo ($img = $page->image($getImage))? thumb($img,array('height' => 500, 'quality' => 100, 'crop'=>false))->url() : ''; ?>');">
</div>
</div>
</section>
<!-- END HERO BANNER -->

<!-- MODULE SECTION -->

<section class="modules grid-container">
    <div class="row">
        <ul class="accordion" data-allow-all-closed="true" data-accordion>

         <?php
         $getcourseid = db::table('courses')->where('uri', '=', $page->uid())->first();
         if(empty($getcourseid)) {
            go('/error');
        }
        $getcoursemodulesid = db::table('courses_modules')->where('course_id', '=', $getcourseid->id())->all();

        $count = 1; foreach($getcoursemodulesid as $item): ?>
        <?php $items = array();
        $items[] = $item->module_id(); 
        $sql = implode(' ', $items);
        ?>
        <?php $getModuleTitle = db::table('modules')->select('title, uri')->where(array('id' => $sql))->first() ?>
        <?php if($count ==  1 && $userCourses) : ?>
         <li class="accordion-item accordion is-active" data-accordion-item>
         <?php else : ?>
            <li class="accordion-item accordion" data-accordion-item>
            <?php endif ?>
            <?php if ($getID && $userCourses): ?>
                <a tabIndex href="#" class="accordion-title section-boxSectionTitle1">
                    <h3><?php echo $getModuleTitle->title() ?></h3>
                </a>  
            <?php else: ?>
                <div class="accordion-title accordion-title--disabled section-boxSectionTitle1">
                    <h3><?php echo $getModuleTitle->title() ?></h3>
                </div>  
            <?php endif ?>
            <?php
            $moduleUrl = page('modules')->children();
            // $slugItem= str::slug($getModuleTitle->title());
            $slugItem = $getModuleTitle->uri();
            $files = $moduleUrl->find($slugItem)->files();
            $mod_names = $moduleUrl->find($slugItem)->title();

            echo ' <div class="accordion-content" data-tab-content>';

            $filenames = page('modules')->children()->find($slugItem)->attachments()->split(',');
            if(count($filenames) < 2) $filenames = array_pad($filenames, 2, '');
            $filess = call_user_func_array(array(page('modules')->children()->find($slugItem)->files(), 'find'), $filenames);

            if ($getID):
                ?>
                <?php echo nl2br($moduleUrl->find($slugItem)->text()->kt()) ?>

                <?php
                $getCourseID = $courses->select(array('id'))->where(array('uri' => $page->uid()))->first();
                $getModulesID = $modules->select(array('id'))->where(array('title' => $getModuleTitle->title()))->first();
                $getCoursesModulesID = $courses_modules->select(array('id'))->where(array(
                    'course_id' => $getCourseID->id(),
                    'module_id' => $getModulesID->id()))
                ->first(); 

                $checkIfModulesIsCompleted = $users_courses_modules->where(array('courses_modules_id' => $getCoursesModulesID->id(), 'completed' => 1, 'user_id' => $getID))->all();
                if ($checkIfModulesIsCompleted->count() !== 0){
                    $check = "checked";
                } else {
                    $check = " ";
                }
                ?>


                <label class="checkboxContainer" style="margin-top: 30px; display: block"><input tabIndex="-1" id="id" type="checkbox" <? echo $check ?> name="completed<?php echo $count; ?>" value="<?php echo $get_progbar; ?>" onClick="getName('<?php echo urlencode($getModuleTitle->title()); ?>')" class="checkbox_mod" > <span tabIndex="0" class="checkmark"></span> <?php echo page('modules')->checkbox_label()->text()?></label>

            <?php endif ?>
        </div>
    </li>
    <?php $count++; endforeach ?>   

</ul>
</div>
</section>

<!-- END OF MODULE SECTION -->

<div class="reveal" id="test-yourself" data-animation-out="fade-out" data-animation-in="fade-in" data-reveal >
    <?php snippet('modal/test-modal', array('userCoursesScore' => $userCoursesScore)); ?>
</div>

<!-- CONTACT SECTION -->
<?php snippet('contact') ?>
<!-- END CONTACT SECTION -->

<!-- COURSE SECTION -->
<?php snippet('course' , array('data' => $pages->find('courses'))) ?>
<!-- END COURSE SECTION  -->

<!-- PARTNERS SECTION -->
<?php snippet('partners') ?>
<!-- END PARTNERS SECTION -->

<!-- FOOTER -->
<?php snippet('footer')?>

<script type="text/javascript">
    // get left div height and append it to image css
    $(function() {
        // var height = $(".left-banner-course").height();
        // $(".right-banner-course img").css({'height': height, 'width': '400px'});
    });

    // clear modal footer when open
    $('#test-yourself').on('open.zf.reveal', function() {
        $('#modal-footer').attr('style','display: none; ');
        $('#modal-footer-failed').attr('style','display: none; ');
    });

    $('.checkmark').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            if($(this).is(':focus')){
                $(this).click();

                //progress bar in module
                var emptyValue = 0;
                $('input.checkbox_mod:checked').each(function() {
                    emptyValue += parseInt($(this).val()) || 0;
                    if (emptyValue > 90) {
                        emptyValue = 100;
                    }
                });
                $("p.progress_count").html("Progress: " + emptyValue + '%');
                $('.progress-bar').css('width', emptyValue + '%').attr('aria-valuenow', emptyValue);
            }
        }
    });

    function savePetToDb(petids) {

        var course_uri = '<?php echo $page->uid(); ?>';
        var check;
        check = $(".savePetToDb").is(":checked");
        
        if(check) {
            $.ajax({
                url: '<?php echo url(); ?>/api/savePetToDb?course_uri='+course_uri+'&petids='+petids,
                type: "POST",
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){

                },
                error: function(data){
                }          
            })
        }
        // delete pet from db if pet unchecked
        else {
            $.ajax({
                url: '<?php echo url(); ?>/api/deletePetToDb?course_uri='+course_uri+'&petids='+petids,
                type: "POST",
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){

                },
                error: function(data){
                }          
            })           
        }
    }

    // save progressbar updates

    function getName(name) {

        var user_id = '<?php echo $getID; ?>';
        var course_uri = '<?php echo $page->uid(); ?>';
        var check;
        check = $(".checkbox_mod").is(":checked");
        if(check) {
            $.ajax({
                url: '<?php echo url(); ?>/api/saveModule?user_id='+user_id+'&name='+name+'&course_uri='+course_uri,
                type: "POST",
                //data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){

                },
                error: function(data){
                }          
            })
        }
        // delete module if unchecked
        else {
            $.ajax({
                url: '<?php echo url(); ?>/api/deleteModule?user_id='+user_id+'&name='+name+'&course_uri='+course_uri,
                type: "POST",
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){

                },
                error: function(data){
                }          
            })           
        }
    }

    //Enroll course
    $('#enroll').on('submit', function(e){
        e.preventDefault();
        var getCourse = $("#getCourse").val();
        var getid = $("#getid").val();
        var title = $("#title").val();

        $.ajax({
            url: "<?php echo url() ?>/api/enrollcourse",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                location.reload();
            },
            error: function(data){
                location.reload();
            }          
        })
    });
    
    //Enroll course
    $('#enroll1').on('submit', function(e){
        e.preventDefault();
        var getCourse = $("#mgetCourse").val();
        var getid = $("#mgetid").val();
        var title = $("#mtitle").val();

        $.ajax({
            url: "<?php echo url() ?>/api/enrollcourse",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                location.reload();
            },
            error: function(data){
                location.reload();
            }          
        })
    });
    //Widthraw Course
    $('#frmWidthraw').on('submit', function(e){
        e.preventDefault();

        var form = $('#frmWidthraw')[0];
        var getCourse = $("#wgetCourse").val();
        var getid = $("#wgetid").val();
        $.ajax({
            url: "<?php echo url() ?>/api/deletecourse?getCourse="+getCourse+'&getid='+getid,
            type: "POST",
            data:  new FormData(form),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                var alert = alertBox('Successfully withdrawn', 'success');
                $('#alertwidthraw').append(alert);
                autoHide('reload');
            },
            error: function(data){
                var alert = alertBox('Failed', 'error');
                $('#alertwidthraw').append(alert);
                autoHide('reload');

            }          
        });
    }); 


</script>