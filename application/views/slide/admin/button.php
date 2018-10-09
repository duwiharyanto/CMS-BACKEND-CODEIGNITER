<div class="btn-group">

	<a href="#" id="<?=$row->slide_id?>" url="<?= base_url($global->url.'detail')?>" class="detail btn btn-flat btn-xs btn-success <?= $global->detail!=true ? 'hide':'' ?>"><span class="fa fa-eye"></span></a>
	<a href="#"   id="<?=$row->slide_id?>" url="<?= base_url($global->url.'edit')?>" class="edit btn btn-flat btn-xs btn-warning <?= $global->edit!=true ? 'hide':'' ?>"><span class="fa fa-pencil"></span></a>
	<a href="#" url="<?=base_url($global->url.'hapus/'.$row->slide_id)?>"  class="hapus btn btn-flat btn-xs btn-danger <?= $global->delete!=true ? 'hide':'' ?>"><span class="fa fa-trash"></span></a>
</div>