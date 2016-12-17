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
				<div class="col-xs-12">
						<a class="btn btn-primary btn-md" href="<?php echo $href_add;?>">
							<i class="fa fa-plus"></i> Add User
						</a> <br></br>
					<?php echo $notif;?>
					<div id="alert"></div>
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">List <?php echo $title;?></h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<table class="table table-bordered">
								<tr>
									<th style="width: 20px">#</th>
									<!-- <th>Photo</th> -->
									<th>Name</th>
									<th>Email</th>
									<th>Phone Number</th>
									<th>Role User</th>
									<th style="width: 10%">Action</th>
								</tr>
								<?php
									if(!empty($dataUser)):
										foreach ($dataUser as $dataUser):
								?>
								<tr id="user<?php echo $dataUser['id'];?>">
									<td>
										<?php echo $dataUser['no'];?>
									</td>
									<!-- <td style="text-align:center;cursor:pointer;">
										<img onclick="lihatFoto('<?php echo $dataUser['foto'];?>')" src="<?php echo $dataUser['foto'];?>" height="50px">
									</td> -->
									<td>
										<?php echo $dataUser['nama'];?>
									</td>
									<td>
										<?php echo $dataUser['email'];?>
									</td>
									<td>
										<?php echo $dataUser['telp'];?>
									</td>
									<td>
										<?php echo $dataUser['hak'];?>
									</td>
									<td style="width: 20%">
										<button class="btn btn-xs btn-primary" title="View" onclick="lihat(<?php echo $dataUser['id'];?>)">
											<i class="fa fa-eye"></i>
										</button>
										<a class="btn btn-default btn-xs" href="<?php echo $dataUser['href_edit'];?>" title="Ubah">
											<i class="fa fa-pencil"></i>
										</a>
										<button class="btn btn-danger btn-xs" title="Hapus" onclick="mdlhapus(<?php echo $dataUser['id'];?>)">
											<i class="glyphicon glyphicon-trash"></i>
										</button>
									</td>
								</tr>
								<?php
										endforeach;
									else:
								?>
								<tr>
									<td colspan="7">Tidak ada data.</td>
								</tr>
								<?php
									endif;
								?>
							</table>
						</div><!-- /.box-body -->
						<div class="box-footer clearfix">
							<?php echo (!empty($halaman)) ? $halaman:'';?>
						</div>
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

	function lihat(id){
		$.ajax({
			url:"<?php echo site_url('core/user/getOne')?>/"+id,
			type:'get',
			dataType: 'json',
			success: function(data) {
				console.log(data);

				$("#full_name").val(data.nama_user);
				$("#gender").val(data.jenis_kelamin);
				$("#address").val(data.alamat);
				$("#telp").val(data.telp);
				$("#email").val(data.email_user);
				$("#username").val(data.username);
				$("#user_group").val(data.name);
			}
		});

		$('#modalUser').modal('show'); // show bootstrap modal
	}

	function mdlhapus(id){
		$("#delIDPek").val(id);
		$('#mdlHapus').modal('show'); // show bootstrap modal
	}

	function hapus(){
		var id = $("#delIDPek").val();

		$.post("<?php echo site_url('core/user/hapus');?>", { 
			id: id
		}, function(res) {
			if(res.status){
				$("#user"+id).remove();

				var textAlert;
				textAlert = "<div class=\"alert alert-success alert-dismissable\">";
				textAlert += "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				textAlert += "	<h4><i class=\"icon fa fa-check\"></i> Success!</h4>";
				textAlert += "	Pesan : "+res.message;
				textAlert += "</div>";

				$("#alert").append(textAlert);
			}else{
				var textAlert;
				textAlert = "<div class=\"alert alert-warning alert-dismissable\">";
				textAlert += "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				textAlert += "	<h4><i class=\"icon fa fa-warning\"></i> Perhatian!</h4>";
				textAlert += "	Pesan : "+res.message;
				textAlert += "</div>";

				$("#alert").append(textAlert);
			}
		}, "json");
	}
</script>

<div id="mdlHapus" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<input class="form-control" id="delIDPek" type="hidden" value="0">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Konfirmasi</h3>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						Apakah benar akan di hapus?
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
				<button class="btn btn-sm btn-danger pull-right" onclick="hapus()" data-dismiss="modal">
					<i class="ace-icon fa fa-trash"></i>
					Delete
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

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

<div id="modalUser" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Data User</h3>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="form-group">
						<div class="col-md-6">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Full Name
							</label>
							<input type="text" readonly id="full_name" class="form-control" />
						</div>

						<div class="col-md-6">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Gender
							</label>
							<input type="text" readonly id="gender" class="form-control" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Address
							</label>
						</div>

						<div class="col-md-12">
							<textarea readonly id="address" class="form-control"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-6">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								No Telp
							</label>
							<input type="text" readonly id="telp" class="form-control" />
						</div>

						<div class="col-md-6">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Email
							</label>
							<input type="text" readonly id="email" class="form-control" />
						</div>
					</div>
				</div>

				<div class="row">
					<div class="form-group">
						<div class="col-md-6">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Username
							</label>
							<input type="text" readonly id="username" class="form-control" />
						</div>

						<div class="col-md-6">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								User Group
							</label>
							<input type="text" readonly id="user_group" class="form-control" />
						</div>
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