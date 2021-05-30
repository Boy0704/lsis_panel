<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<td>No.</td>
					<td>File</td>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no = 1;
				$this->db->where('id_agree', $id);
				foreach ($this->db->get('agree_kurang')->result() as $rw): ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><a href="files/agreement/<?php echo $rw->link ?>" class="label label-info">Lihat</a></td>
				</tr>
				<?php $no++; endforeach ?>
			</tbody>
		</table>
	</div>
</div>