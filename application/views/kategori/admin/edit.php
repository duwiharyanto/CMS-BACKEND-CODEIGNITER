<div class="row">
	<div class="col-sm-12 animated bounceInRight">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title"><?= ucwords($global->headline)?></h3>
			</div>
			<div class="box-body">
				<form id="formadd" method="POST" action="<?= base_url($global->url)?>" enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Id</label>
								<input type="text" name="id" placeholder="Auto Generated" readonly class="form-control" value="<?= $data->kategori_id?>">
							</div>
							<div class="form-group">
								<label>Tanggal Tersimpan</label>
								<input type="text" name="kategori_tersimpan" class="form-control" value="<?= date('d-m-Y',strtotime($data->kategori_tersimpan))?>" readonly="readonly">
							</div>																			
							<div class="form-group">
								<label>Nama Kategori</label>
								<input required type="text" name="kategori_nama" class="text-capitalize form-control" value="<?= $data->kategori_nama?>">
							</div>
							<div class="form-group">
								<label>Status</label>
								<select class="form-group selectdata" name="kategori_status" style="width:100%">
									<option value="1" <?= $data->kategori_status=='1'? 'selected':''?>>Aktif</option>
									<option value="0" <?= $data->kategori_status=='0'? 'selected':''?>>Tidak Aktif</option>
								</select>
							</div>																																																		 
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">						
							<div class="form-group">
								<button type="submit" value="submit" name="submit" class="btn btn-warning btn-block btn-flat">Update</button>
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