<div class="row">
	<div class="col-md-12">
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label>Catatan data yang kurang</label>
				<p>
					<?php 
					echo get_data('agreement','id_agree',$id,'catatan_perbaikan');
					 ?>
				</p>
			</div>
			<div class="form-group">
				<label>Upload Data yang kurang</label>
				<input type="hidden" name="id_agree" value="<?php echo $id ?>">
				<input type='file' name='files[]' class="form-control" required="">
				<div id="tambah"></div>
				<p style="margin-top:10px;"><span id="add" class="btn btn-xs btn-success">Tambah Upload</span></p>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$("#add").click(function(event) {
			$("#tambah").append('<input type="file" name="files[]" class="form-control" required="">');
		});
	});
</script>