<?php require '../include/header.php'; ?>
<?php 
$SET_BUDGET = "";
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <nav class="col-md-1 col-lg-1">
                    <?php include '../include/dashboard_navigation.php'; ?>
                </nav> <!-- end navigation -->

                <div class="col-md-11 col-lg-11" style="margin-left: -45px;">
                    <div class="col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-md-10 col-lg-10">
                                <div class="information">
                                    <p>
                                        As a retailer, you only pay PriceDrummer when a shopper clicks to see your
                                        online store or contact details. This is normally referred to pay-per-click
                                        marketing.
                                        We believe this is fair, as you only pay us when we have successfully referred a
                                        shopperto you. Currently we charge 10 pesewas for every click to your online
                                        shop or product page.
                                    </p>
                                    <p>
                                        For example, Shop A has 100 clicks to their online shop or site in a week. Total
                                        payout will be <span style="font-weight: bold;">0.1 * 100=10GHS</span>. You are
                                        not able to list a product until you set a budget. An account manager will
                                        contact you when you set your budget and list your products.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 col-lg-5">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="widget widget-wrapper">
                                            <div class="widget-header">
                                                <h5>Budget Type</h5>
                                            </div>

                                            <div class="widget-body">
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-12">
                                                        <h4 class="sub-title">Set your budget type</h4>
                                                    </div>
                                                </div>

                                                <div class="budget-chooser">
                                                    <div class="budget-chooser-item">
                                                        <div class="widget-info-img">
                                                            <img src="assets/images/cost_per_click2.png" alt="">
                                                        </div>

                                                        <div class="widget-info-desc">
                                                            <h4 class="title">Pay-per-click</h4>
                                                            <span class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam amet assumenda consequatur distinctio ducimus.</span>
                                                            <input type="radio" name="budget_type"
                                                                   value="pay_per_click">
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                                <div class="budget-chooser">
                                                    <div class="budget-chooser-item">
                                                        <div class="widget-info-img">
                                                            <img src="assets/images/cost_per_conversion.png"
                                                                 alt="">
                                                        </div>

                                                        <div class="widget-info-desc">
                                                            <h4 class="title">Pay-per-conversion</h4>
                                                            <span class="description">
                                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam amet assumenda consequatur distinctio ducimus.
                                                            </span>
                                                            <input type="radio" name="budget_type"
                                                                   value="pay_per_conversion">
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>

                                            </div> <!-- end widget body div -->
                                        </div> <!-- end col-md-5 col-lg-5 -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-lg-5">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="widget widget-wrapper hidden">
                                            <div class="widget-header">
                                                <h5>Budget Amount</h5>
                                            </div>

                                            <div class="widget-body">
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-12">
                                                        <h4 class="sub-title">Set your budget amount (GH&cent;20) minimum</h4>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 col-lg-12">
                                                        <ul class="money_container">
                                                            <li>
                                                                <div class="money_wrapper">
                                                                    <div class="money_chooser_item">
                                                                        <input type="radio" value="20" name="budget">
                                                                        <div class="money_image">
                                                                            <img src="assets/images/money_bag.png" alt="Cedi Icon">
                                                                        </div>
                                                                        <div class="money_content">
                                                                            <span>GH&cent;20</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="money_wrapper">
                                                                    <div class="money_chooser_item">
                                                                        <input type="radio" value="40" name="budget">
                                                                        <div class="money_image">
                                                                            <img src="assets/images/money_bag.png" alt="Cedi Icon">
                                                                        </div>
                                                                        <div class="money_content">
                                                                            <span>GH&cent;40</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li><li>
                                                                <div class="money_wrapper">
                                                                    <div class="money_chooser_item">
                                                                        <input type="radio" value="60" name="budget">
                                                                        <div class="money_image">
                                                                            <img src="assets/images/money_bag.png" alt="Cedi Icon">
                                                                        </div>
                                                                        <div class="money_content">
                                                                            <span>GH&cent;60</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li><li>
                                                                <div class="money_wrapper">
                                                                    <div class="money_chooser_item">
                                                                        <input type="radio" value="80" name="budget">
                                                                        <div class="money_image">
                                                                            <img src="assets/images/money_bag.png" alt="Cedi Icon">
                                                                        </div>
                                                                        <div class="money_content">
                                                                            <span>GH&cent;80</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li><li>
                                                                <div class="money_wrapper">
                                                                    <div class="money_chooser_item">
                                                                        <input type="radio" value="100" name="budget">
                                                                        <div class="money_image">
                                                                            <img src="assets/images/money_bag.png" alt="Cedi Icon">
                                                                        </div>
                                                                        <div class="money_content">
                                                                            <span>GH&cent;100</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li><li>
                                                                <div class="money_wrapper">
                                                                    <div class="money_chooser_item">
                                                                        <input type="radio" value="200" name="budget">
                                                                        <div class="money_image">
                                                                            <img src="assets/images/money_bag.png" alt="Cedi Icon">
                                                                        </div>
                                                                        <div class="money_content">
                                                                            <span>GH&cent;200</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li><li>
                                                                <div class="money_wrapper">
                                                                    <div class="money_chooser_item">
                                                                        <input type="radio" value="400" name="budget">
                                                                        <div class="money_image">
                                                                            <img src="assets/images/money_bag.png" alt="Cedi Icon">
                                                                        </div>
                                                                        <div class="money_content">
                                                                            <span>GH&cent;400</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li><li>
                                                                <div class="money_wrapper">
                                                                    <div class="money_chooser_item">
                                                                        <input type="radio" value="800" name="budget">
                                                                        <div class="money_image">
                                                                            <img src="assets/images/money_bag.png" alt="Cedi Icon">
                                                                        </div>
                                                                        <div class="money_content">
                                                                            <span>GH&cent;800</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div> <!-- end widget body div -->
                                        </div> <!-- end col-md-5 col-lg-5 -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="btn-wrapper">
                                    <button class="form-btn hidden" id="submit-btn" type="button">Submit</button></div>
                            </div>

                            <input type="hidden" id="retailer_id_for_budget" value="<?php if(isset($_SESSION['retailer_user_id'])){ echo $_SESSION['retailer_user_id']; } ?>"/>
                            <input type="hidden" id="retailer_status_for_budget" value="<?php if(isset($_SESSION['retailer_status'])){ echo $_SESSION['retailer_status']; } ?>"/>
                            <input type="hidden" id="retailer_ip_for_budget" value=""/>
                            <input type="hidden" id="retailer_Country_for_budget" value=""/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php require '../include/scripts.php'; ?>
