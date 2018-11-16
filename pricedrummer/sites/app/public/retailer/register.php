<?php $REGISTER = ""; ?>
<?php require 'include/header.php'; ?>
<?php require_once 'utilities/Country.php'; ?>
<!-- start: PAGE -->
<div class="container">
    <!-- start: PAGE CONTENT -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="information">
                <p>Get the following ready:</p>
                <ul>
                    <li>Company Legal Name</li>
                    <li>Business Registration Number</li>
                    <li>Company Address</li>
                    <li>Contact Numbers</li>
                </ul>
            </div> <!-- end information div -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white wizard-wrapper">
                <div class="panel-body">
                    <form action="include/add_retailer.php" method="POST" role="form"
                          class="smart-wizard form-horizontal" id="form">
                        <div id="wizard" class="swMain">
                            <ul>
                                <li>
                                    <a href="#step-1">
                                        <div class="stepNumber">
                                            1
                                        </div>
                                        <span class="stepDesc"> Retailer Agreement</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-2">
                                        <div class="stepNumber">
                                            2
                                        </div>
                                        <span class="stepDesc">Retailer Information</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-3">
                                        <div class="stepNumber">
                                            3
                                        </div>
                                        <span class="stepDesc">Retailer Approval</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="progress progress-xs transparent-black no-radius active">
                                <div aria-valuemax="100" aria-valuemin="0" role="progressbar"
                                     class="progress-bar partition-green step-bar">
                                    <span class="sr-only"> 0% Complete (success)</span>
                                </div>
                            </div>
                            <div id="step-1">
                                <h2 class="StepTitle">Retailer Agreement</h2>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        Company Legal Name<span class="symbol required"></span>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="legal_name" name="legal_name"
                                               placeholder="Enter your company name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        Company Registration Number <span class="symbol required"></span>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="registration_number"
                                               name="registration_number"
                                               placeholder="Enter your company registration number" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        Shop Address<span class="symbol required"></span>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="company_address"
                                               name="company_address" placeholder="Enter your company address" required>
                                    </div>
                                </div>
                                <div class="checkbox">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-7">
                                        <input type="checkbox" name="agree" id="agree">
                                        <label for="agree">I agree that the information provided are true and I agree to
                                            the <a href="#" class="tac">terms &amp; conditions</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-top: 20px;">
                                    <div class="col-md-3 col-lg-3"></div>
                                    <div class="col-md-7 col-lg-7">
                                        <button class="btn btn-custom next-step">
                                            Next <i class="fa fa-arrow-circle-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="step-2">
                                <h2 class="StepTitle">Retailer Information</h2>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        Email Address<span class="symbol required"></span>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="email"
                                               name="email" placeholder="Enter your email address" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-3 control-label">
                                        Password<span class="symbol required"></span>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="password" class="form-control" name="password" id="password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password_again" class="col-sm-3 control-label">
                                        Confirm Password<span class="symbol required"></span>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="password" class="form-control" name="password_again"
                                               id="password_again">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        Contact Number<span class="symbol required"></span>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="contact_number"
                                               name="contact_number" placeholder="Enter your phone number" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="country" class="col-sm-3 control-label">
                                        Country <span class="symbol required"></span>
                                    </label>
                                    <div class="col-sm-7">
                                        <select class="form-control" id="country" name="country">
                                            <?php foreach ( Country::all() as $name => $code ): ?>
                                                <option value="<?php echo $code; ?>"><?php echo $name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="city" class="col-sm-3 control-label">
                                        City <span class="symbol required"></span>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="city" name="city"
                                               placeholder="Text Field" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-7">
                                        <button class="btn btn-custom back-step">
                                            <i class="fa fa-circle-arrow-left"></i> Back
                                        </button>

                                        <button class="btn btn-custom next-step pull-right">
                                            Next <i class="fa fa-arrow-circle-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="step-3">
                                <h2 class="StepTitle">Retailer Approval</h2>
                                <h3>Company Information</h3>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        Company Legal Name:
                                    </label>
                                    <div class="col-sm-7">
                                        <p class="form-control-static display-value" data-display="legal_name"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        Company Registration Number:
                                    </label>
                                    <div class="col-sm-7">
                                        <p class="form-control-static display-value"
                                           data-display="registration_number"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        Shop Address:
                                    </label>
                                    <div class="col-sm-7">
                                        <p class="form-control-static display-value" data-display="company_address"></p>
                                    </div>
                                </div>
                                <h3>Retailer Information</h3>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        Email:
                                    </label>
                                    <div class="col-sm-7">
                                        <p class="form-control-static display-value" data-display="email"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        Contact Number:
                                    </label>
                                    <div class="col-sm-7">
                                        <p class="form-control-static display-value" data-display="contact_number"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        Country:
                                    </label>
                                    <div class="col-sm-7">
                                        <p class="form-control-static display-value" data-display="country"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        City:
                                    </label>
                                    <div class="col-sm-7">
                                        <p class="form-control-static display-value" data-display="city"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3 col-lg-3"></div>
                                    <div class="col-md-7 col-lg-7">
                                        <button class="btn btn-custom finish-step pull-right">
                                            Finish <i class="fa fa-arrow-circle-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end: PAGE CONTENT-->


</div>
<div class="subviews">
    <div class="subviews-container"></div>
</div>
</div>
<!-- end: PAGE -->
</div>
<!-- end: MAIN CONTAINER -->
<!-- start: SUBVIEW SAMPLE CONTENTS -->
<!-- *** NEW NOTE *** -->

<!-- *** READ NOTE *** -->
<div id="readNote">
    <div class="barTopSubview">
        <a href="#newNote" class="new-note button-sv"><i class="fa fa-plus"></i> Add new note</a>
    </div>
    <div class="noteWrap col-md-8 col-md-offset-2">
        <div class="panel panel-note">
            <div class="e-slider owl-carousel owl-theme">
                <div class="item">
                    <div class="panel-heading"></div>
                    <div class="panel-footer"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- *** SHOW CALENDAR *** -->

</div>

<script>
    function checkEmail() {
        var email = jQuery("#email").val();

        if (email) {
            $.ajax({
                type: 'post',
                url: 'include/checkdata.php',
                data: {
                    email: email,
                },
                success: function (response) {
                   console.log( response );
                }
            });
        }
        else {
            $('#email_status').html("");
            return false;
        }
    }
</script>
<?php require 'include/scripts.php'; ?>
<?php require 'include/footer.php'; ?>
