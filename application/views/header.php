	<!-- Main Header -->
	<header class="main-header">

		<!-- Logo -->
		<a href="<?php echo site_url('dashboard'); ?>" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><b>D</b>K</span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><?php echo $this->session->userdata('site_title');?></span>
		</a>

		<!-- Header Navbar -->
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>
			<!-- Navbar Right Menu -->
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<!-- User Account Menu -->
					<li class="dropdown user user-menu">
						<!-- Menu Toggle Button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<!-- The user image in the navbar-->
							<img src="<?php echo base_url('assets/img/default.png');?>" height="160px" width="160px" class="user-image" alt="User Image">
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<span class="hidden-xs"><?php echo $akunInfo['nama_user'];?></span>
						</a>
						<ul class="dropdown-menu">
							<!-- The user image in the menu -->
							<li class="user-header">
								<img src="<?php echo base_url('assets/img/default.png');?>" class="img-circle" alt="User Image">
								<p>
								<?php echo $akunInfo['nama_user'];?>
								<small>Member since <?php echo tgl_indo(substr($akunInfo['date_created'], 0, 10)); ?></small>
								</p>
							</li>

							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<a href="<?php echo site_url('profile'); ?>" class="btn btn-default btn-flat">Profile</a>
								</div>
								<div class="pull-right">
									<a href="<?php echo site_url('dashboard/keluar'); ?>" class="btn btn-default btn-flat">Sign out</a>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
	</header>