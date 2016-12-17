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
					<a class="btn btn-primary btn-md" href="<?php echo $href_add;?>">
						<i class="fa fa-plus"></i> Add Group
					</a> <br></br>
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">List <?php echo $title;?></h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<table class="table table-bordered">
								<tr>
									<th style="width: 20px">#</th>
									<th>Group Name</th>
									<th style="width: 50%">Action</th>
								</tr>
								<?php
									if(!empty($data)):
										foreach ($data as $data):
								?>
								<tr>
									<td>
										<?php echo $data['no'];?>
									</td>
									<td>
										<?php echo $data['nama'];?>
									</td>
									<td style="width: 50%">
										<a class="btn btn-primary btn-xs" href="<?php echo $data['href_permission'];?>" title="Permission">
											<i class="fa fa-users"></i> Permission
										</a>
										<a class="btn btn-default btn-xs" href="<?php echo $data['href_edit'];?>" title="Edit">
											<i class="fa fa-edit"></i> Edit
										</a>
									</td>
								</tr>
								<?php
										endforeach;
									else:
								?>
								<tr>
									<td colspan="3">No result.</td>
								</tr>
								<?php
									endif;
								?>
							</table>
						</div><!-- /.box-body -->
					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

<script type="text/javascript">
	function lihatFoto(url){
		$("#fotona").attr("src", url);
		$('#modalFoto').modal('show'); // show bootstrap modal
	}
</script>

<div id="modalFoto" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Lihat Foto</h3>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-12" style="text-align:center;">
						<img src="<?php echo base_url('assets/upload/alumni/default.png'); ?>" id="fotona" width="220px" height="220px">
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
					<i class="ace-icon fa fa-times"></i>
					Close
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>