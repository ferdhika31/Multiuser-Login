Content Wrapper. Contains page content -->
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
					<?php echo $notif;?>
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#profil" data-toggle="tab">Info</a></li>
						</ul>

						<div class="tab-content">
                  
							<div class="active tab-pane" id="profil">
								<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
									<div class="form-group">
										<label for="nama" class="col-sm-2 control-label">Full Name</label>
										<div class="col-sm-10">
											<input type="text" name="nama" class="form-control" value="<?php echo (!empty($datana['nama_user'])) ? $datana['nama_user'] : set_value('nama');?>" id="nama" placeholder="">
										</div>
									</div>

									<!-- <div class="form-group">
										<label for="tempat_lahir" class="col-sm-2 control-label">Place of birth</label>
										<div class="col-sm-10">
											<input type="text" name="tempat_lahir" class="form-control" value="<?php echo (!empty($datana['tempat_lahir'])) ? $datana['tempat_lahir'] : '';?>" id="tempat_lahir" placeholder="">
										</div>
									</div>

									<div class="form-group">
										<label for="tgl_lahir" class="col-sm-2 control-label">Date of Birth</label>
										<div class="col-sm-10">
											<input type="text" name="tgl_lahir" class="form-control" value="<?php echo (!empty($datana['tanggal_lahir'])) ? $datana['tanggal_lahir'] : date("Y-m-d");?>" id="tgl_lahir" placeholder="">
										</div>
									</div> -->

									<div class="form-group">
										<label for="jk" class="col-sm-2 control-label">Gender</label>
										<div class="col-sm-10">
											<input type="radio" name="jk"<?php echo (strtolower(@$datana['jenis_kelamin'])=='pria')? ' checked':'';?> value="Pria"> Male
											<input type="radio" name="jk"<?php echo (strtolower(@$datana['jenis_kelamin'])=='wanita')? ' checked':'';?> value="Wanita"> Female
										</div>
									</div>	

									<div class="form-group">
										<label for="alamat" class="col-sm-2 control-label">Address</label>
										<div class="col-sm-10">
											<textarea name="alamat" class="form-control" id="alamat" placeholder=""><?php echo (!empty($datana['alamat'])) ? $datana['alamat'] : set_value('alamat');?></textarea>
										</div>
									</div>			

									<div class="form-group">
										<label for="telp" class="col-sm-2 control-label">No. Telp</label>
										<div class="col-sm-10">
											<input type="text" name="telp" class="form-control" value="<?php echo (!empty($datana['telp'])) ? $datana['telp'] : set_value('telp');?>" id="telp" placeholder="">
										</div>
									</div>		

									<div class="form-group">
										<label for="email" class="col-sm-2 control-label">Email</label>
										<div class="col-sm-10">
											<input type="email" name="email" class="form-control" value="<?php echo (!empty($datana['email_user'])) ? $datana['email_user'] : set_value('email');?>" id="email" placeholder="">
										</div>
									</div>

									<div class="form-group">
										<label for="username" class="col-sm-2 control-label">Username</label>
										<div class="col-sm-10">
											<input type="text" name="username" class="form-control" <?php echo (!empty($datana['username'])) ?'disabled readonly': '';?> value="<?php echo (!empty($datana['username'])) ? $datana['username'] : set_value('username');?>" id="username" placeholder="">
										</div>
									</div>

									<div class="form-group">
										<label for="password" class="col-sm-2 control-label">Password</label>
										<div class="col-sm-10">
											<input type="password" name="password" class="form-control" value="<?php set_value('password'); ?>" id="password" placeholder="">
										</div>
									</div>

									<div class="form-group">
										<label for="user_group" class="col-sm-2 control-label">User Group</label>
										<div class="col-sm-10">
											<select name="user_group" class="form-control">
												<?php if(!empty($user_group)): ?>
													<?php foreach($user_group as $ug): ?>
														<option value="<?php echo $ug['user_group_id'];?>"><?php echo $ug['name'];?></option>
													<?php endforeach; ?>
												<?php endif; ?>
											</select>
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
	</div><!-- /.content-wrapper