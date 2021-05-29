
        <form action="<?php echo $action.'?'.param_get(); ?>" method="post">
	    <div class="form-group">
            <label for="int">Nama Satpam <?php echo form_error('id_user') ?></label>
            <input type="hidden" class="form-control" name="id_jadwal" id="id_jadwal" placeholder="Id Jadwal" value="<?php echo $this->input->get('id_jadwal'); ?>" />
            <select name="id_user" class="form-control">
                <option value="<?php echo $id_user ?>"><?php echo get_data('users','id_user',$id_user,'nama') ?></option>
                <?php foreach ($this->db->get_where('users', array('id_level'=>'8'))->result() as $rw): ?>
                    <option value="<?php echo $rw->id_user ?>"><?php echo $rw->nama ?></option>i
                <?php endforeach ?>
            </select>
        </div>
	    <div class="form-group">
            <label for="varchar">Shift <?php echo form_error('shift') ?></label>
            <input type="text" class="form-control" name="shift" id="shift" placeholder="Shift" value="<?php echo $shift; ?>" />
        </div>
	    <div class="form-group">
            <label for="area">Area <?php echo form_error('area') ?></label>
            <textarea class="form-control" rows="3" name="area" id="area" placeholder="Area"><?php echo $area; ?></textarea>
        </div>
	    <input type="hidden" name="id_jadwal_detail" value="<?php echo $id_jadwal_detail; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('jadwal_satpam_detail').'?'.param_get() ?>" class="btn btn-default">Cancel</a>
	</form>
   