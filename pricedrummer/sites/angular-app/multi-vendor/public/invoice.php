<?php require '../include/header.php'; ?>

<?php
	$INVOICES = "";
	$faker = Faker\Factory::create();
	$categories = [
		'Mobile Phones',
		'Tablets',
		'Camera',
		'TVs',
		'Audio Speakers',
		'Cars',
		'Computers',
	];
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<nav class="col-md-1 col-lg-1">
				<?php include '../include/dashboard_navigation.php'; ?>
			</nav> <!-- end navigation -->
			
			<div class="col-md-11 col-lg-11">
				<div class="col-md-12 col-lg-12">
					<div class="row">
						<div class="box box-wrapper cf"
						     style="width: 550px; margin: 10% auto;">
							<div class="box-header">
								<h4>Refine your search</h4>
							</div>
							<div class="box-body">
								<h4 class="sub-title">Filter by date:</h4>
								<span id="error"></span>
								<form method="POST" id="view_invoice_form" action="invoice_results.php">
									<div class="input-group">
										<input type="text" data-date-format="yyyy-mm-dd"
										       data-date-viewmode="years" name="daterange"
										       class="form-control date-time-range input-lg" id="daterange">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									</div>
									<div style="margin: 15px 0;" class="input-group">
										<input type="submit" id="view_invoice" name="view_invoice" value="View Invoice"
										       class="form-btn">
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
<?php require '../include/scripts.php'; ?>
<script type="text/javascript">


    $(function ()
    {
        $('.date-time-range').daterangepicker({
            timePicker: true,
            timePickerIncrement: 15,
            format: 'YYYY-MM-DD h:mm'
        });

        var form_input = $('#daterange'),
	        error_msg = $('span#error');
	    

        $('#view_invoice_form').submit(function (evt)
        {
            if (form_input.val() === '' || form_input.val() == undefined || isEmpty(form_input.val())) {
				error_msg.text("Please select a date range");
                return false;
            } else {
                return true;
            }
        });

    });
</script>
<?php require '../include/footer.php'; ?>
