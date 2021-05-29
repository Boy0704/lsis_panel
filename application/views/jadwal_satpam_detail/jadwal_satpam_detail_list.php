
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('jadwal_satpam_detail/create').'?'.param_get(),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered" style="margin-bottom: 10px" id="example1">
            <thead>
            <tr>
                <th>No</th>
		<th>Nama Satpam</th>
		<th>Shift</th>
        <th>Area</th>
        <th>Date at</th>
		<th>Oleh</th>
		<th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $start = 1;
            $this->db->where('id_jadwal', $this->input->get('id_jadwal'));
            foreach ($this->db->get('jadwal_satpam_detail')->result() as $jadwal_satpam_detail)
            {
                ?>
                <tr>
			<td width="80px"><?php echo $start ?></td>
			<td><?php echo get_data('users','id_user',$jadwal_satpam_detail->id_user,'nama') ?></td>
			<td><?php echo $jadwal_satpam_detail->shift ?></td>
            <td><?php echo $jadwal_satpam_detail->area ?></td>
            <td><?php echo $jadwal_satpam_detail->created_at ?></td>
			<td><?php echo get_data('users','id_user',$jadwal_satpam_detail->user_at,'nama') ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('jadwal_satpam_detail/update/'.$jadwal_satpam_detail->id_jadwal_detail).'?'.param_get(),'<span class="label label-info">Ubah</span>'); 
				echo ' | '; 
				echo anchor(site_url('jadwal_satpam_detail/delete/'.$jadwal_satpam_detail->id_jadwal_detail).'?'.param_get(),'<span class="label label-danger">Hapus</span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
                $start++;
            }
            ?>
            </tbody>
        </table>
        </div>
        
    