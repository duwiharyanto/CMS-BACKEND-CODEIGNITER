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
								<input type="text" name="id" readonly class="form-control" value="<?= $data->slide_id?>">
							</div>
							<div class="form-group">
								<label>Tanggal Tersimpan</label>
								<input type="text" name="slide_tersimpan" class="form-control" value="<?= date('d-m-Y',strtotime($data->slide_tersimpan))?>" readonly="readonly">
							</div>	
							<div class="form-group">
								<label>Kategori</label>
								<select class="form-group selectdata" name="slide_idkategori" style="width:100%">
									<?php foreach($kategori AS $row):?>
										<option value="<?= $row->kategori_id?>" <?= $row->kategori_id==$data->slide_idkategori? 'selected':''?>><?= $row->kategori_nama?></option>
									<?php endforeach;?>
								</select>
							</div>													
							<div class="form-group">
								<label>Nama</label>
								<input type="text" name="slide_nama" class="text-capitalize form-control" value="<?= $data->slide_nama?>">
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