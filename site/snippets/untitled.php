<?php
    // get the subpages of the course page.
$courseDetails = $data->children()->visible();
    // splitting the items into chunks
$courseChunks = $courseDetails->chunk(3);
$pageUrl = $page->title();
$chunkCount = 0;
var_dump($courseChunks);
?>

<section id="course-section" class="grid-container">
    <div class="row">
        <!-- FOR DESKTOP SLIDER -->
        <div id="carousel-container-course" class="hide-for-small-only">
            <ul>
            <?php
            $ctr = 1;
            foreach ($courseChunks as $chunks) {

                // get the length of the elements of chunks.
                $chunksCount = 0;
                foreach ($chunks as $items ) {
                    if($items->is_a_feature_course() == '1'){
                        $chunksCount++;
                    }
                }
                if($chunksCount % 3 == 0){ //echo '3';?>
                <li class="<?php echo ($ctr == 1)? 'is-active' : ''; ?> orbit-slide">
                    <figure class="orbit-figure grid-x">
                        <?php foreach ($chunks as $chunk): ?>
                        <?php if($chunk->is_a_feature_course() == '1') : ?>
                        <div class="medium-4 cell course-one">
                            <?php $chunkImage = $chunk->mainImage();
                            var_dump($chunk->image($chunkImage));
                            if($image = $chunk->image($chunkImage)): ?>
                            <div class='course-info1' style='background-image: url(<?php echo thumb($image,array('width'=>640, 'height'=>480, 'crop'=>true))->url(); ?>)'>
                                        <?php endif;  ?>
                                <div class='description'>
                                    <p><strong><?php echo $chunk->title()->text() ?></strong></p>
                                    <?php echo excerpt($chunk->course_description()->kt(), 20, 'words') ?>
                                    <div class="coursebutton-padding">
                                        <a tabIndex="0" href="<?php echo $chunk->url() ?>" class="btnThree radial"><?php echo page('home')->viewCourse_button_text()?></a>
                                        <?php if(!Session::hasOnlineAccess()): ?>
                                            <button class="btnOne radial sign-in" data-open="sign-in"><?php echo page('home')->enrollNow_button_text() ?></button>
                                        <?php endif; ?>
                                        <?php if ($getID) : ?>
                                            <?php $userCourses = $courses_users->where(array('user_id' => $getID, 'uri' => $chunk->uid()))->first(); ?>
                                            <?php if(!$userCourses) : ?>
                                                <button class="btnOne radial" id="enrollbutton" onclick="doenroll('<?php echo $chunk->uid() ?>','<?php echo $getID ?>', '<?php echo $chunk->title()->text() ?>', '<?php echo $chunk->url() ?>')"><?php echo page('home')->enrollNow_button_text() ?></button>
                                            <?php endif; ?>
                                                <form id="enrollform" method="post" >
                                                    <input type="hidden" name="getid" id="getid" value="<?php echo $getID ?>">
                                                    <input type="hidden" name="title" id="title" value="<?php echo $chunk->title()->text() ?>">
                                                    <input type="hidden" name="getCourse" id="getCourse" value="<?php echo $chunk->uid() ?>">
                                                </form>
                                        <?php endif; ?>
                                    </div>
                                <!-- end description content -->
                                </div>
                                <!-- end coursebutton-padding div -->
                            </div>
                        </div>
                        <?php endif ?>
                        <?php endforeach; ?>
                    </figure>
                </li>
                <?php $ctr++;
            } elseif ($chunksCount == 2 || $chunksCount % 3 == 2) { //echo '2'; ?>
                <li class="<?php echo ($ctr == 1)? 'is-active' : ''; ?> orbit-slide">
                    <figure class="orbit-figure grid-x">
                        <?php foreach ($chunks as $chunk): ?>
                        <?php if($chunk->is_a_feature_course() == '1') : ?>
                            <div class="medium-6 cell course-one">
                                <?php $chunkImage = $chunk->mainImage();
                                if($image = $chunk->image($chunkImage)): ?>
                                    <div class='course-info1' style='background-image: url(<?php echo thumb($image,array('width'=>640, 'height'=>480, 'crop'=>true))->url(); ?>)'>
                                <?php endif; ?>
                                    <div class='description'>
                                        <p><strong><?php echo $chunk->title()->text() ?></strong></p>
                                        <?php echo excerpt($chunk->course_description()->kt(), 180) ?>
                                        <div class="coursebutton-padding">
                                            <a tabIndex="0" href="<?php echo $chunk->url() ?>" class="btnThree radial"><?php echo page('home')->viewCourse_button_text() ?></a>
                                            <?php if(!Session::hasOnlineAccess()): ?>
                                                <button class="btnOne radial sign-in" data-open="sign-in"><?php echo page('home')->enrollNow_button_text() ?></button>
                                            <?php endif; ?>
                                            <?php if ($getID) : ?>
                                                <?php $userCourses = $courses_users->where(array('user_id' => $getID, 'uri' => $chunk->uid()))->first(); ?>
                                                <?php if(!$userCourses) : ?>                
                                                    <button class="btnOne radial" id="enrollbutton" onclick="doenroll('<?php echo $chunk->uid() ?>','<?php echo $getID ?>', '<?php echo $chunk->title()->text() ?>', '<?php echo $chunk->url() ?>')"><?php echo page('home')->enrollNow_button_text() ?></button>
                                                <?php endif; ?>
                                                <form id="enrollform" method="post" >
                                                    <input type="hidden" name="getid" id="getid" value="<?php echo $getID ?>">
                                                    <input type="hidden" name="title" id="title" value="<?php echo $chunk->title()->text() ?>">
                                                    <input type="hidden" name="getCourse" id="getCourse" value="<?php echo $chunk->uid() ?>">
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                        <!-- end description content -->
                                    </div>
                                    <!-- end description div -->
                                    </div>
                            </div>
                        <?php endif ?>
                        <?php endforeach; ?>
                    </figure>
                </li>
                <?php $ctr++;
            } else { echo ''; ?>
                <li class="<?php echo ($ctr == 1)? 'is-active' : ''; ?> orbit-slide">
                    <figure class="orbit-figure grid-x">
                    <?php foreach ($chunks as $chunk): ?>
                        <?php if($chunk->is_a_feature_course() == '1') : ?>
                            <div class="grid-x promo-content-section">
                                <div class="promo-content-section-img small-12 medium-6 cell">
                                        <?php
                                        $chunkImage = $chunk->mainImage();
                                        if($image = $chunk->image($chunkImage)): ?>
                                        <img src="<?php echo thumb($image,array('width'=>640, 'height'=>480, 'crop'=>true))->url(); ?>" class="thumbnail" alt="promo image" width="640" height="480">
                                    <?php endif; ?>
                                </div>
                                <div class="cell promo-content-section-block small-12 medium-6">
                                    <h2 class="textWhite paddingTop">
                                        <strong><?php echo $chunk->title()->text() ?></strong>
                                    </h2>
                                    <p class="textWhite"><?php echo excerpt($chunk->course_description()->kt(), 180) ?></p>
                                    <div class="promobutton-padding">
                                        <a tabIndex="0" href="<?php echo $chunk->url()?>" class="btnThree radial"><?php echo page('home')->viewCourse_button_text() ?></a>
                                        <?php if(!Session::hasOnlineAccess()): ?>
                                            <button class="btnOne radial sign-in" data-open="sign-in"><?php echo page('home')->enrollNow_button_text() ?></button>
                                        <?php endif; ?>
                                        <?php if ($getID) : ?>
                                            <?php $userCourses = $courses_users->where(array('user_id' => $getID, 'uri' => $chunk->uid()))->first(); ?>
                                            <?php if(!$userCourses) : ?>
                                                <button class="btnOne radial" id="enrollbutton" onclick="doenroll('<?php echo $chunk->uid() ?>','<?php echo $getID ?>', '<?php echo $chunk->title()->text() ?>', '<?php echo $chunk->url() ?>')"><?php echo page('home')->enrollNow_button_text() ?></button>
                                            <?php endif; ?>
                                            <form id="enrollform" method="post" >
                                                <input type="hidden" name="getid" id="getid" value="<?php echo $getID ?>">
                                                <input type="hidden" name="title" id="title" value="<?php echo $chunk->title()->text() ?>">
                                                <input type="hidden" name="getCourse" id="getCourse" value="<?php echo $chunk->uid() ?>">
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endforeach; ?>
                    </figure>
                </li>
                <?php $ctr++; 
            }
        } 
    ?>
