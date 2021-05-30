<div class="row">
	<div class="col-md-12" style="margin-bottom: 20px">
		<a href="agreement/add?konten_manual=1&<?php echo param_get() ?>" class="btn btn-success">Tambah</a>
	</div>
	<div class="col-md-12">
		<div class="table-responsive">
		<table class="table table-bordered" id="example1">
			<thead>
				<tr>
					<th>No.</th>
					<th>Dibuat Oleh</th>
					<th>Date</th>
					<th>Status</th>
					<th>Pilihan</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no = 1;
				$id_user = $this->input->get('id_user');
				$level = get_data('users','id_user',$id_user,'id_level');
				if ($this->session->userdata('level') != '' && $this->session->userdata('level') == 'admin') {
					// code...
				} else {
					$this->db->where('id_user', $this->input->get('id_user'));
				}
				
				$this->db->order_by('id_agree', 'desc');
				foreach ($this->db->get('agreement')->result() as $rw): ?>
				
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo get_data('users','id_user',$rw->user_at,'nama') ?></td>
					<td><?php echo $rw->created_at ?></td>
					<td><?php 
					if ($rw->status == 'final') {
						echo '<span class="label label-success">Final</span>';
					} elseif ($rw->status == 'kurang') {
						echo '<span class="label label-warning">Data Kurang</span>';
					} else {
						echo '<span class="label label-default">Proses</span>';
					}

					 ?></td>
					<td>
						<a href="agreement/detail/<?php echo $rw->id_agree.'?konten_manual=1&'.param_get() ?>" class="label label-primary">Detail</a>
						<?php 
						if ($rw->status == 'final') {
							?>
							<a href="agreement/download/<?php echo $rw->id_agree ?>" class="label label-success">Download</a>

							<?php 
							
						} elseif ($rw->status == 'kurang') {
							?>
							<a href="agreement/upload_kurang/<?php echo $rw->id_agree ?>" class="label label-info">Lihat data yang kurang</a>

							<?php
						}
						 
						 ?>

						<?php if ($rw->status == 'proses'): ?>
							<a href="agreement/delete/<?php echo $rw->id_agree ?>" onclick="javasciprt: return confirm('Yakin akan hapus data ini ?')" class="label label-danger">Hapus</a>
						<?php endif ?>

						<?php if ($level == '6' || $level == '9'): ?>
							<a href="agreement/upload_hasil/<?php echo $rw->id_agree.'?'.param_get() ?>" class="label label-info">Upload Hasil</a>
							<a href="agreement/minta_perbaiki/<?php echo $rw->id_agree.'?'.param_get() ?>" class="label label-default">Minta Upload Ulang</a>
						<?php endif ?>
					</td>
				</tr>
				<?php $no++; endforeach ?>
			</tbody>
		</table>
		</div>
	</div>
</div>