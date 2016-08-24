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
					<form action="" method="post">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title"><?php echo $title;?></h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<table class="table table-bordered">
								<tr>
									<th style="width: 20px">#</th>
									<th>Page Name</th>
									<th style="width: 50%">Action</th>
								</tr>
								<?php
									if(!empty($page)):
										$no=1;
										foreach ($page as $page):
								?>
								<tr>
									<td>
										<?php echo $no;?>
									</td>
									<td>
										<?php echo $page['page_name'];?>
									</td>
									<td style="width: 50%">
										<center>
										<?php 
											$array_permisi = unserialize($admin['permission']);
											if(in_array($page['user_page_id'],$array_permisi['view'])) { ?>
            									<label>
            										<input type="checkbox" name="permission[view][]" value="<?php echo $page['user_page_id'];?>" checked="checked" /> View
            									</label>
            							<?php } else { ?>
           									 	<label>
           									 		<input type="checkbox" name="permission[view][]" value="<?php echo $page['user_page_id'];?>" /> View
           									 	</label>
       									<?php } ?>

       									<?php 
											if(in_array($page['user_page_id'],$array_permisi['modif'])) { ?>
            									<label>
            										<input type="checkbox" name="permission[modif][]" value="<?php echo $page['user_page_id'];?>" checked="checked" /> Modify
            									</label>
            							<?php } else { ?>
           									 	<label>
           									 		<input type="checkbox" name="permission[modif][]" value="<?php echo $page['user_page_id'];?>" /> Modify
           									 	</label>
       									<?php } ?>
										</center>
									</td>
								</tr>
								<?php
										$no++;
										endforeach;
									else:
								?>
								<tr>
									<td colspan="3">Tidak ada halaman.</td>
								</tr>
								<?php
									endif;
								?>
							</table>
						</div><!-- /.box-body -->
					</div>
					<center>
						<input type="submit" class="btn btn-primary" value="Change" name="change" />
					</center>
					</form>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->