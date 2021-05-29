<div class="row">
	<div class="col-md-12">
		<form  action="<?php echo base_url() ?>agreement/aksi_upload_hasil?<?php echo param_get() ?>" method="POST" enctype="multipart/form-data">
		<div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">Upload Hasil</h3>
			</div>
			  <div class="box-body">
			    <div class="form-group">
			      <label>Silahkan Upload Hasil Agrement disini</label>
			      <input type="file" name="hasil" id="hasil" required="">
			      <input type="hidden" name="id_agree" value="<?php echo $this->uri->segment(3) ?>">

			      <p class="help-block">Maks File 5 Mb.</p>
			    </div>
			    
			  </div>
			  <div class="box-footer">
	            <button type="submit" class="btn btn-primary">Submit</button>
	        </div>
		</div>
		</form>
	</div>
</div>