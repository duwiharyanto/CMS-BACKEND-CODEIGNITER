<div class="row">
	<div class="col-sm-12 animated bounceInRight">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><?= ucwords($global->headline)?></h3>
			</div>
			<div class="box-body">
				<form id="formadd" method="POST" action="<?= base_url($global->url)?>" enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Id</label>
								<input type="text" name="id" placeholder="Auto Generated" readonly class="form-control">
							</div>
							<div class="form-group">
								<label>Tanggal Tersimpan</label>
								<input type="text" name="user_tersimpan" class="form-control" value="<?= date('d-m-Y')?>" readonly="readonly">
							</div>																			
							<div class="form-group">
								<label>Nama</label>
								<input required type="text" name="user_nama" class="text-capitalize form-control">
							</div>
							<div class="form-group">
								<label>Username</label>
								<input required type="text" name="user_username" class="form-control">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input required type="password" name="user_password" class="form-control">
							</div>
							<div class="form-group">
								<label>Email</label>
								<input required type="email" name="user_email" class="form-control">
							</div>
							<div class="form-group">
								<label>Level</label>
								<select class="form-group selectdata" name="user_level" style="width:100%">
									<option value="1">Admin</option>
									<option value="0">Operator</option>
								</select>
							</div>																												
							<div class="form-group">
								<label>Status</label>
								<select class="form-group selectdata" name="user_status" style="width:100%">
									<option value="1">Aktif</option>
									<option value="0">Tidak Aktif</option>
								</select>
							</div>																																																		 
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">						
							<div class="form-group">
								<button type="submit" value="submit" name="submit" url="<?= base_url($global->url.'simpan')?>" class="btn btn-primary btn-block btn-flat">Simpan</button>
							</div>														
						</div>
					</div>
				</form>		
			</div>
		</div>		
	</div>	
</div>
<script type="text/javascript">
	//CKEDITOR.replace('editor1');
</script>
<?php include 'action.php';?>