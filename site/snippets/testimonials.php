<?php
if($site->show_testimonials()->bool()):
        // get all items from testimonial_items
    $testimonialData = $site->testimonial_items()->toStructure()->shuffle();
        // splitting the items into chunks
    $testimonialChunks = $testimonialData->chunk(4);
    $pageUrl = $page->title();
    $pageUrl == $pages->find('courses')->title();
    ?>

    <section id="testimonials-section" class="grid-container">
        <div class="row">
            <div id="carousel-container-testimonial" class="hide-for-small-only test-carousel">
              <input type="hidden" value="<?php echo $pageUrl ?>" id="pageurl">
              <input type="hidden" value="<?php echo $pages->find('courses')->title() ?>" id="pageurl-c">
              <ul>
                <!--SLIDER 4 ITEMS-->
                <?php $ctr = 1;
                foreach($testimonialChunks as $chunks) {
                      // get the length of elements of chunks
                    $chunkCount = count($chunks);
                    # check if the remainder is 0 - use the template 3/3/3/3 columns  
                    if ($chunkCount % 4 == 0) { ?>
                    <li class="<?php echo ($ctr == 1)? 'active' : ''; ?> orbit-slide">
                        <figure class="orbit-figure grid-x">
                            <?php foreach($chunks as $chunk): ?>
                                <div class="noPadding medium-3 large-3 cell">
                                    <div class="card">
                                        <img class="testi-img" src="<?php if($img = $site->image($chunk->author_image())) { echo thumb($img,array('width'=>640, 'height'=>480, 'crop'=>true))->url(); } ?>" alt="<?php echo $chunk->author_name() ?>" width="640" height="480">
                                        <div class="card-section">
                                            <img class="testi-quotes" src="<?php echo url() ?>/assets/images/quote.png" alt="quote">
                                            <p><strong><?php echo $chunk->testimonial()->kt() ?></strong></p>
                                            <p><?php echo "- ".$chunk->author_name().", ".$chunk->short_address() ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </figure>
                    </li>    
                    <!--SLIDER 4 ITEMS-->
                    <?php $ctr++;
                } elseif ($chunkCount == 3 || $chunkCount % 4 == 3) { ?>   
                <!--SLIDER 3 ITEMS -->
                <li class="<?php echo ($ctr == 1)? 'is-active' : ''; ?> orbit-slide">
                    <figure class="orbit-figure grid-x">
                        <?php foreach ($chunks as $chunk): ?>
                            <div class="noPadding medium-4 cell" style="height: 499px;">
                                <div class="card">
                                    <img class="testi-img" src="<?php if($img = $site->image($chunk->author_image())) { echo thumb($img,array('width'=>640, 'height'=>480, 'crop'=>true))->url(); } ?>" alt="<?php echo $chunk->author_name() ?>" width="640" height="480">
                                    <div class="card-section">
                                        <img class="testi-quotes-3-item" src="<?php echo url() ?>/assets/images/quote.png" alt="quote">
                                        <p><strong><?php echo $chunk->testimonial()->kt() ?></strong></p>
                                        <p><?php echo "- ".$chunk->author_name().", ".$chunk->short_address() ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>    
                    </figure>
                </li>
                <!--SLIDER 3 items -->
                <?php $ctr++;
            } elseif ($chunkCount == 2 || $chunkCount % 4 == 2) { ?> 
            <!--SLIDER 2 items  -->
            <li class="<?php echo ($ctr == 1)? 'is-active' : ''; ?> orbit-slide">
                <figure class="orbit-figure grid-x">
                    <?php foreach ($chunks as $chunk): ?>
                        <div class="noPadding medium-6 cell" style="height: 499px;">
                            <div class="card" style="padding-top: 340px; background: url(<?php if($img = $site->image($chunk->author_image())) { echo thumb($img,array('width'=>640, 'height'=>480, 'crop'=>true))->url(); } ?>) no-repeat; background-size: cover;">
                                <div class="card-section">
                                    <img class="test-quotes-2-item" src="<?php echo url() ?>/assets/images/quote.png" alt="quote">
                                    <p><strong class="testi-text-2-item"><?php echo $chunk->testimonial()->kt() ?></strong></p>
                                    <p><strong class="testi-author-2-item"><?php echo "- ".$chunk->author_name().", ".$chunk->short_address() ?></strong></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>    
                </figure>
            </li> 
            <?php $ctr++;
        } else { ?>
        <!--  SLIDER 1 item -->
        <li class="<?php echo ($ctr == 1)? 'is-active' : ''; ?> orbit-slide">
            <figure class="orbit-figure">
                <?php foreach ($chunks as $chunk): ?>
                    <div class="grid-x">
                        <div class="promo-content-section-img small-12 medium-6 cell" style="height: 499px;">
                            <img src="<?php if($img = $site->image($chunk->author_image())) { echo thumb($img,array('width'=>640, 'height'=>480, 'crop'=>true))->url(); } ?>" class="thumbnail testi-image" alt="<?php echo $chunk->author_name() ?>" width="640" height="480">
                        </div>
                        <div class="noPadding cell testi-text-one-item-container small-12 medium-6">
                            <h2 class="paddingTop"><img class="testi-quotes-big" src="<?php echo url() ?>/assets/images/quote.png" alt="quote"></h2>
                            <div class="testi-text-one-item"><?php echo $chunk->testimonial()->kt() ?></div>
                            <div class="testi-author">
                                <h5><?php echo "- ".$chunk->author_name().", ".$chunk->short_address() ?></h5>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>  
            </figure>
        </li> 
        <!-- END SLIDER 1 item -->
        <?php $ctr++;
    }
}
?>
</ul>
</div>
<!--mobile  -->
<div id="carousel-container-testimonials" class="show-for-small-only test-carousel">
    <ul>
        <?php
        $ctr = 1;
        $testimonialData = $site->testimonial_items()->toStructure()->flip();
        foreach($testimonialData as $item): 
            if( $ctr <= 4 ):
                ?>
                <li class="is-active orbit-slide grid-x">
                    <figure class="orbit-figure small-12 cell">
                        <div class="noPadding">
                            <div class="card">
                                <img class="testi-img" src="<?php if($img = $site->image($item->author_image())) { echo thumb($img,array('width'=>640, 'height'=>480, 'crop'=>true))->url(); } ?>"
                                alt="<?php echo $item->author_name() ?>" width="640" height="480">
                                <div class="card-section">
                                    <img class="testi-quotes" src="<?php echo url() ?>/assets/images/quote.png" alt="quote">
                                    <p>
                                        <strong>
                                            <?php echo $item->testimonial()->kt() ?>
                                        </strong>
                                    </p>
                                    <p>
                                        <?php echo "- ".$item->author_name().", ".$item->short_address() ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </figure>
                </li>
                <?php $ctr++; endif; endforeach ?>
            </ul>
        </div>
        <!-- end mobile  -->
    </div>
</section>
<?php endif; ?>

<script type="text/javascript">

    $(document).ready(function(){

        var boxSection = '';
        var pageurl = $('#pageurl').val();
        var pageurlc = $('#pageurl-c').val();
        if(pageurl == pageurlc) {
          boxSection = 'section-boxSectionTitle1';
      } else {
          boxSection = 'section-boxSectionTitle2';
      }

      $('#carousel-container-testimonial').a11ycarousel({
        doResize: true,
        autoPlay: true,
        playInterval: 6000
    });

      $('#carousel-container-testimonials').a11ycarousel({
        doResize: true,
        autoPlay: true,
        playInterval: 6000
    });


      $('.test-carousel').find('.controls').addClass(boxSection);

      $('.test-carousel').find('.controls h2').html('<?php echo $site->testimonial_title()->title()->upper() ?>');
      

      let heading = $('#testimonials-section .controls .heading h2');

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