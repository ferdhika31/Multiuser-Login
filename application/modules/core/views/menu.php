<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">

		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<!-- Sidebar user panel (optional) -->
			<div class="user-panel">
				<div class="pull-left image">
					<img src="<?php echo base_url('assets/img/default.png');?>" class="img-circle" alt="User Image">
				</div>

				<div class="pull-left info">
					<p><?php echo $akunInfo['nama_user'];?></p>
					<!-- Status -->
					<a href="<?php echo site_url('profile');?>"><?php echo $akunInfo['name'];?></a>
				</div>
			</div>

			<!-- search form (Optional)
			<form action="#" method="get" class="sidebar-form">
				<div class="input-group">
					<input type="text" name="q" class="form-control" placeholder="Search...">
					<span class="input-group-btn">
						<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
					</span>
				</div>
			</form> -->

			<!-- Sidebar Menu -->
			<ul class="sidebar-menu">
				<li class="header">Main Navigation</li>
				<!-- Optionally, you can add icons to the links -->
				<li<?php echo($active_menu=='dashboard')? " class=\"active\"": "";?>>
					<a href="<?php echo site_url('core/dashboard');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
				</li>

				
				<li class="treeview<?php echo($active_menu=='user' || $active_menu=='user_group' || $active_menu=='user_pages')? " active": "";?>">
					<a href="#"><i class="fa fa-user"></i> <span>User</span> <i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li<?php echo($active_menu=='user')? " class=\"active\"": "";?>>
							<a href="<?php echo site_url('core/user');?>"><i class="fa fa-circle-o "></i> User</a>
						</li>
						<li<?php echo($active_menu=='user_group')? " class=\"active\"": "";?>>
							<a href="<?php echo site_url('core/user_group');?>"><i class="fa fa-circle-o "></i> User Group</a>
						</li>
						<li<?php echo($active_menu=='user_pages')? " class=\"active\"": "";?>>
							<a href="<?php echo site_url('core/user_pages');?>"><i class="fa fa-circle-o "></i> User Pages</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="<?php echo site_url('core/dashboard/logout');?>"><i class="fa fa-sign-out"></i> <span>Logout</span></a>
				</li>
			</ul><!-- /.sidebar-menu -->
		</section>
		<!-- /.sidebar -->
	</aside>
