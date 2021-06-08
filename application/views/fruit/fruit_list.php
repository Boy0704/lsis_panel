
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php if (isset($_GET['id_level'])): ?>
                    <?php if ($_GET['id_level'] == '7' || $_GET['id_level'] == '14' || $_GET['id_level'] == '15' || $_GET['id_level'] == '5'): ?>
                        <?php echo anchor(site_url('fruit/create').'?'.param_get(),'Create', 'class="btn btn-primary"'); ?>
                    <?php endif ?>
                <?php endif ?>
                
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('fruit/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('fruit'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Supir</th>
		<th>No Plat</th>
		<th>Afdeling</th>
		<th>Tgl Angkut</th>
        <th>Tgl Bongkar</th>
        <th>Tujuan</th>
		<th>Status</th>
		<th>Action</th>
            </tr><?php
            $start = 1;
            if ($this->session->userdata('level')== 'admin') {
                // code...
            } else {
                if ($this->input->get('id_level') == '15') {
                    $this->db->where('id_user', $this->input->get('id_user'));
                }
            }
            $fruit_data = $this->db->get('fruit');
            foreach ($fruit_data->result() as $fruit)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo get_data('users','id_user',$fruit->id_user,'nama') ?></td>
			<td><?php echo $fruit->no_plat ?></td>
			<td><?php echo $fruit->afdeling ?></td>
			<td><?php echo $fruit->tgl_angkut ?></td>
            <td><?php echo $fruit->tgl_bongkar ?></td>
            <td><?php echo $fruit->tujuan ?></td>
			<td>
                <?php 
                if ($fruit->status == 'finish') {
                    echo '<span class="label label-success">Finish</span>';
                } else {
                    echo '<span class="label label-default">Delivery</span>';
                }
                 ?>         
            </td>
			<td style="text-align:center" width="200px">
                <a href="fruit/cek_posisi/<?php echo $fruit->id_user ?>" class="label label-info">Cek Posisi</a>
                <a href="fruit/history/<?php echo $fruit->id_user.'?mobile=1' ?>" class="label label-warning">History</a>
                <a href="fruit/download/<?php echo $fruit->id_user.'?mobile=1' ?>" class="label label-success">Download History</a>
				<?php 
				if (isset($_GET['id_level'])) {
                    if ($fruit->status != 'final' && ($_GET['id_level'] == '15' || $_GET['id_level'] == '5' )) {
                        echo anchor(site_url('fruit/update/'.$fruit->id_fruit).'?'.param_get(),'<span class="label label-info">Ubah</span>'); 
                    }
                }
                if (isset($_GET['id_level'])) {
                    if ($fruit->status != 'finish') {
                        if ( $this->input->get('id_level') != '7' OR $this->input->get('id_level') != '14' ) {
                        echo ' | '; 
                        echo anchor(site_url('fruit/delete/'.$fruit->id_fruit).'?'.param_get(),'<span class="label label-danger">Hapus</span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                    }
                    }
                    
                }
				 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    