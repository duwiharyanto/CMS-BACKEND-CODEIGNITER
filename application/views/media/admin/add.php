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
								<label>Tanggal</label>
								<input type="text" name="media_tersimpan" class="form-control" value="<?= date('d-m-Y')?>" readonly="readonly">
							</div>							
							<div class="form-group">
								<label>Nama</label>
								<input type="text" name="media_nama" class="text-capitalize form-control">
							</div>																																											 
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>File</label>
								<input type="file" name="fileupload">
								<p class="help-block">Ukuran maksimal 5mb, jpg atau png</p>
							</div>							
							<div class="form-group">
								<button type="submit" value="submit" name="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
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
<?php include 'action.php'?>