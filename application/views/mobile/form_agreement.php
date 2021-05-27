
<div class="row">
	<div class="col-md-12">
		<form action="app/simpan_form_agreement?<?php echo param_get() ?>" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Pihak Pertama</label>
				<input type="text" name="nama_pihak_1" class="form-control">
			</div>
			<div class="form-group">
				<label>Upload KTP/Anggaran Dasar</label>
				<input type="file" name="upload1" class="form-control">
			</div>
			<div class="form-group">
				<label>Nama Pihak Kedua</label>
				<input type="text" name="nama_pihak_2" class="form-control">
			</div>
			<div class="form-group">
				<label>Upload KTP/Anggaran Dasar</label>
				<input type="file" name="upload2" class="form-control">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Simpan</button>
			</div>
		</form>
	</div>
</div>