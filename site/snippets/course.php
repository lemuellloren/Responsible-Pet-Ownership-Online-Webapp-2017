<?php
    // get the subpages of the course page.
$courseDetails = $data->children()->visible();
    // splitting the items into chunks
$courseChunks = $courseDetails->chunk(3);
$pageUrl = $page->title();
$chunkCount = 0;
$ctr = 1;

?>

<section id="course-section" class="grid-container">
    <div class="row">
        <!-- FOR DESKTOP SLIDER -->
        <div id="carousel-container-course" class="hide-for-small-only course-carousel">
            <ul>
              <?php $feature = Array(); 

              foreach($courseDetails as $subpage): ?>

              <?php if($subpage->content()->is_a_feature_course()->bool()) : 
              array_push($feature, array($subpage->content(), $subpage->image($subpage->mainImage()), $subpage->url(), $subpage->uid()));?>
          <?php endif; ?>

      <?php endforeach;  $courseChunk = array_chunk($feature, 3); ?>

      <?php $ctr = 1; foreach ($courseChunk as $key => $chunk) : ?>

      <li class="grid-x <?php echo ($ctr == 1)? 'active' : '' ; ?>">
          <?php $chunksCount = count($chunk);
          foreach ($chunk as $key => $value) : 
            if($chunksCount % 3 == 0) : ?>
            <figure class="medium-4 cell">
                <div class="course-one" <?php echo ($ctr == 1)? 'tabindex="0"' : '' ; ?> >
                    <?php 
                    
                    if($image = $value[1]): ?>

                    <div class='course-info1' style='background-image: url(<?php echo thumb($image,array('width'=>640, 'height'=>480, 'crop'=>true))->url(); ?>)'>
                    <?php endif;  ?>

                    <div class='description'>
                        <p><strong><?php echo $value[0]->title()->text() ?></strong></p>
                        <?php echo excerpt($value[0]->course_description()->kt(), 20, 'words') ?>
                        <div class="coursebutton-padding">
                            <a tabIndex="0" href="<?php echo $value[2] ?>" class="btnThree radial"><?php echo page('home')->viewCourse_button_text()?></a>
                            <?php if(!Session::hasOnlineAccess()): ?>
                                <button class="btnOne radial sign-in enrol" data-open="sign-in"><?php echo page('home')->enrollNow_button_text() ?></button>
                            <?php endif; ?>
                            <?php if ($getID) : ?>
                                <?php $userCourses = $courses_users->where(array('user_id' => $getID, 'uri' => $value[3]))->first(); ?>
                                <?php if(!$userCourses) : ?>
                                    <button class="btnOne radial enrol" class="enrollbutton" onclick="doenroll('<?php echo $value[3] ?>','<?php echo $getID ?>', '<?php echo $value[0]->title()->text() ?>', '<?php echo $value[2] ?>')"><?php echo page('home')->enrollNow_button_text() ?></button>
                                <?php endif; ?>
                                <form class="enrollform" method="post" >
                                    <input type="hidden" name="getid" class="getid" value="<?php echo $getID ?>">
                                    <input type="hidden" name="title" class="title" value="<?php echo $value[0]->title()->text() ?>">
                                    <input type="hidden" name="getCourse" class="getCourse" value="<?php echo $value[3] ?>">
                                </form>
                            <?php endif; ?>
                        </div>
                    </div> <!-- end description content -->
                </div> <!-- end coursebutton-padding div -->
            </div>
        </figure>
    <?php elseif ($chunksCount == 2 || $chunksCount % 3 == 2) : ?>
     <figure class="medium-6 cell">
        <div class="course-one" <?php echo ($ctr == 1)? 'tabindex="0"' : '' ; ?> >
            <?php $chunkImage = $subpage->mainImage();
            if($image = $value[1]): ?>
            <div class='course-info1' style='background-image: url(<?php echo thumb($image,array('width'=>640, 'height'=>480, 'crop'=>true))->url(); ?>)'>
            <?php endif; ?>
            <div class='description'>
                <p><strong><?php echo $value[0]->title()->text() ?></strong></p>
                <?php echo excerpt($value[0]->course_description()->kt(), 180) ?>
                <div class="coursebutton-padding">
                    <a tabIndex="0" href="<?php echo $value[2] ?>" class="btnThree radial"><?php echo page('home')->viewCourse_button_text() ?></a>
                    <?php if(!Session::hasOnlineAccess()): ?>
                        <button class="btnOne radial sign-in enrol" data-open="sign-in"><?php echo page('home')->enrollNow_button_text() ?></button>
                    <?php endif; ?>
                    <?php if ($getID) : ?>
                        <?php $userCourses = $courses_users->where(array('user_id' => $getID, 'uri' => $value[3]))->first(); ?>
                        <?php if(!$userCourses) : ?>                
                            <button class="btnOne radial enrol" class="enrollbutton" onclick="doenroll('<?php echo $value[3] ?>','<?php echo $getID ?>', '<?php echo $value[0]->title()->text() ?>', '<?php echo $value[2] ?>')"><?php echo page('home')->enrollNow_button_text() ?></button>
                        <?php endif; ?>
                        <form class="enrollform" method="post" >
                            <input type="hidden" name="getid" class="getid" value="<?php echo $getID ?>">
                            <input type="hidden" name="title" class="title" value="<?php echo $value[0]->title()->text() ?>">
                            <input type="hidden" name="getCourse" class="getCourse" value="<?php echo $value[3] ?>">
                        </form>
                    <?php endif; ?>
                </div>
                <!-- end description content -->
            </div>
            <!-- end description div -->
        </div>
    </div>
