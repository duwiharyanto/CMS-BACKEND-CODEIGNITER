<div class="row">
	<div class="col-sm-12 animated bounceInRight">
		<form id="formadd" method="POST" action="<?= base_url($global->url)?>" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-9">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title"><?= ucwords($global->headline)?></h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-sm-12">	
									<div class="form-group">
										<label>Judul</label>
										<input type="text" name="post_judul" class="form-control" value="<?= $data->post_judul?>">
									</div>									
									<div class="form-group">
										<label>Konten</label>
										<textarea class="form-control" id="editor1" name="post_post"><?=$data->post_post?></textarea>
									</div>																				
								</div>
							</div>
						</div>
					</div>				
				</div>	
				<div class="col-sm-3">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title"><span class="fa fa-gears"></span></h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Id</label>
										<input type="text" name="id" value="<?=$data->post_id?>" readonly class="form-control">
									</div>
									<div class="form-group">
										<label>Tanggal Tersimpan</label>
										<input type="text" name="post_tersimpan" class="form-control" value="<?= date('d-m-Y',strtotime($data->post_tersimpan))?>" readonly="readonly">
									</div>																			
									<div class="form-group">
										<label>Kategori</label>
										<select class="form-control selectdata" name="post_idkategori">
											<?php foreach($kategori AS $row):?>
												<option value="<?=$row->kategori_id?>?" <?=$data->post_idkategori==$row->kategori_id ? 'selected':''?>><?=$row->kategori_nama?></option>
											<?php endforeach;?>
										</select>
									</div>
									<div class="form-group">
										<label>Status</label>
										<select class="form-group selectdata" name="post_status" style="width:100%">
											<option value="1" <?=$data->post_status==1 ? 'selected':''?>>Aktif</option>
											<option value="0" <?=$data->post_status==0 ? 'selected':''?>>Tidak Aktif</option>
										</select>
									</div>
									<div class="form-group">
										<label>Featurd Image</label>
										<input type="file" name="fileupload">
										<p class="help-block">Ukuran maksimal 5mb, jpg atau png</p>
									</div>																			
									<div class="form-group">
										<button type="submit" value="submit" name="submit" class="btn btn-warning btn-block btn-flat">Update</button>
									</div>																																																																		 
								</div>
							</div>							
						</div>
					</div>
				</div>		
			</div>
		</form>			
	</div>	
</div>
<script type="text/javascript">
	CKEDITOR.replace('editor1',{
		height:300,
	});
</script>
<?php include 'action.php'?>