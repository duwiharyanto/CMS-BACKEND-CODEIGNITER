<div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Tabel <?php echo ucwords($global->headline)?></h3>
        </div>
        <div class="box-body table-responsive">
        	<table style="width:100%" id="datatabel" class="table table-bordered table-striped">
                <thead>
	                <tr>
	                  <th width="5%">No</th>
	                  <th width="10%">Tersimpan</th>
	                  <th width="10%">Nama</th>
	                  <th width="50%">Path</th>
	                  <th width="10%" class="text-center">Aksi</th>
	                </tr>
                </thead>
                <tbody>
                	<?php $i=1;foreach ($data as $row):?>
	                	<tr>
	                		<td><?=$i?></td>
	                		<td><?=$row->media_nama?></td>
	                		<td><?=date('d-m-Y',strtotime($row->media_tersimpan))?><br>
	                		<td><?='./upload/media/'.$row->media_path?><br>
	                		<td class="text-center">
	                			<?php include 'button.php';?>
	                		</td>
	                	</tr>	                	
                	<?php $i++;endforeach;?>
                </tbody>            		
        	</table>
        	<p>Keterengan : <br>
        		<a href="#" class="btn btn-flat btn-xs btn-warning" style="width:25px"><span class="fa fa-eye"></span></a> : Detail<br>
        		<a href="#" class="btn btn-flat btn-xs btn-info" style="width:25px"><span class="fa fa-pencil"></span></a> : Edit<br>
        		<a href="#" class="btn btn-flat btn-xs btn-danger" style="width:25px"><span class="fa fa-trash"></span></a> : Hapus	
        	</p>
        </div>
</div>
<?php include 'action.php';?>