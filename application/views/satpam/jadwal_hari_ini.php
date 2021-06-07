<div class="table-responsive">
        <table class="table table-bordered" style="margin-bottom: 10px" id="example1">
            <thead>
            <tr>
                <th>No</th>
		<th>Nama Satpam</th>
		<th>Shift</th>
		<th>Area</th>
		<th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $start = 1;

            $id_jadwal = get_data('jadwal_satpam','tanggal',date('Y-m-d'),'id_jadwal');

            $this->db->where('id_jadwal', $id_jadwal);
            foreach ($this->db->get('jadwal_satpam_detail')->result() as $jadwal_satpam_detail)
            {
                ?>
                <tr>
			<td width="80px"><?php echo $start ?></td>
			<td><?php echo get_data('users','id_user',$jadwal_satpam_detail->id_user,'nama') ?></td>
			<td><?php echo $jadwal_satpam_detail->shift ?></td>
			<td><?php echo $jadwal_satpam_detail->area ?></td>
			<td style="text-align:center" width="200px">

                <?php if ($this->session->userdata('level') == 'admin'): ?>
                    <a href="satpam/cek_posisi/<?php echo $jadwal_satpam_detail->id_user ?>" class="label label-info">Cek Posisi</a>
                    <a href="satpam/history/<?php echo $jadwal_satpam_detail->id_user.'?mobile=1' ?>" class="label label-warning">History</a>
                    <a href="satpam/download/<?php echo $jadwal_satpam_detail->id_user.'?mobile=1' ?>" class="label label-success">Download History</a>
                <?php else: ?>
                    <?php if ($jadwal_satpam_detail->id_user == $this->input->get('id_user')): ?>
                        <a href="satpam/cek_posisi/<?php echo $jadwal_satpam_detail->id_user ?>" class="label label-info">Cek Posisi</a>
                        <a href="satpam/history/<?php echo $jadwal_satpam_detail->id_user.'?mobile=1' ?>" class="label label-warning">History</a>
                        <a href="satpam/download/<?php echo $jadwal_satpam_detail->id_user.'?mobile=1' ?>" class="label label-success">Download History</a>

                    <?php else: ?>

                    <?php endif ?>
                <?php endif ?>

				
			</td>
		</tr>
                <?php
                $start++;
            }
            ?>
            </tbody>
        </table>
        </div>