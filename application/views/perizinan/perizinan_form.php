
        <form action="<?php echo $action.'?'.param_get(); ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Unit Kerja <?php echo form_error('unit_kerja') ?></label>
            <input type="text" class="form-control" name="unit_kerja" id="unit_kerja" placeholder="Unit Kerja" value="<?php echo $unit_kerja; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jenis <?php echo form_error('jenis') ?></label>
            <input type="text" class="form-control" name="jenis" id="jenis" placeholder="Jenis" value="<?php echo $jenis; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nomor <?php echo form_error('nomor') ?></label>
            <input type="text" class="form-control" name="nomor" id="nomor" placeholder="Nomor" value="<?php echo $nomor; ?>" />
        </div>
	    <div class="form-group">
            <label for="dasar_izin">Dasar Izin <?php echo form_error('dasar_izin') ?></label>
            <textarea class="form-control" rows="3" name="dasar_izin" id="dasar_izin" placeholder="Dasar Izin"><?php echo $dasar_izin; ?></textarea>
        </div>

        <div class="form-group">
            <label>Pilihan Batas waktu</label>
            <select name="pilihan" id="pilihan" class="form-control" required="">
                <option value="<?php echo $pilihan ?>"><?php echo $pilihan ?></option>
                <option value="tanggal">tanggal</option>
                <option value="khusus">khusus</option>
            </select>
        </div>

        <div class="form-group" id="khusus">
            <label>Waktu khusus</label>
            <textarea name="khusus" class="form-control"><?php echo $khusus ?></textarea>
        </div>

	    <div class="form-group tanggal">
            <label for="date">Dari <?php echo form_error('dari') ?></label>
            <input type="date" class="form-control" name="dari" id="dari" placeholder="Dari" value="<?php echo $dari; ?>" />
        </div>
	    <div class="form-group tanggal">
            <label for="date">Sampai <?php echo form_error('sampai') ?></label>
            <input type="date" class="form-control" name="sampai" id="sampai" placeholder="Sampai" value="<?php echo $sampai; ?>" />
        </div>
	    <input type="hidden" name="id_perizinan" value="<?php echo $id_perizinan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('perizinan') ?>" class="btn btn-default">Cancel</a>
	</form>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $("#khusus").hide();
            $(".tanggal").hide();

            $("#pilihan").change(function(event) {
                var pilihan = $(this).val();
                if (pilihan == 'tanggal') {
                    $(".tanggal").show();
                    $("#khusus").hide();
                } else {
                    $("#khusus").show();
                    $(".tanggal").hide();
                }
            });
        });
    </script>
   