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
					<div id="alert"></div>
					<a class="btn btn-primary btn-md" href="<?php echo $href_add;?>">
						<i class="fa fa-plus"></i> Add Page
					</a> <br></br>
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">List <?php echo $title;?></h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<table class="table table-bordered">
								<tr>
									<th style="width: 20px">#</th>
									<th>Page Name</th>
									<th style="width: 50%">Action</th>
								</tr>
								<?php
									if(!empty($data)):
										foreach ($data as $data):
								?>
								<tr id="page<?php echo $data['id'];?>">
									<td>
										<?php echo $data['no'];?>
									</td>
									<td>
										<?php echo $data['nama'];?>
									</td>
									<td style="width: 50%">
										<a class="btn btn-default btn-xs" href="<?php echo $data['href_edit'];?>" title="Edit">
											<i class="fa fa-pencil"></i>
										</a>
										<button onclick="mdlHapus(<?php echo $data['id'];?>)" class="btn btn-danger btn-xs" title="Delete">
											<i class="glyphicon glyphicon-trash"></i>
										</button>
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
							<?php if(!empty($halaman)): ?>
								<?php echo $halaman; ?>
							<?php endif; ?>
						</div><!-- /.box-body -->
					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

<script type="text/javascript">
	function mdlHapus(id){
		$("#delId").val(id);
		$('#mdlHapus').modal('show'); // show bootstrap modal
	}

	function hapusHalaman(){
		var id = $("#delId").val();

		$.post("<?php echo site_url('user_pages/delete');?>", { 
			id: id
		}, function(res) {
			if(res.status){
				$("#page"+id).remove();

				var textAlert;
				textAlert = "<div class=\"alert alert-success alert-dismissable\">";
				textAlert += "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				textAlert += "	<h4><i class=\"icon fa fa-check\"></i> Success!</h4>";
				textAlert += "	Messages : "+res.message;
				textAlert += "</div>";

				$("#alert").append(textAlert);
			}else{
				var textAlert;
				textAlert = "<div class=\"alert alert-warning alert-dismissable\">";
				textAlert += "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				textAlert += "	<h4><i class=\"icon fa fa-warning\"></i> Perhatian!</h4>";
				textAlert += "	Messages : "+res.message;
				textAlert += "</div>";

				$("#alert").append(textAlert);
			}
		}, "json");
	}
</script>

<div id="mdlHapus" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<input class="form-control" id="delId" type="hidden" value="0">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Confirmation</h3>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						Are you sure?
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
				<button class="btn btn-sm btn-danger pull-right" onclick="hapusHalaman()" data-dismiss="modal">
					<i class="ace-icon fa fa-trash"></i>
					Delete
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>