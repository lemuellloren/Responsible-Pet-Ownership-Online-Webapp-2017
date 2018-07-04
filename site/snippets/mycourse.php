<section id="courseListing-section" class="grid-container">
    <div class="row">
        <div class="section-boxSectionTitle3">
            <h2><?php echo page('accounts')->my_course_text()->upper() ?></h2>
            <ul class="pagination text-right " role="navigation" aria-label="Pagination">
                <?php if($pagination->hasPrevPage()): ?>
                <li>
                    <a id="prevLink" aria-label="Previous page" href="<?php echo $pagination->prevPageURL() ?>">
                        &#10094;
                    </a>
                </li>
                <?php endif ?>
                <!-- adding headertext -->
                <?php if($pagination->hasNextPage()): ?>
                <li>
                    <a id="nextLink" aria-label="Next page" href="<?php echo $pagination->nextPageURL() ?>">
                       &#10095;
                    </a>
                </li>
                <?php endif ?>
            </ul>
        </div>
        <?php
            $getID = s::get('hasOnlineAccess'); 
            $sql = "SELECT c.title, c.uri FROM courses_users cu LEFT JOIN courses c ON cu.course_id = c.id WHERE cu.user_id = $getID ORDER BY cu.created DESC";
            $user_courses = db::query($sql)->paginate(5);
            $pagination = $user_courses->pagination();
        ?>
        <?php if(count($user_courses)): $ctr=1; foreach($user_courses as $course): ?>
            <a href="<?php echo url('courses').'/'.$course->uri ?>">
                <div class="section-boxSectionTitle4" style="border-top:<?php echo ($ctr==1)? 'solid 2px;' : 'solid 1px;'; ?>">
                    <h3>
                        <?php echo $course->title ?>
                    </h3>
                    <img src="<?php echo url() ?>/assets/images/next.png" class="img">
                </div>
            </a>
        <?php $ctr++; endforeach; endif; ?>
    </div>
</section>
<script type="text/javascript">
    // for pagination on course listing.
    $('#prevLink, #nextLink').click(function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        $.ajax({
            url: href,
            dataType: 'html',
            success: function(data){
                  $('#courseListing-section').html(data);
            },
            error: function(result,statTxt){
                  var msg = 'Error '+ result.status + ' - unable to fetch posts: ' + result.statusText + " (" + statTxt + ")";
                  alert(msg);
            }
        })
    });

</script>