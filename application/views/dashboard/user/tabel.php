<div class="row">
	<div class="col-sm-3">
		<div class="box box-primary">
			<div class="box-body box-profile">
			  <img class="profile-user-img img-responsive img-circle" src="<?= base_url('./asset/dist/img/user.png')?>" alt="User profile picture">

			  <h3 class="profile-username text-center"><?=ucwords($this->session->userdata('user_nama'))?></h3>

			  <p class="text-muted text-center"><?=$this->session->userdata('user_email')?></p>

			  <ul class="list-group list-group-unbordered">
			    <li class="list-group-item">
			      <b>Terdaftar</b> <a class="pull-right"><?=date('d-m-Y',strtotime($this->session->userdata('user_terdaftar')))?></a>
			    </li>
			    <li class="list-group-item">
			      <b>Username</b> <a class="pull-right"><?=$this->session->userdata('user_username')?></a>
			    </li>
			    <li class="list-group-item">
			      <b>Level</b> <a class="pull-right"><?=$this->session->userdata('user_level')==1 ? 'Administrator':'Operator'?></a>
			    </li>
			  </ul>
			  <a href="#" class="btn btn-primary btn-block disabled"><b>Edit</b></a>
			  <p class="help-block">Silahkan menghubungi admin untuk melakukan perubahan</p>
			</div>
		</div>		
	</div>
	<div class="col-sm-9">
		<div class="box box-primary">
		        <div class="box-header">
		          <h3 class="box-title">Berita 10 Terakhir</h3>
		        </div>
		        <div class="box-body table-responsive">
		        	<table style="width:100%" class="tabeldashboard table table-bordered table-striped">
		                <thead>
			                <tr>
			                  <th width="5%">No</th>
			                  <th width="5%">Id</th>
			                  <th width="10%">Tanggal</th>
			                  <th width="45%">Judul</th>
			                  <th width="10%">Kategori</th>
			                  <th width="10%" class="text-center">Aksi</th>
			                </tr>
		                </thead>
		                <tbody>
		                	<?php $i=1;foreach ($data as $row):?>
			                	<tr>
			                		<td><?=$i?></td>
			                		<td><?=$row->post_id?></td>
			                		<td><?=date('d-m-y',strtotime($row->post_tersimpan))?></td>
			                		<td><?=ucwords($row->post_judul)?><br>
			                		<td><?=$row->post_idkategori?></td>
			                		<td class="text-center">
			                			<a href="<?= base_url('berita/user')?>"  class="btn btn-flat btn-xs btn-success <?= $global->detail!=true ? 'disabled':'' ?>"><span class="fa fa-eye"></span></a>
			                		</td>
			                	</tr>	                	
		                	<?php $i++;endforeach;?>
		                </tbody>            		
		        	</table>
		        </div>
		</div>
		<div class="box box-primary">
		        <div class="box-header">
		          <h3 class="box-title">Media 10 Terakhir</h3>
		        </div>
		        <div class="box-body table-responsive">
		        	<table style="width:100%" class="tabeldashboard table table-bordered table-striped">
		                <thead>
			                <tr>
			                  <th width="5%">No</th>
			                  <th width="10%">Tanggal</th>
			                  <th width="20%">Media</th>
			                  <th width="30%">Path</th>
			                  <th width="10%" class="text-center">Aksi</th>
			                </tr>
		                </thead>
		                <tbody>
		                	<?php $i=1;foreach ($media as $row):?>
			                	<tr>
			                		<td><?=$i?></td>
			                		<td><?=date('d-m-y',strtotime($row->media_tersimpan))?></td>
			                		<td><?=ucwords($row->media_nama)?><br>
			                		<td><?=$row->media_path?></td>
			                		<td class="text-center">
			                			<a href="<?= base_url('media/user')?>" class="btn btn-flat btn-xs btn-success <?= $global->detail!=true ? 'disabled':'' ?>"><span class="fa fa-eye"></span></a>
			                		</td>
			                	</tr>	                	
		                	<?php $i++;endforeach;?>
		                </tbody>            		
		        	</table>
		        </div>
		</div>				
	</div>
</div>
<script type="text/javascript">
	$('.tabeldashboard').DataTable({
		'paging'      : true,
		'lengthChange': false,
		'searching'   : false,
		'ordering'    : true,
		'info'        : true,
		'autoWidth'   : false		
	});
</script>
<?php include 'action.js'; ?>