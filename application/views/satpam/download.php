<?php
$nama = get_data('users','id_user',$this->uri->segment(3),'nama');
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=tracking_$nama.xls");
?>
<div class="row">
	<div class="col-md-12">
		<h4>Riwayat Tracking <?php echo $nama ?></h4>
		<hr>
		<table class="table table-stripped">
			<thead>
				<tr>
					<th>No.</th>
					<th>Lokasi </th>
					<th>Latitude </th>
					<th>Longitude </th>
					<th>Date </th>
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
					</tr>
				<?php $no++; endforeach ?>
				
			</tbody>
		</table>
	</div>
</div>