<script type="text/javascript">
    
//================================================================================//
//================================ BUDGET PAGE ==================================//
//==============================================================================//

$(document).ready(function () {
    $.getJSON('https://ipinfo.io', function (data) {
        var ip = data['ip'],
        country = data['country'],
        city = data['city'],
        location = data['loc'],
        region = data['region'];

        $('#retailer_ip_for_budget').val(ip);
        $('#retailer_Country_for_budget').val(country);

    });

});

/* Budget type chooser */

$(function () {
    var budget, submitBtn, widget;
    budget = {};

    /* Get reference to the second widget */

    /* on the budget page and hide it by default */
    widget = $('div.widget')[1];
    submitBtn = $('#submit-btn');

    /* Budget Amount chooser */
    $('div.money_wrapper').find('div.money_chooser_item').on('click', function () {
        var budget_amount, input;
        $(this).parent().parent().parent().find('div.money_chooser_item').removeClass('selected');
        $(this).addClass('selected');
        if ($(this).hasClass('selected')) {
            input = $(this).find('input[type="radio"]')[0];
            budget_amount = $(input).attr('value');
            budget.budget_amount = budget_amount;
            return $(submitBtn).fadeIn().removeClass('hidden');
        }
    });

    /* Budget Type chooser */
    $('div.budget-chooser').find('div.budget-chooser-item').on('click', function () {
        var budget_type, input;
        $(this).parent().parent().parent().find('div.budget-chooser-item').removeClass('selected');
        $(this).addClass('selected');
        if ($(this).hasClass('selected')) {
            input = $(this).find('input[type="radio"]')[0];
            budget_type = $(input).attr('value');
            budget.budget_type = budget_type;
            return $(widget).fadeIn().removeClass('hidden');
        }
    });
    submitBtn.on('click', function () {
        //alert('Your budget... Press okay & check your console :)');
        budget.rerailer_id = $('#retailer_id_for_budget').val();
        budget.retailer_status = $('#retailer_status_for_budget').val();
        budget.retailer_ip = $('#retailer_ip_for_budget').val();
        budget.retailer_country = $('#retailer_Country_for_budget').val();
        console.log(budget);

        //Process the selected budget for the current retailer.
        $.ajax({
            url: '../include/set_retailer_budget.php',
            type: 'POST',
            data: budget,
            success:function(data){ 
                //if the process was successful
                //console.log(data);
                //window.location.href = data;
                //location.reload();
                console.log(data);

                if(String(data).trim() =="SET_SUCCESS"){

                     window.location.href = "../public/list_product.php?msg=set_success";

                }
                if(String(data).trim()  =="SET_FAILED"){

                    window.location.href = "../public/budget.php?msg=set_failed";

                }
                if(String(data).trim()  =="UPDATE_SUCCESS"){

                    window.location.href = "../public/budget.php?msg=update_success";
                    
                }
                if(String(data).trim()  =="UPDATE_FAILED"){

                    window.location.href = "../public/budget.php?msg=update_failed";

                }
            },
            error:function() {
                    //if there was an error 
                    console.log('no');
                }
            });

    });

});


</script>
<?php require '../include/footer.php'; ?>
