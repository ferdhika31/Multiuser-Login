			<!-- Main Footer -->
			<footer class="main-footer">
				<!-- To the right -->
				<div class="pull-right hidden-xs">
					Made with <span class="glyphicon glyphicon-headphones text-danger" aria-hidden="true"></span> & <span class="glyphicon glyphicon-heart text-danger" aria-hidden="true"></span> from Bandung, Indonesia.
				</div>
				<!-- Default to the left -->
				<strong><?php echo $_SESSION['site_footer'];?></strong>
			</footer>
		</div><!-- ./wrapper -->

		<!-- REQUIRED JS SCRIPTS -->

		<!-- jQuery 2.1.4 -->
		<script src="<?php echo $asset;?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- Bootstrap 3.3.5 -->
		<script src="<?php echo $asset;?>js/bootstrap.min.js"></script>
		<!-- AdminLTE App -->
		<script src="<?php echo $asset;?>js/app.min.js"></script>

		<?php
		if(isset($script)):
			foreach ($script as $script):
		?>
		<script src="<?php echo $script;?>"></script>
		<?php
			endforeach;
		endif;
		?>

		<?php if(isset($add_script)):?>
		<script><?php echo $add_script;?></script>
		<?php endif;?>

		<!-- Optionally, you can add Slimscroll and FastClick plugins.
		Both of these plugins are recommended to enhance the
		user experience. Slimscroll is required when using the
		fixed layout. -->
	</body>
</html>
