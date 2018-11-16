<div class="shop-sidebar">
    <!--TEXT WIDGET -->
    <div class=" text-widget">
        <button id="close_filter_area" class="pull-right">x</button>
        <h3>FILTER</h3>
    </div>

    <!--RANGE WIDGET-->
    <?php if(count($MatchingCategories) > 0): ?>
        <div style="font-size: 13px;margin: 0;padding: 0 0 8px 0;border-bottom: #2197C9 3px solid;">
            <h3 style="margin: 0 0 7px 10px;">Other Matching Categories</h3>
            <?php $__currentLoopData = $MatchingCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p style="margin: 0;">
                    <a onclick="closeCanvas();"
                       href="/filter/<?php echo e($category->category_id); ?>/search?search=<?php if ( isset( $_GET[ 'search' ] ) ) {
                           echo $_GET[ 'search' ];
                       }?>&view=<?php echo e($view); ?>"
                       style="color: #2197C9; margin: 8px 10px;">
                        <?php echo e($category->name); ?>

                    </a>
                </p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <?php if(count($RelatedCategories) > 0): ?>
        <div style="font-size: 13px;margin: 0;padding: 10px 0 8px 0;border-bottom: #2197C9 3px solid;">
            <h3 style="margin: 0 0 7px 10px;">Other Related Categories</h3>
            <?php $__currentLoopData = $RelatedCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p style="margin: 0;">
                    <a onclick="closeCanvas();"
                       href="/filter/<?php echo e($category->category_id); ?>/<?php echo e(lowercase(spacelessUrl($category->name))); ?>"
                       style="color: #2197C9; margin: 8px 10px;">
                        <?php echo e($category->name); ?>

                    </a>
                </p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <div class="rance-wrapper" id="mPriceRangeSlider">
        <div class="row MyFilterSlider">
            <div class="col-md-6 no-padding">
                <span class="minPrice pull-left" id="mp-slider-min" style="font-weight:bold;"><strong></strong></span>
            </div>
            <div class="col-md-6 no-padding">
                <span class="maxPrice pull-right" id="mp-slider-max"
                      style="color:font-weight:bold;"><strong></strong></span>
            </div>
        </div>

        <span><br/>
                         <div id="mslider-range"></div>
                        </span>

    </div> <!-- end rance wrapper div -->

    <!--TAG WIDGET-->
    <div class="coupon-accordion">
        <div class="search_display">
            <form autocomplete=off action="/search" method="GET" id="msearch_form">
                <input placeholder="Search..." id="ms" name="search" value="<?php if ( isset( $_GET[ 'search' ] ) ) {
                    echo $_GET[ 'search' ];
                }?>">
                <button class="button1" type="submit">
                </button>
            </form>
        </div>
        <!--
            From the loop below, Set the input checkbok ot an undersore replaced string of the spec and the spec option
            This is done so that each chekbox in a particular section will be unique
        -->
        <?php $filter_count = 0; ?>
        <?php $__currentLoopData = $category_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category_code => $category_values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
                <h3 class="show filter-heading" onclick="ToggleFilterSpecs('m<?php echo e(ReformatID($category_code)); ?>', 'mhead-icon')">
                    <i id="mhead-icon" class="fa fa-minus-circle" aria-hidden="true"></i>
                    <?php echo e(str_replace('_', ' ', explode("|", $category_code)[0])); ?>

                    <span class="Ftitle" style="display: none;">Spec Detail Name</span>
                </h3>
                <div id="m<?php echo e(ReformatID($category_code)); ?>" class="coupon-checkout<?php if ( $filter_count > 1 ) {
                    echo '-content';
                }?>">
                    <div class="scrollbar"></div>
                    <div>
                        <div class="catagory-list">
                            <ul>
                                <li>
                                    <div class="checkbox checkbox-primary">

                                        <?php if( strpos($category_code, '|range') !== false ): ?>
                                            
                                            
                                            <div>
                                                <span id="m<?php echo e(explode("|", $category_code)[0]); ?>-range-min"></span>
                                                <span class="pull-right"
                                                      id="m<?php echo e(explode("|", $category_code)[0]); ?>-range-max"></span>
                                            </div>
                                            
                                            <div id="m<?php echo e(explode("|", $category_code)[0]); ?>-range"></div>
                                            
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    init_range_slider(
                                                        "m<?php echo e(explode("|", $category_code)[0]); ?>-range",
                                                            <?php echo e(min($category_values)); ?>,
                                                            <?php echo e(max($category_values)); ?>,
                                                            <?php if(strpos($category_code, '-') !== false): ?>
                                                                "<?php echo e(explode("-", $category_code)[1]); ?>"
                                                    <?php else: ?>
                                                        "<?php echo e(''); ?>"
                                                            <?php endif; ?>,
                                                        "m<?php echo e(explode("|", $category_code)[0]); ?>-range-min",
                                                        "m<?php echo e(explode("|", $category_code)[0]); ?>-range-max",
                                                        "<?php echo e(explode("|", $category_code)[0]); ?>",
                                                            <?php if(isset($_GET[ 'fr_'.explode("|", $category_code)[0] ]) ): ?>
                                                                "<?php echo e(explode( "-",$_GET['fr_'.explode("|", $category_code)[0] ] )[0]); ?>"
                                                    <?php else: ?>
                                                        "<?php echo e(min($category_values)); ?>"
                                                            <?php endif; ?>,
                                                            <?php if(isset($_GET[ 'fr_'.explode("|", $category_code)[0] ]) && count(explode( "-",$_GET['fr_'.explode("|", $category_code)[0] ] )) >1 ): ?>
                                                                "<?php echo e(explode( "-",$_GET['fr_'.explode("|", $category_code)[0] ] )[1]); ?>"
                                                    <?php else: ?>
                                                        "<?php echo e(max($category_values)); ?>"
                                                    <?php endif; ?>
                                                );

                                                });
                                            </script>

                                        <?php else: ?>
                                            
                                            
                                            <div id="m<?php echo e(explode("|", $category_code)[0]); ?>">
                                                <?php $__currentLoopData = $category_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $spec_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <span class="FtitleOption" style="display: block;">
                                                                <a id="m<?php echo e(explode("|", $category_code)[0].$key); ?>"
                                                                   class='filter_option <?php if ( isset( $_GET[ 'f_' . explode( "|", $category_code )[ 0 ] ] ) ) {
                                                                       $url_spec_values = explode( ",", $_GET[ 'f_' . explode( "|", $category_code )[ 0 ] ] );
                                                                       if ( in_array( urlencode( $spec_value ), $url_spec_values ) ) {
                                                                           echo "active-checked";
                                                                       }
                                                                   } else {
                                                                       echo "";
                                                                   }
                                                                   ?>'
                                                                   href="#" onclick="$('#spinner').show();">
                                                                    <?php echo e($spec_value); ?>

                                                                    <span style="display: none;"><?php echo e(urlencode($spec_value)); ?></span>
                                                                </a>
                                                            </span>
                                                    <script type="text/javascript">
                                                        $(document).ready(function () {
                                                            generate_filter_element_url(
                                                                "m<?php echo e(explode("|", $category_code)[0].$key); ?>",
                                                                "m<?php echo e(explode("|", $category_code)[0]); ?>",
                                                                "<?php echo e(explode("|", $category_code)[0]); ?>",
                                                                "m",
                                                                "<?php echo e(urlencode($spec_value)); ?>",
                                                                "<?php echo e($spec_value); ?>"
                                                            );

                                                        });
                                                    </script>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <?php $filter_count ++; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
    <!--FEATURED PRODUCT-->

</div>