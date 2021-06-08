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

            // $id_jadwal = get_data('jadwal_satpam','tanggal',date('Y-m-d'),'id_jadwal');
            $this->db->select('jadwal_satpam.id_jadwal,jadwal_satpam_detail.*');
            $this->db->from('jadwal_satpam');
            $this->db->join('jadwal_satpam_detail', 'jadwal_satpam.id_jadwal = jadwal_satpam_detail.id_jadwal', 'inner');
            $this->db->where('jadwal_satpam.tanggal', date('Y-m-d'));
            foreach ($this->db->get()->result() as $jadwal_satpam_detail)
            {
                // log_r($this->db->last_query());
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
                    
                <?php endif ?>

                <?php if ($this->input->get('mobile') == '1' && $this->input->get('id_level') != '14'): ?>
                    <a href="satpam/cek_posisi/<?php echo $jadwal_satpam_detail->id_user ?>" class="label label-info">Cek Posisi</a>
                    <a href="satpam/history/<?php echo $jadwal_satpam_detail->id_user.'?mobile=1' ?>" class="label label-warning">History</a>
                    <a href="satpam/download/<?php echo $jadwal_satpam_detail->id_user.'?mobile=1' ?>" class="label label-success">Download History</a>
                    
                <?php endif ?>

                <?php if ( $this->input->get('mobile') == '1' && $jadwal_satpam_detail->id_user == $this->input->get('id_user')): ?>
                    <a href="satpam/cek_posisi/<?php echo $jadwal_satpam_detail->id_user ?>" class="label label-info">Cek Posisi</a>
                    <a href="satpam/history/<?php echo $jadwal_satpam_detail->id_user.'?mobile=1' ?>" class="label label-warning">History</a>
                    <a href="satpam/download/<?php echo $jadwal_satpam_detail->id_user.'?mobile=1' ?>" class="label label-success">Download History</a>

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