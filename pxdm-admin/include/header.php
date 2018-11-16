<header class="topbar navbar navbar-inverse navbar-fixed-top inner">
	<!-- start: TOPBAR CONTAINER -->
	<div class="container">
		<div class="navbar-header">
			<a class="sb-toggle-left hidden-md hidden-lg" href="#main-navbar">
				<i class="fa fa-bars"></i>
			</a>
			<!-- start: LOGO >
				<a class="navbar-brand" href="index.html">
				<img src="assets/images/logo.png" alt="Rapido"/>
				</a>
			< end: LOGO -->
		</div>
		<div class="topbar-tools">
			<!-- start: TOP NAVIGATION MENU -->
			<ul class="nav navbar-right">
				<!-- start: USER DROPDOWN -->
				<li class="dropdown current-user">
					<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
						<img src="assets/images/anonymous-small.jpg" class="img-circle" alt=""> <span class="username hidden-xs"><?php if(isset($_SESSION['username'])){echo $_SESSION['username'];}else{echo $_SESSION['username'];}?>></span> 
					</a>
					<ul class="dropdown-menu dropdown-dark">
						<!--li>
							<a href="pages_user_profile.html">
							My Profile
							</a>
							</li>
							<li>
							<a href="pages_calendar.html">
							My Calendar
							</a>
						</li-->
						<li>
							<a href="pages_messages.html">
								My Messages (7)
							</a>
						</li>
						<li>
							<a href="login_lock_screen.html">
								Lock Screen
							</a>
						</li>
						<li>
							<a href="<?php echo baseURL();?>/include/logout.php?Logout=true">
								Log Out
								</a>
						</li>
					</ul>
				</li>
				<!-- end: USER DROPDOWN >
					<li class="right-menu-toggle">
					<a href="#" class="sb-toggle-right">
					<i class="fa fa-globe toggle-icon"></i> <i class="fa fa-caret-right"></i> <span class="notifications-count badge badge-default hide"> 3</span>
					</a>
					</li>
					</ul>
				<!end: TOP NAVIGATION MENU -->
			</div>
		</div>
		<!-- end: TOPBAR CONTAINER -->
	</header>	