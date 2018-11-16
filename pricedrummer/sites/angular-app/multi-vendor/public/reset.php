<?php 
$RESET="";
?>
<?php require '../include/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="col-md-6 col-lg-6">
				<!-- <?php # include 'svg/ghanaLow.svg'; ?> -->
			</div>
			<div class="col-md-6 col-lg-6">
				<div class="form-wrapper pull-right">
					<div class="form-wrapper-header">
						<h4>Forgot your password?</h4>
					</div>	

					<div class="form-wrapper-body">
						<form action="#" method="POST">
							<div class="form-input-wrapper">
								<label for="email">Email:</label>
								<input type="email" name="email">
							</div>

<!--							<div class="form-input-wrapper">-->
<!--								<div style="margin-left: 88px; margin-top: 10px;" class="g-recaptcha" data-sitekey="6LfQewgUAAAAADQ7ilJd0iiKCjN_ZOsfd7gV-Zc2"></div>-->
<!--							</div>-->

							<div class="form-button-wrapper">
								<input type="submit" value="Continue" name="submit">
							</div>
						</form>
					</div>

					<div class="form-wrapper-footer">
						<p>Back to login?: <a href="index.php">Login</a></p>
					</div>
				</div> <!-- end form-wrapper div -->

				<div class="register-info pull-right">
					<h4>Create a retailer account</h4>
					<p><a href="register.php">Register</a> &amp; start 
						listing listing on PriceDrummer</p>
					</div>

				</div>
			</div>
		</div>

		<section class="middle-wrapper">
			<div class="col-lg-4 col-md-4">
				<div class="icon-wrapper">
					<h1 class="glyphicon glyphicon-cog"></h1>
					<h3>Setup Account</h3>
				</div>
			</div>

			<div class="col-lg-4 col-md-4">
				<div class="icon-wrapper">
					<h1 class="glyphicon glyphicon-plus"></h1>
					<h3>Set a Budget</h3>
				</div>
			</div>

			<div class="col-lg-4 col-md-4">
				<div class="icon-wrapper">
					<h1 class="glyphicon glyphicon-shopping-cart"></h1>
					<h3>List or Sell</h3>
				</div>
			</div>
		</section>
	</div>
</div> <!-- end container div -->

<?php require '../include/scripts.php'; ?>
<?php require '../include/footer.php'; ?>
