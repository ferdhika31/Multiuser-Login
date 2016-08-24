<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo $title;?></title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="<?php echo $asset;?>css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="<?php echo $asset;?>css/font-awesome.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo $asset;?>css/AdminLTE.min.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
			<div id="loginbox" style="margin-top:135px;" class="mainbox col-md-6 col-md-offset-4 col-sm-6 col-sm-offset-4 col-lg-4 col-lg-offset-4">
				<div class="panel panel-info" >
					<div class="panel-heading">
						<div class="panel-title">Silahkan masuk dengan akun anda.</div>
					</div>
					<div style="padding-top:30px" class="panel-body" >
						<?php if(!empty($message)):?>
						<div class="alert alert-warning alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4><i class="icon fa fa-warning"></i> Alert!</h4>
							<?php echo $message;?>
						</div>
						<?php endif;?>
						<form action="" id="loginform" class="form-horizontal" role="form" method="post">
							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input type="text" class="form-control" name="login[username]" placeholder="Username">
							</div>

							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input type="password" class="form-control" name="login[password]" placeholder="Password">
							</div>

							<div style="margin-top:10px" class="form-group">
									<!-- Button -->
									<div class="col-sm-12 controls" align="right">
										<button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
									</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- jQuery 2.1.4 -->
		<script src="<?php echo $asset;?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- Bootstrap 3.3.5 -->
		<script src="<?php echo $asset;?>js/bootstrap.min.js"></script>
	</body>
</html>