<!-- END SLIDER 1 -->
</ul>
</div>

<!-- END FOR DESKTOP SLIDER -->
<!--  FOR MOBILE SLIDER -->

    <div id="carousel-container-course-mobile" class="show-for-small-only">
        <ul>
            <?php $ctr2 = 1; foreach($courseDetails as $item): ?>
            <?php if($item->is_a_feature_course() == '1') : ?>
                <li class="<?php echo ($ctr2 == 1)? 'is-active' : ''; ?> orbit-slide">
                    <figure class="orbit-figure">
                        <div class="course-one">
                            <div class="medium-4 cell course-one">
                                <?php if($image = $item->mainImage()->toFile()): ?>
                                    <img src="<?php echo thumb($image,array('width'=>640, 'height'=>480, 'crop'=>true))->url(); ?>" class="thumbnail" style="border: none;" alt="promo image" width="640" height="480">
                                <?php endif; ?>
                                <div class='description'>
                                    <p><strong><?php echo $item->title()->text() ?></strong></p>
                                    <?php echo excerpt($item->course_description()->kt(), 50) ?>

                                    <div class="coursebutton-padding">
                                        <a tabIndex="0" href="<?php echo $item->url() ?>" class="btnThree radial"><?php echo page('home')->viewCourse_button_text() ?></a>
                                        <?php if(!Session::hasOnlineAccess()): ?>
                                            <button class="btnOne radial sign-in" data-open="sign-in"><?php echo page('home')->enrollNow_button_text() ?></button>
                                        <?php endif; ?>
                                        <?php if ($getID) : ?>
                                            <?php $userCourses = $courses_users->where(array('user_id' => $getID, 'uri' => $item->uid()))->first(); ?>
                                            <?php if(!$userCourses) : ?>
                                                <button class="btnOne radial" id="enrollbutton" onclick="doenroll('<?php echo $item->uid() ?>','<?php echo $getID ?>', '<?php echo $item->title()->text() ?>', '<?php echo $item->url() ?>')"><?php echo page('home')->enrollNow_button_text() ?></button>
                                            <?php endif; ?>
                                            <form id="enrollform" method="post" >
                                                <input type="hidden" name="getid" id="getid" value="<?php echo $getID ?>">
                                                <input type="hidden" name="title" id="title" value="<?php echo $item->title()->text() ?>">
                                                <input type="hidden" name="getCourse" id="getCourse" value="<?php echo $item->uid() ?>">
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                    <!-- end description content -->
                                </div>
                                <!-- end description div -->
                            </div>
                        </div>
                    </figure>
                </li>
            <?php endif ?>
            <?php $ctr2++; endforeach ?>
        </ul>
    </div>
    <!-- END FOR MOBILE SLIDER -->
</div>
</section>

<script type="text/javascript">
    function doenroll (courseuri,getid,title,url) {
        $.ajax({
            url: '<?php echo url() ?>/api/enrollcourses?getCourse='+courseuri+'&getid='+getid+'&title='+title,
            type: "POST",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                window.location.href = url;
            },
            error: function(data){
                alert('failed');
            }          
        });
    }; 
</script>

<script type="text/javascript">

    $(document).ready(function(){

        $('#carousel-container-course').a11ycarousel({
            doResize: true,
            autoPlay: true,
            playInterval: 3000
        });

        $('#carousel-container-course').find('.controls').addClass('section-boxSectionTitle1');

        $('#carousel-container-course').find('.controls h3').html('<?php echo page('home')->course_title_home()->title()->upper() ?>');

        $('#carousel-container-course-mobile').a11ycarousel({
            doResize: true,
            autoPlay: true,
            playInterval: 3000
        });

        $('#carousel-container-course-mobile').find('.controls').addClass('section-boxSectionTitle1');

        $('#carousel-container-course-mobile').find('.controls h3').html('<?php echo page('home')->course_title_home()->title()->upper() ?>');

    })

</script>