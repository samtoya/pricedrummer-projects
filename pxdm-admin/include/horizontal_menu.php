<div id="horizontal-menu" class="navbar navbar-inverse hidden-sm hidden-xs inner">
	<div class="container">
		<div class="navbar-collapse">
			<ul class="nav navbar-nav">
				<li>
					<a href="<?php echo baseURL();?>/home.php">
						Home
					</a>
				</li>
				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						SC Admin <i class="icon-arrow"></i>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo baseURL();?>/standard/select_cat.php">
								<span class="title">SC Data Admin</span>
							</a>
						</li>
						<li>
							<a href="<?php echo baseURL();?>/standard/add_buying_guide.php">
								<span class="title">Add Buying Guide</span>
							</a>
						</li>
						
					</ul>
				</li>
				<li>
					<a href="<?php echo baseURL();?>/select_cat.php">
						Crawled Data Admin
					</a>
				</li>
				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						Manage <i class="icon-arrow"></i>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo baseURL();?>/users/add_user.php">
								<span class="title">Add New User</span>
							</a>
						</li>
						<li>
							<a href="<?php echo baseURL();?>/crawl/changed_links.php">
								<span class="title">Crawled Urls Status</span>
							</a>
						</li>
						
					</ul>
				</li>

				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						Multi-Vendor/Retailers <i class="icon-arrow"></i>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo baseURL();?>/retailers/activate_user.php">
								<span class="title">Activate Retailer Account</span>
							</a>
						</li>
						<li>
							<a href="<?php echo baseURL();?>/upload_retailer_sheet">
								<span class="title">Upload Retailer CSV</span>
							</a>
						</li>
						<li>
							<a href="<?php echo baseURL();?>/retailers/select_retailer.php?">
								<span class="title">Retailer Products</span>
							</a>
						</li>
						<li>
							<a href="<?php echo siteAdminBaseURL();?>/admin/choose_merchant">
								<span class="title">Online Merchants Invoice</span>
							</a>
						</li>
						<li>
							<a href="<?php echo siteAdminBaseURL();?>/admin/choose_retailer">
								<span class="title">Offline Retailers Invoice</span>
							</a>
						</li>
						<li>
							<a href="<?php echo siteAdminBaseURL();?>/admin/choose_invoice_dates">
								<span class="title">General Invoice</span>
							</a>
						</li>

						
					</ul>
				</li>

				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						Invoice Reports <i class="icon-arrow"></i>
					</a>
					<ul class="dropdown-menu">

						<li>
							<a href="<?php echo siteAdminBaseURL();?>/admin/choose_merchant">
								<span class="title">Online Merchants Invoice</span>
							</a>
						</li>
						<li>
							<a href="<?php echo siteAdminBaseURL();?>/admin/choose_retailer">
								<span class="title">Offline Retailers Invoice</span>
							</a>
						</li>
						<li>
							<a href="<?php echo siteAdminBaseURL();?>/admin/choose_invoice_dates">
								<span class="title">General Invoice</span>
							</a>
						</li>


					</ul>
				</li>
				
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
</div>