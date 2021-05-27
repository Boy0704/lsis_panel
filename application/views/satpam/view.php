<div class="row">
	<div class="col-md-12">
		<table class="table table-stripped">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama</th>
					<th>Pilihan</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				$this->db->where('id_level', '2');
				$data = $this->db->get('users');
				 foreach ($data->result() as $rw): ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $rw->nama; ?></td>
						<td>
							<a href="satpam/cek_posisi/<?php echo $rw->id_user ?>" class="label label-info">Cek Posisi</a>
							<a href="satpam/history/<?php echo $rw->id_user.'?mobile=1' ?>" class="label label-warning">History</a>
							<a href="satpam/download/<?php echo $rw->id_user.'?mobile=1' ?>" class="label label-success">Download History</a>
						</td>
					</tr>
				<?php endforeach ?>
				
			</tbody>
		</table>
	</div>
</div>