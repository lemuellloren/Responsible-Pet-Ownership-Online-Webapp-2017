<?php 
if($site->show_partners()->bool()):
    $parnterdata = $site->partner_items()->toStructure()->flip(); 
    $partnerChunks = $parnterdata->chunk(4);
    ?>
    <section id="partners-section" class="grid-container">


        <div class="row">

            <!-- desktop -->

            <div id="carousel-partner-desk" class="hide-for-small-only  partner-carousel">
                <ul class="list">
                <?php  // get all events
                $ctr = 1;
                foreach($partnerChunks as $chunks): 
                    $chunkCount = count($chunks); ?>
                    <li class="<?php echo ($ctr == 1)? 'active' : ''; ?> orbit-slide">
                        <figure class="orbit-figure grid-x">
                            <?php 
                            foreach($chunks as $chunk): ?>
                            <div class="medium-3 large-3 cell desktop-cell" style="margin: 0 auto">
                                <span data-tooltip aria-haspopup="true" class="has-tip bottom" data-disable-hover="false" title="<?php echo $chunk->partner_name() ?>">
                                    <?php if($chunk->partner_link()->isNotEmpty()) : ?>
                                        <a href="<?php echo $chunk->partner_link() ?>">
                                            <img src="<?php if($img = $site->image($chunk->partner_image())) { echo thumb($img,array('width'=>200,'height'=>200))->url(); } ?>" alt="<?php echo $chunk->partner_name()?>" width="200" height="200">
                                        </a>
                                    <?php else : ?>
                                        <img src="<?php if($img = $site->image($chunk->partner_image())) { echo thumb($img,array('width'=>200,'height'=>200))->url(); } ?>" alt="<?php echo $chunk->partner_name()?>" width="200" height="200">
                                    <?php endif ?>
                                </span>
                            </div>
                        <?php endforeach ?>
                    </figure>
                </li>
                <?php $ctr++; endforeach ?> 
            </ul>
        </div>

        <!-- end of desktop -->

        <!-- mobile -->

        <div id="carousel-partner-mob" class="show-for-small-only partner-carousel">
            <ul class="list">
                <?php
                $ctr2 = 1;
                        // get all events
                $data = $site->partner_items()->toStructure()->flip();
                        // loop through the colslection of events:
                foreach($data as $item): 
                 if( $ctr2 <= 4 ):
                    ?>                        
                    <li class="<?php echo ($ctr2 == 1)? 'active' : ''; ?> orbit-slide">
                        <figure class="orbit-figure small-12 cell">
                            <span data-tooltip aria-haspopup="true" class="has-tip bottom" data-disable-hover="false" title="<?php echo $item->partner_name() ?>">
                                <?php if($item->partner_link()->isNotEmpty()) : ?>
                                    <a href="<?php echo $item->partner_link() ?>">
                                        <img src="<?php if($img = $site->image($item->partner_image())) { echo thumb($img,array('width'=>200,'height'=>200))->url(); } ?>" alt="<?php echo $item->partner_name()?>" width="200" height="200">
                                    </a>
                                <?php else : ?>
                                    <img src="<?php if($img = $site->image($item->partner_image())) { echo thumb($img,array('width'=>200,'height'=>200))->url(); } ?>" alt="<?php echo $item->partner_name()?>" width="200" height="200">
                                <?php endif ?>
                            </span>  
                        </figure>
                    </li>
                    <?php $ctr2++; endif; endforeach ?>
                </ul>
            </div>

            <!-- end of mobile -->

        </div>

    </section>

    <script type="text/javascript">

      $(document).ready(function(){
        $('#carousel-partner-desk').a11ycarousel({
            doResize: true,
            autoPlay: true,
            playInterval: 6500
        });

        $('#carousel-partner-mob').a11ycarousel({
            doResize: true,
            autoPlay: true,
            playInterval: 6500
        });

        $('.partner-carousel').find('.controls').addClass('section-boxSectionTitle1');

        $('.partner-carousel').find('.controls h2').html('<?php echo site()->partners_title()->text()->upper(); ?>');

        let heading = $('#partners-section .controls .heading h2');

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


<?php endif; ?>