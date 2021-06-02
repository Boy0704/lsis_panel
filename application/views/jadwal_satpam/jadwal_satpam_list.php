
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('jadwal_satpam/create').'?'.param_get(),'Create', 'class="btn btn-primary"'); ?>
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
		<th>Lokasi</th>
		<th>Tanggal</th>
		<th>Action</th>
            </tr>
            </thead><?php
            $start = 1;
            $this->db->order_by('id_jadwal', 'desc');
            $jadwal_satpam_data = $this->db->get('jadwal_satpam')->result();
            foreach ($jadwal_satpam_data as $jadwal_satpam)
            {
                ?>
                <tr>
			<td width="80px"><?php echo $start ?></td>
			<td><?php echo $jadwal_satpam->lokasi ?></td>
			<td><?php echo $jadwal_satpam->tanggal ?></td>
			<td style="text-align:center" width="200px">
                <a href="jadwal_satpam_detail/index?id_jadwal=<?php echo $jadwal_satpam->id_jadwal.'&'.param_get() ?>" class="label label-default">Detail</a>
				<?php 
				echo anchor(site_url('jadwal_satpam/update/'.$jadwal_satpam->id_jadwal).'?'.param_get(),'<span class="label label-info">Ubah</span>'); 
				echo ' | '; 
				echo anchor(site_url('jadwal_satpam/delete/'.$jadwal_satpam->id_jadwal).'?'.param_get(),'<span class="label label-danger">Hapus</span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
                $start++;
            }
            ?>
        </table>
        </div>
        
    