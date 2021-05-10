
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nomor Surat <?php echo form_error('nomor_surat') ?></label>
            <input type="text" class="form-control" name="nomor_surat" id="nomor_surat" placeholder="Nomor Surat" value="<?php echo $nomor_surat; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tanggal Surat <?php echo form_error('tanggal_surat') ?></label>
            <input type="text" class="form-control" name="tanggal_surat" id="tanggal_surat" placeholder="Tanggal Surat" value="<?php echo $tanggal_surat; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Pelapor <?php echo form_error('nama_pelapor') ?></label>
            <input type="text" class="form-control" name="nama_pelapor" id="nama_pelapor" placeholder="Nama Pelapor" value="<?php echo $nama_pelapor; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tanggal Kejadian <?php echo form_error('tanggal_kejadian') ?></label>
            <input type="text" class="form-control" name="tanggal_kejadian" id="tanggal_kejadian" placeholder="Tanggal Kejadian" value="<?php echo $tanggal_kejadian; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Jlh <?php echo form_error('jlh') ?></label>
            <input type="text" class="form-control" name="jlh" id="jlh" placeholder="Jlh" value="<?php echo $jlh; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Kg <?php echo form_error('kg') ?></label>
            <input type="text" class="form-control" name="kg" id="kg" placeholder="Kg" value="<?php echo $kg; ?>" />
        </div>
	    <div class="form-group">
            <label for="lokasi">Lokasi <?php echo form_error('lokasi') ?></label>
            <textarea class="form-control" rows="3" name="lokasi" id="lokasi" placeholder="Lokasi"><?php echo $lokasi; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Tersangka <?php echo form_error('nama_tersangka') ?></label>
            <input type="text" class="form-control" name="nama_tersangka" id="nama_tersangka" placeholder="Nama Tersangka" value="<?php echo $nama_tersangka; ?>" />
        </div>
	    <div class="form-group">
            <label for="tindak_lanjut">Tindak Lanjut <?php echo form_error('tindak_lanjut') ?></label>
            <textarea class="form-control" rows="3" name="tindak_lanjut" id="tindak_lanjut" placeholder="Tindak Lanjut"><?php echo $tindak_lanjut; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="keterangan">Keterangan <?php echo form_error('keterangan') ?></label>
            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
        </div>
	    <input type="hidden" name="id_kasus" value="<?php echo $id_kasus; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('kasus') ?>" class="btn btn-default">Cancel</a>
	</form>
   