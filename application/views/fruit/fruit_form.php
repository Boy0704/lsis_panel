
        <form action="<?php echo $action.'?'.param_get(); ?>" method="post">
	    <div class="form-group">
            <label for="int">Nama Sopir <?php echo form_error('id_user') ?></label>
            <!-- <input type="text" class="form-control" name="id_user" id="id_user" placeholder="Id User" value="<?php echo $id_user; ?>" /> -->
            <select name="id_user" class="form-control">
                <option value="<?php echo $id_user ?>"><?php echo get_data('users','id_user',$id_user,'nama') ?></option>
                <?php foreach ($this->db->get_where('users', array('id_level'=>'9'))->result() as $rw): ?>
                    <option value="<?php echo $rw->id_user ?>"><?php echo $rw->nama ?></option>i
                <?php endforeach ?>
            </select>
        </div>
	    <div class="form-group">
            <label for="varchar">No Plat <?php echo form_error('no_plat') ?></label>
            <input type="text" class="form-control" name="no_plat" id="no_plat" placeholder="No Plat" value="<?php echo $no_plat; ?>" />
        </div>
	    <div class="form-group">
            <label for="afdeling">Afdeling <?php echo form_error('afdeling') ?></label>
            <textarea class="form-control" rows="3" name="afdeling" id="afdeling" placeholder="Afdeling"><?php echo $afdeling; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="datetime">Tgl Angkut <?php echo form_error('tgl_angkut') ?></label>
            <input type="datetime-local" class="form-control" name="tgl_angkut" id="tgl_angkut" placeholder="Tgl Angkut" value="<?php echo $tgl_angkut; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Tgl Bongkar <?php echo form_error('tgl_bongkar') ?></label>
            <input type="datetime-local" class="form-control" name="tgl_bongkar" id="tgl_bongkar" placeholder="Tgl Bongkar" value="<?php echo $tgl_bongkar; ?>" />
        </div>
	    <input type="hidden" name="id_fruit" value="<?php echo $id_fruit; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('fruit').'?'.param_get() ?>" class="btn btn-default">Cancel</a>
	</form>
   