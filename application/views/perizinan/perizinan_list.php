
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php if (isset($_GET['id_level'])): ?>
                    <?php if ($_GET['id_level'] == '5' || $_GET['id_level'] == '6' || $_GET['id_level'] == '8' || $_GET['id_level'] == '9' ): ?>
                        <?php echo anchor(site_url('perizinan/create').'?'.param_get(),'Tambah', 'class="btn btn-primary"'); ?>
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
                <form action="<?php echo site_url('perizinan/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('perizinan'); ?>" class="btn btn-default">Reset</a>
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
		<th>Unit Kerja</th>
		<th>Jenis</th>
		<th>Nomor</th>
		<th>Dasar Izin</th>
		<th>Dari</th>
		<th>Sampai</th>
		<th>Action</th>
            </tr><?php
            $warna = "";
            foreach ($perizinan_data as $perizinan)
            {
                if (strtotime($perizinan->sampai) > strtotime('Y-m-d')) {
                    $warna = 'class="alert alert-success"';

                    if ($perizinan->jenis == 'HGU' || $perizinan->jenis == 'HGB') {
                        $tanggal = "$perizinan->sampai 00:59:59";
                        $tanggal = new DateTime($tanggal); 

                        $sekarang = new DateTime();

                        $perbedaan = $tanggal->diff($sekarang);
                        if ($perbedaan->y <= 2) {
                            $warna = 'style="background:yellow"';
                        }  
                    } else {
                        
                        $tanggal = "$perizinan->sampai 00:59:59";
                        $tanggal = new DateTime($tanggal); 

                        $sekarang = new DateTime();

                        $perbedaan = $tanggal->diff($sekarang);
                        if ($perbedaan->y == 0) {
                            if ($perbedaan->m <= 6) {
                                $warna = 'style="background:yellow"';
                            } 
                        }

                    }
                }

                if (strtotime($perizinan->sampai) <= strtotime(date('Y-m-d'))) {
                    $warna = 'class="alert alert-danger"';
                }

                

                ?>
                <tr <?php echo $warna ?>>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $perizinan->unit_kerja ?></td>
			<td><?php echo $perizinan->jenis ?></td>
			<td><?php echo $perizinan->nomor ?></td>
			<td><?php echo $perizinan->dasar_izin ?></td>
			<td><?php echo $perizinan->dari ?></td>
			<td><?php echo $perizinan->sampai ?></td>
			<td style="text-align:center" width="200px">
                <?php if (isset($_GET['id_level'])): ?>
                    <?php if ($_GET['id_level'] == '5' || $_GET['id_level'] == '6' || $_GET['id_level'] == '8' || $_GET['id_level'] == '9' ): ?>
            				<?php 
            				echo anchor(site_url('perizinan/update/'.$perizinan->id_perizinan).'?'.param_get(),'<span class="label label-info">Ubah</span>'); 
            				echo ' | '; 
            				echo anchor(site_url('perizinan/delete/'.$perizinan->id_perizinan).'?'.param_get(),'<span class="label label-danger">Hapus</span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
            				?>
                    <?php endif ?>
                <?php endif ?>
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
		<?php echo anchor(site_url('perizinan/excel'), 'Download Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    