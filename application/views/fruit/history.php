<div class="row">
	<div class="col-md-12">
		<h4>Riwayat Tracking <?php echo get_data('users','id_user',$this->uri->segment(3),'nama') ?></h4>
		<hr>
		<div class="table-responsive">
		<table class="table table-stripped" id="example1">
			<thead>
				<tr>
					<th>No.</th>
					<th>Lokasi </th>
					<th>Lat </th>
					<th>Long </th>
					<th>Date </th>
					<th>Pilihan</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				$this->db->where('id_user', $this->uri->segment(3));
				$this->db->order_by('id', 'desc');
				$data = $this->db->get('log_lokasi');
				 foreach ($data->result() as $rw): ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $rw->address ?></td>
						<td><?php echo $rw->latitude ?></td>
						<td><?php echo $rw->longitude ?></td>
						<td><?php echo $rw->created_at ?></td>
						<td>
							<a href="fruit/cek_lokasi/<?php echo $rw->id ?>" class="label label-default">Lihat Lokasi</a>
						</td>
					</tr>
				<?php $no++; endforeach ?>
				
			</tbody>
		</table>
		</div>
	</div>
</div>