</figure>
<?php else : ?>
    <figure>
        <div class="grid-x promo-content-section">
            <div class="promo-content-section-img small-12 medium-6 cell">
                <?php
                $chunkImage = $subpage->mainImage();
                if($image = $value[1]): ?>
                <img src="<?php echo thumb($image,array('width'=>640, 'height'=>480, 'crop'=>true))->url(); ?>" class="thumbnail" alt="promo image" width="640" height="480">
            <?php endif; ?>
        </div>
        <div class="cell promo-content-section-block small-12 medium-6">
            <h2 class="textWhite paddingTop">
                <strong><?php echo $value[0]->title()->text() ?></strong>
            </h2>
            <p class="textWhite"><?php echo excerpt($value[0]->course_description()->kt(), 180) ?></p>
            <div class="promobutton-padding">
                <a tabIndex="0" href="<?php echo $value[2] ?>" class="btnThree radial"><?php echo page('home')->viewCourse_button_text() ?></a>
                <?php if(!Session::hasOnlineAccess()): ?>
                    <button class="btnOne radial sign-in enrol" data-open="sign-in"><?php echo page('home')->enrollNow_button_text() ?></button>
                <?php endif; ?>
                <?php if ($getID) : ?>
                    <?php $userCourses = $courses_users->where(array('user_id' => $getID, 'uri' => $value[3]))->first(); ?>
                    <?php if(!$userCourses) : ?>
                        <button class="btnOne radial enrol" class="enrollbutton" onclick="doenroll('<?php echo $value[3] ?>','<?php echo $getID ?>', '<?php echo $value[0]->title()->text() ?>', '<?php echo $value[2] ?>')"><?php echo page('home')->enrollNow_button_text() ?></button>
                    <?php endif; ?>
                    <form class="enrollform" method="post" >
                        <input type="hidden" name="getid" class="getid" value="<?php echo $getID ?>">
                        <input type="hidden" name="title" class="title" value="<?php echo $value[0]->title()->text() ?>">
                        <input type="hidden" name="getCourse" class="getCourse" value="<?php echo $value[3] ?>">
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</figure>

<?php endif ?>
<?php  endforeach ?>
</li>


<?php $ctr++; endforeach ?>
</ul>
</div>
<!-- END FOR DESKTOP SLIDER -->
<!--  FOR MOBILE SLIDER -->

<div id="carousel-container-course-mobile" class="show-for-small-only course-carousel">
    <ul>
        <?php $ctr2 = 1; foreach($courseDetails as $item): 
        if( $ctr2 <= 4 ):
         if($item->is_a_feature_course() == '1') : ?>
         <li class="<?php echo ($ctr2 == 1)? 'is-active' : ''; ?> orbit-slide">
            <figure class="orbit-figure">
                <div class="course-one">
                    <div class="medium-4 cell course-one" style="background: url('<?php echo ($image = $item->mainImage()->toFile()) ? thumb($image,array('width'=>640, 'height'=>480, 'crop'=>true))->url() : ''; ?>');">
                        <div class='description'>
                            <p><strong><?php echo $item->title()->text() ?></strong></p>
                            <?php echo excerpt($item->course_description()->kt(), 50) ?>

                            <div class="coursebutton-padding">
                                <a tabIndex="0" href="<?php echo $item->url() ?>" class="btnThree radial"><?php echo page('home')->viewCourse_button_text() ?></a>
                                <?php if(!Session::hasOnlineAccess()): ?>
                                    <button class="btnOne radial sign-in enrol" data-open="sign-in"><?php echo page('home')->enrollNow_button_text() ?></button>
                                <?php endif; ?>
                                <?php if ($getID) : ?>
                                    <?php $userCourses = $courses_users->where(array('user_id' => $getID, 'uri' => $item->uid()))->first(); ?>
                                    <?php if(!$userCourses) : ?>
                                        <button class="btnOne radial enrol" class="enrollbutton" onclick="doenroll('<?php echo $item->uid() ?>','<?php echo $getID ?>', '<?php echo $item->title()->text() ?>', '<?php echo $item->url() ?>')"><?php echo page('home')->enrollNow_button_text() ?></button>
                                    <?php endif; ?>
                                    <form class="enrollform" method="post" >
                                        <input type="hidden" name="getid" class="getid" value="<?php echo $getID ?>">
                                        <input type="hidden" name="title" class="title" value="<?php echo $item->title()->text() ?>">
                                        <input type="hidden" name="getCourse" class="getCourse" value="<?php echo $item->uid() ?>">
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
        <?php $ctr2++; endif;  endif; endforeach ?>
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

    $(document).ready(function(){

        $('#carousel-container-course').a11ycarousel({
            doResize: true,
            autoPlay: true,
            playInterval: 5500
        });

        $('#carousel-container-course-mobile').a11ycarousel({
            doResize: true,
            autoPlay: true,
            playInterval: 5500
        });

        $('.course-carousel').find('.controls').addClass('section-boxSectionTitle3');

        $('.course-carousel').find('.controls h2').html('<?php echo page('home')->course_title_home()->title()->upper() ?>');

        let heading = $('#course-section .controls .heading h2');

        heading.each(function(){
            $(this).attr('title', $(this).text());
        });

        substrHeading(heading);

        $(window).resize(function(){

            substrHeading(heading);
        });


    });

    function substrHeading(heading){
        if($(window).width()<=375){
            heading.each(function(){
                let len=$(this).attr('title').length;
                if(len>16){
                    $(this).text($(this).attr('title').substr(0,16));
                }
            });
        }else{
         heading.text(heading.attr('title'));
     }
 }

</script>