<?php
    include('connections/db_connect.php');//connect to the database
    require 'include/header.php';
    require 'utilities/Category.php';

    $PRODUCT_OVERVIEW="";
    $url = "http://gh.pricedrummer.com/api/lev1n2n3n4.php";

    $curl_channel = curl_init();
    curl_setopt($curl_channel, CURLOPT_URL, $url);
    //curl_setopt($curl_channel, CURLOPT_PROXY, $proxy);
    curl_setopt($curl_channel, CURLOPT_HEADER, FALSE);
    curl_setopt($curl_channel, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl_channel, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($curl_channel, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_channel, CURLOPT_HTTPPROXYTUNNEL, 1);
    curl_setopt($curl_channel, CURLOPT_CONNECTTIMEOUT, 0);

    $result['EXE'] = curl_exec($curl_channel);
    $result['INF'] = curl_getinfo($curl_channel);
    $result['ERR'] = curl_error($curl_channel);


    curl_close($curl_channel);

    if(empty($result['ERR'])){

// echo $result['EXE'];
        $Categories = json_decode($result['EXE'], TRUE);

    }else{
        echo $result['ERR'];
    }

    $retailer_delevery_sql = 'SELECT * FROM `retailer_delevery`';
    $retailer_delevery_result = $conn->query($retailer_delevery_sql);

    if(isset($_GET['Pid'])){
        $product_id = $conn->real_escape_string(urldecode($_GET['Pid']));


        $retailer_products_sql = 'SELECT * FROM `retailer_product_list` where `id` ='.$product_id;
        $retailer_products_result = $conn->query($retailer_products_sql);

        if($retailer_products_result){
            $Product = $retailer_products_result->fetch_assoc();
            //var_dump($Product);
            //die();
        }

        $retailer_products_images_sql = 'SELECT * FROM `retailer_product_images` where `status`="ACTIVE" and `retailer_product_id` ='.$product_id;
        $retailer_products_images_result = $conn->query($retailer_products_images_sql);

    }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <nav id="mob-menu-wrapper"  class="hidden-xs">
                <?php include 'include/dashboard_navigation.php'; ?>
            </nav> <!-- end navigation -->

            <div class="col-md-11 col-lg-11" style="margin-left: -45px;">
                <div class="col-md-12 col-lg-12 hidden" id="CategoriesSelection">

                    <div class="col-md-3 col-lg-3">
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
                                                            </a>
                                                            <div class="has-sub">
                                                                <ul id="Categories_level_3">
                                                                    <?php foreach ( $level2[ 'lev3s' ] as $level3 ): ?>
                                                                        <li>
                                                                            <a href="javascript:void(0);" class="l3"
                                                                               onclick="setLevel4(this,'<?php echo $level3[ 'name' ]; ?>','<?php echo $level3[ 'category_id' ]; ?>'); <?php if ( count( $level3[ 'lev4s' ] ) < 1 ) {
                                                                                   echo "ShowForm(" . $level3[ 'category_id' ] . ",this,3);";
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
                                                                                            <a href="javascript:void(0);"
                                                                                               class="l4"
                                                                                               onclick="ShowForm(<?php echo $level4[ 'category_id' ]; ?>,this,4); $('#Current_Category').val(<?php echo $level4[ 'category_id' ]; ?>)">
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
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-lg-3">
                        <div class="cat-wrapper hidden">
                            <div class="cat-header">
                                <h3>Select a subcategory</h3>
                            </div>
                            <div class="cat-body" id="has-sub2"></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-lg-3">
                        <div class="cat-wrapper hidden">
                            <div class="cat-header">
                                <h3>Select a subcategory</h3>
                            </div>
                            <div class="cat-body" id="has-sub3"></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-lg-3">
                        <div class="cat-wrapper hidden">
                            <div class="cat-header">
                                <h3>Select a subcategory</h3>
                            </div>
                            <div class="cat-body" id="has-sub4"></div>
                        </div>
                    </div>

                </div>

                <input type="hidden" value="<?php if ( isset( $_GET[ 'cid' ] ) ) {
                    echo $_GET[ 'cid' ];
                } ?>" id="SelectedCategory">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="prod-wrapper" id="AddProductForm">
                        <div class="col-md-12">
                            <p id="Category_Links">
                                <!-- <a href="#">Electronics &amp; Computers</a> &rarr;
                                <a href="#">Mobile Phones</a> &rarr;
                                <a href="#">Category 3</a> &rarr;
                                <span>Category 4</span> &rarr;
                                <a href="javascript:void(0);" onclick="ShowCategores();">Change</a> -->
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-md-9 col-lg-9">
                                <div class="prod-header">
                                    <h3>Edit Product</h3>
                                </div>
                            </div>
                        </div>
                        <div class="prod-body">
                            <div class="row">
                                <form action="include/edit_products.php" method="post" enctype="multipart/form-data"
                                      id="Retailer_Products_Form">
                                    <input type="hidden" name="retailer_id" id="retailer_id"
                                           value="<?php if ( isset( $_SESSION[ 'retailer_user_id' ] ) ) {
                                               echo $_SESSION[ 'retailer_user_id' ];
                                           } ?>"/>
                                    <input type="hidden" name="Current_category_id" id="Current_Category"
                                           value="<?php if ( isset( $_GET[ 'cid' ] ) ) {
                                               echo $_GET[ 'cid' ];
                                           } ?>"/>
                                    <input type="hidden" name="category_drill" id="category_drill"
                                           value="<?php if ( isset( $_GET[ 'cdrill' ] ) ) {
                                               echo urldecode( $_GET[ 'cdrill' ] );
                                           } ?>"/>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="input-label" for="product_name">Product Name
                                                    <i class="important">*</i>
                                                </label>
                                                <input class="form-control" type="text" id="product_name"
                                                       value="<?php if ( isset( $Product[ 'name' ] ) ) {
                                                           echo $Product[ 'name' ];
                                                       } ?>" name="product_name"
                                                       placeholder="Example: Samsung Galaxy S6 Plus.">
                                            </div>

                                            <div class="form-group">
                                                <label class="input-label" for="manufacturer">Manufacturer
                                                    <i class="important">*</i>
                                                </label>
                                                <input class="form-control input required" type="text" id="manufacturer"
                                                       value="<?php if(isset($Product['manufacturer'])){echo $Product['manufacturer'];} ?>"
                                                       name="manufacturer"
                                                       placeholder="Example: Apple.">
                                            </div>

                                            <div class="form-group">
                                                <label class="input-label" for="model_name">Model Number
                                                    <i class="important">*</i>
                                                </label>
                                                <input class="form-control input required" type="text" id="model_name"
                                                       value="<?php if(isset($Product['model_nuber'])){echo $Product['model_nuber'];} ?>" name="model_name"
                                                       placeholder="Example: GT5300.">
                                            </div>

                                            <div class="form-group">
                                                <label class="input-label" for="description">Description
                                                </label>
                                                <textarea class="form-control desc-box" rows="5" name="description"
                                                          placeholder="This is important for non-comparison products like jewelry, toys, clothing."><?php if(isset($Product['description'])){echo $Product['description'];} ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Product Price
                                                    <i class="important">*</i></label>
                                                <input type="text" class="form-control" onfocus="numberOnly(this);" onmouseenter="numberOnly(this);" onkeydown="numberOnly(this);" type="text" id="price" name="price" value="<?php if(isset($Product['price'])){echo $Product['price'];} ?>" placeholder="Price GH&cent;">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Availability</label>
                                                <select name="availability" id="" class="form-control">
                                                    <option <?php if(isset($Product['availability']) && $Product['availability'] ==1){echo "Selected";} ?> value="">Select an option</option>
                                                    <option <?php if(isset($Product['availability']) && $Product['availability'] ==1){echo "Selected";} ?> value="1">In stock</option>
                                                    <option value="0">Out of stock</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="input-label" for="model_name">Delivery Time
                                                    <i class="important">*</i>
                                                </label>
                                                <select name="delivery_time" id="delivery_time" class="form-control required">
                                                    <option value="">Select an option</option>
                                                    <?php
                                                        if ($retailer_delevery_result->num_rows > 0) {
                                                            while($row = $retailer_delevery_result->fetch_assoc()) {
                                                                ?>
                                                                <option <?php if(isset($Product['delevery_details']) && trim($Product['delevery_details']) ==trim($row['id'])){echo "Selected";} ?> value="<?php echo $row['id']; ?>"><?php echo $row['delevery_details']; ?></option>
                                                                <?php
                                                            }}
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="input-label" for="delivery_cost">Delivery Cost
                                                </label>
                                                <input class="form-control input" onfocus="numberOnly(this);"
                                                       onmouseenter="numberOnly(this);" onkeydown="numberOnly(this);"
                                                       type="text" id="delivery_cost" name="delivery_cost"
                                                       placeholder="Delivery cost for product" value="<?php if(isset($Product['delivery_cost'])){echo $Product['delivery_cost'];} ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>Edit Image</h3>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <?php if(isset($Product['product_image']) && !empty($Product['product_image'])) { ?>
                                                <?php
                                                    echo '<div style="text-align: center;"><img src="data:image/jpeg;base64,' . $Product["product_image"] . ' " style="max-height:160px; max-width:150px;"></div>';
                                                ?>
                                            <input type="hidden" name="Main_Image_id"  value="<?php if(isset($Product["image_id"])){echo $Product["image_id"];} ?>"/>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group input-wrapper">
                                                <input id="main-image" name="main_image" type="file" class="file"
                                                       data-preview-file-type="image" accept=".png,.jpg">
                                            </div>
                                            <input class="form-control input" type="text" id="image_url"
                                                   name="image_url"
                                                   placeholder="Or provide a URL: http://www.domain.com/product-url">
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 25px;">
                                        <div class="col-md-6 col-lg-6">
                                            <h4>Have more pictures to upload? (Optional)</h4>
                                        </div>
                                    </div>

                                    <?php
                                    $images = 0;
                                    if ($retailer_products_images_result->num_rows > 0) {
                                        $I_no = 0;
                                        while($Mimage = $retailer_products_images_result->fetch_assoc()) {
                                            if($I_no == 0){$I_no++;continue;}
                                            ?>
                                            <div class="row" style="margin-top: 25px;">
                                                <?php
                                                if(isset($Mimage['image']) && !empty($Mimage['image'])) {
                                                    ?>

                                                    <div  class="col-md-3">
                                                        <?php
                                                        echo '<div style="text-align: center;"><img src="data:image/jpeg;base64,' . $Mimage['image'] . ' " style="max-height:160px; max-width:150px;"></div>';

                                                        ?>
                                                        <input type="hidden" name="Other_Image_<?php echo $I_no;?>_id"  value="<?php if(isset($Mimage['id'])){echo $Mimage['id'];} ?>"/>
                                                    </div>
                                                    <div  class="col-md-3">
                                                        <div class="form-group input-wrapper">
                                                            <input id="other_image<?php echo $I_no;?>" name="other_image<?php echo $I_no;?>" type="file" class="file"
                                                                   data-preview-file-type="image" accept=".png,.jpg">
                                                        </div>
                                                    </div>

                                                    <?php
                                                }else{

                                                }
                                                ?>
                                            </div>
                                            <?php
                                            $I_no++;
                                            $images++; }}
                                    //get the number of images not uploaded
                                    $un_uploaded_images = 3-$images;
                                    $i=1;
                                    while($i<=$un_uploaded_images){
                                        ?>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group input-wrapper">
                                                    <input id="other_image<?php echo $i+$images;?>" name="other_image<?php echo $i+$images;?>" type="file" class="file"
                                                           data-preview-file-type="image" accept=".png,.jpg"></div>
                                            </div>
                                        </div>
                                        <?php
                                        $i++;}
                                    ?>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="submit" id="submit" name="submit" value="Submit"
                                                   class="form-btn">
                                        </div>
                                    </div>



                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php require 'include/scripts.php'; ?>
<script type="text/javascript">

    //================================================================================//
    //================================ ADD PRODUCT PAGE =============================//
    //==============================================================================//
    Re_GenerateCatLinks();

    function initialize_image_input(input_id) {
        $("#"+input_id).fileinput({
            'showUpload':false,
            'maxFileSize':2000,
            'allowedFileTypes':['image'],
            'allowedFileExtensions':['jpg', 'png'],
            'allowedPreviewTypes':['image'],
            'previewFileType':'image'
        });
    }

    initialize_image_input('main-image');
    initialize_image_input('other_image1');
    initialize_image_input('other_image2');
    initialize_image_input('other_image3');

</script>
<?php require '../include/footer.php'; ?>

