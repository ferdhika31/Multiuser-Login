<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				<?php echo $title;?>
				<small><?php echo $description;?></small>
			</h1>
			<?php
                            if(!empty($breadcumb)):
                        ?>
                            <ol class="breadcrumb">
                        <?php
                                foreach ($breadcumb as $breadcumb):
                                    if(empty($breadcumb['link'])):
                        ?>
                                        <li class="active"><?php echo $breadcumb['judul'];?></li>
                        <?php
                                    else:
                        ?>
                                        <li>
                                            <a href="<?php echo $breadcumb['link'];?>">
                                                <?php echo $breadcumb['judul'];?>
                                            </a>
                                        </li>
                        <?php
                                    endif;
                                endforeach;
                        ?>
                            </ol>
                        <?php
                            endif;
                        ?>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<?php if(!empty($message)): ?>
			    		<?php echo $message;?>
					<?php endif;?>
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#profil" data-toggle="tab">Info</a></li>
						</ul>

						<div class="tab-content">
                  
							<div class="active tab-pane" id="profil">
								<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
									<div class="form-group">
										<label for="name" class="col-sm-2 control-label">Group Name</label>
										<div class="col-sm-10">
											<input type="text" name="name" class="form-control" value="<?php echo (!empty($datana['name'])) ? $datana['name'] : '';?>" id="name" placeholder="">
										</div>
									</div>

									<div class="form-group">
										<label for="key" class="col-sm-2 control-label">Key Name</label>
										<div class="col-sm-10">
											<input type="text" name="key" class="form-control" value="<?php echo (!empty($datana['name_key'])) ? $datana['name_key'] : '';?>" id="key" placeholder="">
										</div>
									</div>

									
									
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<input type="submit" class="btn btn-success btn-md" name="simpan" value="Save">
										</div>
									</div>
								</form>
							</div><!-- /.tab-pane -->

						</div><!-- /.tab-content -->
					</div><!-- /.nav-tabs-custom -->
					
				</div><!-- /.col -->
			</div>
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->