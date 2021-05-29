
        <form action="<?php echo $action.'?'.param_get(); ?>" method="post">
	    <div class="form-group">
            <label for="lokasi">Lokasi <?php echo form_error('lokasi') ?></label>
            <textarea class="form-control" rows="3" name="lokasi" id="lokasi" placeholder="Lokasi"><?php echo $lokasi; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="date">Tanggal <?php echo form_error('tanggal') ?></label>
            <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" />
        </div>
	    <input type="hidden" name="id_jadwal" value="<?php echo $id_jadwal; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('jadwal_satpam').'?'.param_get() ?>" class="btn btn-default">Cancel</a>
	</form>
   