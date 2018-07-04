<div class="row">
    <div tabIndex class="section-boxSectionTitle3">
        <h2><?php echo $page->courses_list()->title()->upper() ?></h2>
        <ul class="pagination text-right " role="navigation" aria-label="Pagination">
            <!-- adding pagination controll - checking if there is enough articles to display -->
            <?php if($pagination->hasPrevPage()): ?>
                <li>
                    <a tabIndex id="prevLink" aria-label="Previous page" href="<?php echo $pagination->prevPageURL() ?>">
                        <span>&#10094;</span>
                    </a>
                </li>
            <?php endif; ?>
            <!-- adding headertext -->
            <?php if($pagination->hasNextPage()): ?>
                <li>
                    <a tabIndex id="nextLink" aria-label="Next page" href="<?php echo $pagination->nextPageURL() ?>">
                        <span>&#10095;</span>
                    </a>
                </li>
            <?php endif ?>
        </ul>
    </div>
    <?php $ctr=1; foreach($results as $item): ?>
        <a tabIndex href="<?php echo $item->url() ?>">
            <div class="section-boxSectionTitle4" style="border-top:<?php echo ($ctr==1)? 'solid 2px;' : 'solid 1px;'; ?>">
                <h3><?php echo $item->title()->text() ?></h3>
                <img src="<?php echo url() ?>/assets/images/next.png" class="img">
            </div>
        </a>
    <?php $ctr++; endforeach ?>
</div>
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