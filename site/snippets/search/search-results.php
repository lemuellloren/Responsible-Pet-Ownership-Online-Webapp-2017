<!-- SEARCH SECTION -->
<section id="searchResult-section">
    <div class="row">
        <div class="search-result">
            <?php if($results->count()) : ?>
                <?php foreach($results as $result): ?>
                <?php endforeach ?>
                <div class="search-title">
                <?php if($results->count() == 1) : ?>
                    <h1><?php echo $results->count().' '.$page->search_result_query()->text() ?></h1>
                <?php elseif($results->count() > 1) : ?>
                    <h1><?php echo $results->count().' '.$page->many_result()->text() ?></h1>
                <?php else : ?>
                    <h1><?php echo $page->nosearchfound()->text() ?></h1>
                <?php endif ?>

                    <h2>for "<?php echo esc($query) ?>"</h2>
                </div>                
            <?php else : ?>
                <div class="search-result-output">
                    <h1><?php echo $page->no_result()->text()->upper() ?></h1>
                    <h2>for "<?php echo esc($query) ?>"</h2>
                </div>
            <?php endif ?>
                <!-- if no results found hide this   -->  
            <?php if($results->count() != 0) : ?>     
                <div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit data-auto-play="true">
                    <div class="section-boxSectionTitle2">
                        <h3><?php echo $page->search_result_title()->text()->upper() ?></h3>
                        <ul class="pagination text-right " role="navigation" aria-label="Pagination">
                            <?php if($pagination->hasPrevPage()): ?>
                                <li>
                                    <a id="prevLink" aria-label="Previous page" href="<?php echo $pagination->prevPageURL() ?>">
                                        <span>&#10094;</span>
                                    </a>
                                </li>
                            <?php endif ?>
                                <!-- adding headertext -->
                            <?php if($pagination->hasNextPage()): ?>
                                <li>
                                    <a id="nextLink" aria-label="Next page" href="<?php echo $pagination->nextPageURL() ?>">
                                        <span>&#10095;</span>
                                    </a>
                                </li>
                            <?php endif ?>
                        </ul>
                    </div>
                    <ul>
                        <?php foreach($results as $result): ?>
                            <a href="<?php echo $result->url() ?>" class="searchLinks">
                                <div class="section-boxSectionTitle5">
                                    <h3><?php echo $result->title() ?></h3>
                                    <img src="<?php echo url() ?>/assets/images/next.png" class="img">
                                </div>
                            </a>
                        <?php endforeach ?> 
                    </ul>
                </div>
            <?php endif ?>
        <!-- end if no results found hide this   -->
        </div>
    </div>
</section>
