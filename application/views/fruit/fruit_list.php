
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('fruit/create').'?'.param_get(),'Create', 'class="btn btn-primary"'); ?>
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
		<th>Action</th>
            </tr><?php
            foreach ($fruit_data as $fruit)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo get_data('users','id_user',$fruit->id_user,'nama') ?></td>
			<td><?php echo $fruit->no_plat ?></td>
			<td><?php echo $fruit->afdeling ?></td>
			<td><?php echo $fruit->tgl_angkut ?></td>
			<td><?php echo $fruit->tgl_bongkar ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('fruit/update/'.$fruit->id_fruit).'?'.param_get(),'<span class="label label-info">Ubah</span>'); 
                if (isset($this->input->get('id_level'))) {
                    if ($this->input->get('id_level') != '8' OR $this->input->get('id_level') != '9') {
                        echo ' | '; 
                        echo anchor(site_url('fruit/delete/'.$fruit->id_fruit).'?'.param_get(),'<span class="label label-danger">Hapus</span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    