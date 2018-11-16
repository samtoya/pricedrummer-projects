<?php
    include( 'connections/db_connect.php' );//connect to the database
    require 'include/header.php';
    require 'utilities/Category.php';

    $PRODUCT_OVERVIEW = "";

    $url = "http://gh.pricedrummer.com/api/lev1n2n3n4.php";

    $curl_channel = curl_init();
    curl_setopt( $curl_channel, CURLOPT_URL, $url );
    //curl_setopt($curl_channel, CURLOPT_PROXY, $proxy);
    curl_setopt( $curl_channel, CURLOPT_HEADER, false );
    curl_setopt( $curl_channel, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $curl_channel, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt( $curl_channel, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $curl_channel, CURLOPT_HTTPPROXYTUNNEL, 1 );
    curl_setopt( $curl_channel, CURLOPT_CONNECTTIMEOUT, 0 );

    $result[ 'EXE' ] = curl_exec( $curl_channel );
    $result[ 'INF' ] = curl_getinfo( $curl_channel );
    $result[ 'ERR' ] = curl_error( $curl_channel );


    curl_close( $curl_channel );

    if ( empty( $result[ 'ERR' ] ) ) {

// echo $result['EXE'];
        $Categories = json_decode( $result[ 'EXE' ], true );

    } else {
        echo $result[ 'ERR' ];
    }

    $retailer_delevery_sql    = 'SELECT * FROM `retailer_delevery`';
    $retailer_delevery_result = $conn->query( $retailer_delevery_sql );

?>
<div class="container-fluid">
    <div class="row">
        <nav class="hidden-xs">
            <?php include 'include/dashboard_navigation.php'; ?>
        </nav> <!-- end navigation -->
        <div class="col-md-11 col-lg-11 col-sm-11 col-xs-12 col-md-offset-2 col-lg-offset-2 col-sm-offset-3">
            <div class="row" id="CategoriesSelection">

                <div class="col-md-3 col-lg-3 col-sm-4">
                    <div class="cat-wrapper">
                        <div class="cat-header">
                            <h3>Select a category</h3>
                        </div>
                        <div class="cat-body">
                            <ul id="Categories_level_1">
                                <?php foreach ( $Categories as $Level1 ): ?>
                                    <li>
                                        <a href="javascript:void(0);" class="l1"
                                           onclick="setLevel2(this,'<?php echo $Level1[ 'name' ]; ?>','<?php echo $Level1[ 'category_ID' ]; ?>');">
                                            <?php echo $Level1[ 'name' ]; ?>
                                            <i class="fa fa-angle-right fa-2x pull-right"></i></a>
                                        <div class="has-sub">
                                            <ul id="Categories_level_2">
                                                <?php foreach ( $Level1[ 'lev2s' ] as $level2 ): ?>
                                                    <li>
                                                        <a href="javascript:void(0);" class="l2"
                                                           onclick="setLevel3(this,'<?php echo $level2[ 'name' ]; ?>','<?php echo $level2[ 'category_id' ]; ?>');">
                                                            <?php echo $level2[ 'name' ]; ?>
                                                            <?php if ( count( $level2[ 'lev3s' ] ) > 0 ) { ?> <i
                                                                    class="fa fa-angle-right fa-2x pull-right"></i> <?php } ?>
                                                        </a>
                                                        <div class="has-sub">
                                                            <ul id="Categories_level_3">
                                                                <?php foreach ( $level2[ 'lev3s' ] as $level3 ): ?>
                                                                    <li>
                                                                        <a href="<?php if ( count( $level3[ 'lev4s' ] ) < 1 ) {
                                                                            echo "overview.php?Cid=" . $level3[ 'category_id' ];
                                                                        } else {
                                                                            echo "javascript:void(0);";
                                                                        }
                                                                        ?>" class="l3"
                                                                           onclick="setLevel4(this,'<?php echo $level3[ 'name' ]; ?>','<?php echo $level3[ 'category_id' ]; ?>'); <?php if ( count( $level3[ 'lev4s' ] ) < 1 ) {
                                                                               echo "$('#Current_Category').val(" . $level3[ 'category_id' ] . ");";
                                                                           }
                                                                           ?> ">
                                                                            <?php echo $level3[ 'name' ]; ?>
                                                                            <?php if ( count( $level3[ 'lev4s' ] ) > 0 ) { ?>
                                                                                <i class="fa fa-angle-right fa-2x pull-right"></i> <?php } ?>
                                                                        </a>
                                                                        <div class="has-sub">
                                                                            <ul id="Categories_level_4">
                                                                                <?php foreach ( $level3[ 'lev4s' ] as $level4 ): ?>
                                                                                    <li>
                                                                                        <a href="<?php echo "overview.php?Cid=" . $level4[ 'category_id' ]; ?>"
                                                                                           class="l4"
                                                                                           onclick="$('#Current_Category').val(<?php echo $level4[ 'category_id' ]; ?>)">
                                                                                            <?php echo $level4[ 'name' ]; ?>
                                                                                        </a>
                                                                                    </li>
                                                                                <?php endforeach; ?>
                                                                            </ul>
                                                                        </div>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                                <li><a href="overview.php?All=">View All Products</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-lg-3 col-sm-4 mob-wrapper">
                    <div class="cat-wrapper hidden mob-overlay">
                        <div class="cat-header">
                            <i class="fa fa-times-circle-o fa-2x pull-right visible-xs" aria-hidden="true" style="margin-right: 10%;" onclick ="$(this).closest('.mob-overlay').addClass('hidden')"></i>
                            <h3>Select a subcategory</h3>
                        </div>
                        <div class="cat-body" id="has-sub2"></div>
                    </div>
                </div>

                <div class="col-md-3 col-lg-3 col-sm-4 mob-wrapper">
                    <div class="cat-wrapper hidden mob-overlay">
                        <div class="cat-header">
                            <i class="fa fa-times-circle-o fa-2x pull-right" aria-hidden="true" style="margin-right: 10%;" onclick ="$(this).closest('.mob-overlay').addClass('hidden')"></i>
                            <h3>Select a subcategory</h3>
                        </div>
                        <div class="cat-body" id="has-sub3"></div>
                    </div>
                </div>

                <div class="col-md-3 col-lg-3 col-sm-4 mob-wrapper">
                    <div class="cat-wrapper hidden mob-overlay">
                        <div class="cat-header">
                            <i class="fa fa-times-circle-o fa-2x pull-right" aria-hidden="true" style="margin-right: 10%;" onclick ="$(this).closest('.mob-overlay').addClass('hidden')"></i>
                            <h3>Select a subcategory</h3>
                        </div>
                        <div class="cat-body" id="has-sub4"></div>
                    </div>
                </div>

            </div>


            <input type="hidden" value="<?php if ( isset( $_GET[ 'cid' ] ) ) {
                echo $_GET[ 'cid' ];
            } ?>" id="SelectedCategory">


        </div>
    </div>
</div>
<?php require 'include/scripts.php'; ?>
<script type="text/javascript">

</script>
<?php require 'include/footer.php'; ?>

