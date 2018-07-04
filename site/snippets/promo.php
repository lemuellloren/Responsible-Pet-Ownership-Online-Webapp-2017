        <section id="promo-section" class="grid-container">
            <div class="row">

                <div id="carousel-container-desk" class="hide-for-small-only promo-carousel">
                    <ul class="list">

                     <?php
                     $ctr = 1;
                     $data = page('home')->promo_items()->toStructure()->flip();
                     foreach($data as $item): ?>
                     <li class="<?php echo ($ctr == 1)? 'active' : ''; ?> orbit-slide">
                        <figure class="orbit-figure">
                            <div class="grid-x promo-content-section">
                                <div class="promo-content-section-img small-12 medium-6 cell" style="background: url('<?php if($img = page('home')->image($item->promo_image())) { echo thumb($img,array('width'=>640, 'height'=>480, 'crop'=>true))->url(); } ?>');
                                ">
                                <!-- <img src="" class="thumbnail" alt="promo image" width="640" height="480"> -->
                                <div id="overlap-circle-img">
                                    <?php if($item->promo_inset()->isNotEmpty()): ?>   
                                        <div class="promoCirle"><p><?php echo $item->promo_inset()->upper() ?></p></div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="cell promo-content-section-block small-12 medium-6">
                                <div class="promoHeading">
                                    <p class="textWhite paddingTop">
                                        <strong><?php echo $item->promo_title()->text() ?></strong>
                                    </p>
                                </div>
                                <!-- promo description -->
                                <?php echo $item->promo_description()->kt() ?>
                                <!-- end promo description -->
                                <div class="promobutton-padding">
                                    <?php if($item->btntxt_learnmore()->isNotEmpty() && $item->btntxt_learnmore_url()->isNotEmpty() ): ?>
                                        <a tabindex href="<?php echo $item->btntxt_learnmore_url() ?>" class="btnThree radial"><?php echo $item->btntxt_learnmore()->text() ?></a>
                                    <?php endif ?>
                                    <?php if($item->btntxt_download()->isNotEmpty() && ($file = $item->downloadable_file()->toFile())): ?>
                                        <a tabindex href="<?php echo $file->uri() ?>" class="btnFour radial"><?php echo $item->btntxt_download()->text() ?></a>
                                    <?php endif ?>
                                </div>
                                <div id="overlap-circle-content">
                                 <?php if($item->promo_inset()->isNotEmpty()): ?>  
                                    <div class="promoCirle-lg"><p><?php echo $item->promo_inset()->upper() ?></p></div>
                                <?php endif ?>  
                            </div>
                        </div>
                    </div>
                </figure>
            </li>
            <?php $ctr++; endforeach ?>
        </ul>
    </div>

    <div id="carousel-container-mob" class="show-for-small-only promo-carousel">
        <ul class="list">

         <?php
         $ctr = 1;
         $data = page('home')->promo_items()->toStructure()->flip();
         foreach($data as $item): 
            if( $ctr <= 4 ):
                ?>
                <li class="<?php echo ($ctr == 1)? 'is-active' : ''; ?> orbit-slide">
                    <figure class="orbit-figure">
                        <div class="grid-x promo-content-section">
                         <div class="promo-content-section-img small-12 medium-6 cell" style="background: url('<?php if($img = page('home')->image($item->promo_image())) { echo thumb($img,array('width'=>640, 'height'=>480, 'crop'=>true))->url(); } ?>');
                         height: 300px;">
                         <div id="overlap-circle-img">
                            <?php if($item->promo_inset()->isNotEmpty()): ?>   
                                <div class="promoCirle"><p><?php echo $item->promo_inset()->upper() ?></p></div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="cell promo-content-section-block small-12 medium-6">
                        <div class="promoHeading">
                            <p class="textWhite paddingTop">
                                <strong><?php echo $item->promo_title()->text() ?></strong>
                            </p>
                        </div>
                        <!-- promo description -->
                        <?php echo $item->promo_description()->kt() ?>
                        <!-- end promo description -->
                        <div class="promobutton-padding">
                            <?php if($item->btntxt_learnmore()->isNotEmpty() && $item->btntxt_learnmore_url()->isNotEmpty() ): ?>
                                <a tabindex href="<?php echo $item->btntxt_learnmore_url() ?>" class="btnThree radial"><?php echo $item->btntxt_learnmore()->text() ?></a>
                            <?php endif ?>
                            <?php if($item->btntxt_download()->isNotEmpty() && ($file = $item->downloadable_file()->toFile())): ?>
                                <a tabindex href="<?php echo $file->uri() ?>" class="btnFour radial"><?php echo $item->btntxt_download()->text() ?></a>
                            <?php endif ?>
                        </div>
                        <div id="overlap-circle-content">
                         <?php if($item->promo_inset()->isNotEmpty()): ?>  
                            <div class="promoCirle-lg"><p><?php echo $item->promo_inset()->upper() ?></p></div>
                        <?php endif ?>  
                    </div>
                </div>
            </div>
        </figure>
    </li>
    <?php $ctr++; endif; endforeach ?>
</ul>
</div>

</div>
</section>
<script type="text/javascript">

    $(document).ready(function(){

        $('#carousel-container-desk').a11ycarousel({
            doResize: true,
            autoPlay: true,
            playInterval: 5000
        });

        $('#carousel-container-mob').a11ycarousel({
            doResize: true,
            autoPlay: true,
            playInterval: 5000
        });

        $('.promo-carousel').find('.controls').addClass('section-boxSectionTitle1');

        $('.promo-carousel').find('.controls h2').html('<?php echo page('home')->promo_title()->text()->upper() ?>');


            //check highest height on the promo section and set it as all promo's height


            // Fix heights on page load
            equalizeHeights('#carousel-container-desk .promo-content-section');

        // Fix heights on window resize
        var iv = null;
        $(window).resize(function() {

            if(iv !== null) {
                window.clearTimeout(iv);
            }

            // Needs to be a timeout function so it doesn't fire every ms of resize
            iv = setTimeout(function() {
                equalizeHeights('#carousel-container-desk .promo-content-section');
            }, 120);
        });


        let heading = $('#promo-section .controls .heading h2');

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

 function equalizeHeights(selector) {
    var heights = new Array();

        // Loop to get all element heights
        $(selector).each(function() {

            // Need to let sizes be whatever they want so no overflow on resize
            $(this).css('min-height', '0');
            $(this).css('max-height', 'none');
            $(this).css('height', 'auto');

            // Then add size (no units) to array
            heights.push($(this).height());
        });

        // Find max height of all elements
        var max = Math.max.apply( Math, heights );

        // Set all heights to max height
        $(selector).each(function() {
            $(this).css('height', max + 'px');
        }); 
    }

</script>