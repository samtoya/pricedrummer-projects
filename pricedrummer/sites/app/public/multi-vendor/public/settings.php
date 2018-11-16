<?php include '../configuration/config.php'; ?>
<?php include '../connections/db_config.php'; ?>
<?php include '../connections/db_connect.php'; ?>
<?php require INCLUDE_PATH . DS . 'header.php'; ?>
<?php require_once UTILITIES_PATH . DS . 'Country.php'; ?>
<?php
    $SETTINGS = "";
    # Getting the retailer information
    $retailer_id = $conn->real_escape_string( $_SESSION[ 'retailer_user_id' ] );
    //
    $sql                   = "SELECT * FROM retailers WHERE id = {$retailer_id} LIMIT 1";
    $retailer_result       = $conn->query( $sql );
    $retailer_returned_row = $retailer_result->fetch_object();
    $merchant_id = $retailer_returned_row->merchant_ID;

    # Retreiving the merchant information
    $sql             = "SELECT * FROM merchant WHERE merchant_ID = {$merchant_id} LIMIT 1";
    $merchant_result = $conn->query( $sql );
    $merchant_row    = $merchant_result->fetch_object();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <nav class="col-md-1 col-lg-1">
                <?php include INCLUDE_PATH . DS . 'dashboard_navigation.php'; ?>
            </nav> <!-- end navigation -->

            <div class="col-md-11 col-lg-11"
                 style="margin-left: -45px;">
                <div class="col-md-12 col-lg-12">
                    <div class="col-lg-8 col-md-8">
                        <div class="setting-wrapper tab-content">
                            <div id="ci"
                                 class="tab-pane fade in <?php if ( ( ! isset( $_GET[ 'tab' ] ) && empty( $_GET[ 'tab' ] ) ) || isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 1 ) {
                                     echo 'active';
                                 } ?>">
                                <div class="setting-header">
                                    <h4>Company Information</h4>
                                </div>
                                <div class="setting-body">
                                    <h4 class="sub-title">Edit your company information</h4>
                                    <form method="POST" id="com_info_form"
                                          action="../include/update_settings.php"
                                          enctype="multipart/form-data">
                                        <div class="st-form-wrapper">
                                            <label for="company_name">Company Name</label>
                                            <input type="text"
                                                   name="company_name"
                                                   id="company_name"
                                                   value="<?php echo $retailer_returned_row->company_name; ?>">
                                        </div>
                                        <div class="st-form-wrapper">
                                            <label for="registration_number">Registration Number</label>
                                            <input type="text"
                                                   name="registration_number"
                                                   id="registration_number"
                                                   value="<?php echo $retailer_returned_row->registration_number; ?>">
                                        </div>
                                        <div class="st-form-wrapper">
                                            <label for="shop_address">Company Address</label>
                                            <input type="text"
                                                   name="shop_address"
                                                   id="shop_address"
                                                   value="<?php echo $retailer_returned_row->shop_address; ?>">
                                        </div>
                                        <div class="st-form-wrapper">
                                            <label for="url">Website</label>
                                            <input type="text"
                                                   name="url"
                                                   id="url"
                                                   placeholder="http://"
                                                   value="<?php if ( ! empty( $merchant_row->url ) && $merchant_row->url != "None" ) {
                                                       echo $merchant_row->url;
                                                   } elseif ( $merchant_row->url === "None" || $merchant_row->url == "" ) {
                                                       echo "";
                                                   }
                                                   ?>">
                                        </div>

                                        <div class="st-file-wrapper">
                                            <div class="fileupload fileupload-new"
                                                 data-provides="fileupload">
                                                <input type="hidden"
                                                       value=""
                                                       name="logo">
                                                <div class="fileupload-new thumbnail">
                                                    <img src="http://www.placehold.it/300x150/EFEFEF/AAAAAA?text=no+image"
                                                         alt="">
                                                </div>
                                                <div class="fileupload-preview fileupload-exists thumbnail"
                                                     style="line-height: 10px;"></div>
                                                <div>
															<span class="btn btn-light-grey btn-file"><span
                                                                        class="fileupload-new"><i
                                                                            class="fa fa-picture-o"></i> Select image</span><span
                                                                        class="fileupload-exists"><i
                                                                            class="fa fa-picture-o"></i> Change</span>
																<input type="file" accept="image/*"
                                                                       name="logo">
															</span>
                                                    <a href="#"
                                                       class="btn fileupload-exists btn-light-grey"
                                                       data-dismiss="fileupload">
                                                        <i class="fa fa-times"></i> Remove
                                                    </a>
                                                </div>
                                            </div>
                                            <?php
                                                if ( ! empty( $merchant_row->logo ) ) {
                                                    echo '<div style="text-align: center;"><img src="data:image/jpeg;base64,' . $merchant_row->logo . ' " style="max-height:160px; max-width:150px;"></div>';
                                                }
                                            ?>
                                        </div>
                                        <div>
                                            <input type="hidden" name="retailer_id"
                                                   value="<?php if ( isset( $_SESSION[ 'retailer_user_id' ] ) ) {
                                                       echo $_SESSION[ 'retailer_user_id' ];
                                                   } ?>"/>
                                            <input type="submit"
                                                   value="Submit"
                                                   name="com_info_submit"
                                                   class="form-btn">
                                        </div>

                                    </form>
                                </div>
                            </div>

                            <div id="ai"
                                 class="tab-pane fade in <?php if ( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 2 ) {
                                     echo 'active';
                                 } ?>">
                                <div class="setting-header">
                                    <h4>Account Information</h4>
                                </div>
                                <div class="setting-body">
                                    <h4 class="sub-title">Change your account information</h4>
                                    <form method="POST"
                                          action="../include/update_settings.php">
                                        <div class="st-form-wrapper">
                                            <label for="email">Email Address</label>
                                            <input type="email"
                                                   name="email"
                                                   id="email"
                                                   value="<?php echo $retailer_returned_row->email; ?>">
                                        </div>

                                        <div class="st-form-wrapper">
                                            <label for="telephone1">Contact Number</label>
                                            <input type="text"
                                                   name="telephone1"
                                                   id="telephone1"
                                                   value="<?php echo $retailer_returned_row->telephone1; ?>">
                                        </div>

                                        <div class="st-form-wrapper">
                                            <label for="telephone2">Other Contact Number</label>
                                            <input type="text"
                                                   name="telephone2"
                                                   id="telephone2"
                                                   value="<?php echo $retailer_returned_row->telephone2; ?>">
                                        </div>

                                        <div class="st-form-wrapper">
                                            <label for="country">Country</label>
                                            <select name="country"
                                                    id="country">
                                                <?php foreach ( Country::all() as $country => $code ): ?>
                                                    <option value="<?php echo $code; ?>" <?php if ( trim( $retailer_returned_row->country == trim( $code ) ) ) {
                                                        echo 'selected';
                                                    } ?>><?php echo $country ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="st-form-wrapper">
                                            <label for="city">City</label>
                                            <input type="text"
                                                   name="city"
                                                   id="city"
                                                   value="<?php echo $retailer_returned_row->city; ?>">
                                        </div>
                                        <div>
                                            <input type="hidden" name="retailer_id"
                                                   value="<?php if ( isset( $_SESSION[ 'retailer_user_id' ] ) ) {
                                                       echo $_SESSION[ 'retailer_user_id' ];
                                                   } ?>"/>
                                            <input type="submit"
                                                   value="Submit"
                                                   name="acc_info_submit"
                                                   class="form-btn">
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div id="au"
                                 class="tab-pane fade in <?php if ( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 3 ) {
                                     echo 'active';
                                 } ?>">
                                <div class="setting-header">
                                    <h4>Authentication</h4>
                                </div>
                                <div class="setting-body">
                                    <h4 class="sub-title">Change your password</h4>
                                    <form method="POST" id="ch_pass_form"
                                          action="../include/update_settings.php">
                                        <div class="st-form-wrapper">
                                            <label for="current_password">Current Password</label>
                                            <input type="password"
                                                   name="current_password"
                                                   required
                                                   id="current_password">
                                        </div>
                                        <div class="st-form-wrapper">
                                            <label for="password">New Password</label>
                                            <input type="password"
                                                   required
                                                   id="password"
                                                   name="password">
                                        </div>
                                        <div class="st-form-wrapper">
                                            <label for="repeat_password">Repeat New Password</label>
                                            <input type="password"
                                                   id="repeat_password"
                                                   required
                                                   name="repeat_password">
                                        </div>
                                        <div>
                                            <input type="hidden" name="retailer_id"
                                                   value="<?php if ( isset( $_SESSION[ 'retailer_user_id' ] ) ) {
                                                       echo $_SESSION[ 'retailer_user_id' ];
                                                   } ?>"/>
                                            <input type="submit"
                                                   value="Submit"
                                                   name="ch_pass_submit"
                                                   class="form-btn">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-lg-3 col-md-offset-1 col-lg-offset-1">
                        <h4>Navigation</h4>
                        <ul class="nav nav-pills nav-stacked">
                            <li <?php if ( ( ! isset( $_GET[ 'tab' ] ) && empty( $_GET[ 'tab' ] ) ) || isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == '1' ) {
                                echo 'class="active"';
                            } ?>>
                                <a data-toggle="tab"
                                   target="_self"
                                   href="#ci"
                                   aria-expanded="true">Company Information</a>
                            </li>
                            <li <?php if ( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == '2' ) {
                                echo 'class="active"';
                            } ?>>
                                <a data-toggle="tab"
                                   target="_self"
                                   href="#ai"
                                   aria-expanded="false">Account Information</a>
                            </li>
                            <li <?php if ( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == '3' ) {
                                echo 'class="active"';
                            } ?>>
                                <a data-toggle="tab"
                                   target="_self"
                                   href="#au"
                                   aria-expanded="false">Authentication</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require '../include/scripts.php'; ?>
    <script type="text/javascript">
        $("#input-upload-img1").fileinput({'showUpload': false, 'previewFileType': 'image'});
    </script>
    <script type="text/javascript">
        $(function () {

            jQuery('#com_info_form').validate({
                rules: {
                    company_name: {
                        required: true
                    },
                    shop_address: {
                        required: true
                    },
                    registration_number: {
                        required: true,
                        minlength: 10
                    }
                },
                messages: {
                    registration_number: "Please enter a valid registration number"
                }
            });

            jQuery('#ch_pass_form').validate({
                rules: {
                    current_password: {
                        required: true,
                        minlength: 6
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password_again: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    }
                },
                messages: {
                    current_password: {
                        required: "Please specify your current password",
                        minlength: "Password must be more than 6 characters"
                    },
                    new_password: {
                        required: "Please enter your new password",
                        minlength: "Password must be more than 6 characters"
                    },
                    password_again: {
                        required: "Please confirm the above password",
                        minlength: "Password must be more than 6 characters",
                        equalTo: "Please enter the same password as above"
                    }
                }
            });
        });
    </script>
    <?php require '../include/footer.php'; ?>
