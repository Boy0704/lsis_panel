
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php if (isset($_GET['id_level'])): ?>
                    <?php if ($_GET['id_level'] == '5' || $_GET['id_level'] == '6' || $_GET['id_level'] == '8' || $_GET['id_level'] == '9' ): ?>
                        <?php echo anchor(site_url('kasus/create').'?'.param_get(),'Tambah', 'class="btn btn-primary"'); ?>
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
                <form action="<?php echo site_url('kasus/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('kasus'); ?>" class="btn btn-default">Reset</a>
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
		<th>Nomor Surat</th>
		<th>Tanggal Surat</th>
		<th>Nama Pelapor</th>
		<th>Tanggal Kejadian</th>
		<th>Jlh</th>
		<th>Kg</th>
		<th>Lokasi</th>
		<th>Nama Tersangka</th>
		<th>Tindak Lanjut</th>
		<th>Keterangan</th>
		<th>Action</th>
            </tr><?php
            foreach ($kasus_data as $kasus)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $kasus->nomor_surat ?></td>
			<td><?php echo $kasus->tanggal_surat ?></td>
			<td><?php echo $kasus->nama_pelapor ?></td>
			<td><?php echo $kasus->tanggal_kejadian ?></td>
			<td><?php echo $kasus->jlh ?></td>
			<td><?php echo $kasus->kg ?></td>
			<td><?php echo $kasus->lokasi ?></td>
			<td><?php echo $kasus->nama_tersangka ?></td>
			<td><?php echo $kasus->tindak_lanjut ?></td>
			<td><?php echo $kasus->keterangan ?></td>
			<td style="text-align:center" width="200px">
                <?php if (isset($_GET['id_level'])): ?>
                    <?php if ($_GET['id_level'] == '5' || $_GET['id_level'] == '6' || $_GET['id_level'] == '8' || $_GET['id_level'] == '9' ): ?>
        				<?php 
        				echo anchor(site_url('kasus/update/'.$kasus->id_kasus).'?'.param_get(),'<span class="label label-info">Ubah</span>'); 
        				echo ' | '; 
        				echo anchor(site_url('kasus/delete/'.$kasus->id_kasus).'?'.param_get(),'<span class="label label-danger">Hapus</span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('kasus/excel'), 'Downlaod Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $("#tes").click(function(event) {
                    // WebAppInterface.vibrate(1000);
                    // WebAppInterface.snakBar("Hallo Boy");
                    // WebAppInterface.showToast("Hallo Boy");
                });
            });
        </script>
    