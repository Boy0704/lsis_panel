<?php 
$data = $query->row();
 ?>
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">Pihak Pertama</h3>
			</div>
			  <div class="box-body">
			    <div class="form-group">
			      <label>Nama Pihak Pertama</label>
			      <input type="text" name="nama_p1" class="form-control" id="nama_p1" placeholder="Masukkan Nama" value="<?php echo $data->nama_p1 ?>" readonly>
			    </div>
			    <div class="form-group">
			      <label for="exampleInputFile">Upload KTP/Aggaran Dasar</label>
			      <p class="help-block">
			      	<a href="files/agreement/<?php echo $data->ktp_p1 ?>">Lihat</a>
			     	</p>
			    </div>
			  </div>
		</div>

		<div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">Pihak Kedua</h3>
			</div>
			  <div class="box-body">
			    <div class="form-group">
			      <label>Nama Pihak Kedua</label>
			      <input type="text" name="nama_p2" class="form-control" id="nama_p2" placeholder="Masukkan Nama" value="<?php echo $data->nama_p2 ?>" readonly>
			    </div>
			    <div class="form-group">
			      <label for="exampleInputFile">Upload KTP/Aggaran Dasar</label>

			      <p class="help-block">
			      	<a href="files/agreement/<?php echo $data->ktp_p2 ?>">Lihat</a>
			      </p>
			    </div>
			  </div>
		</div>


		

		<div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">Surat Kuasa Pihak Pertama (Jika dikuasakan)</h3>
			</div>
			<div class="box-body">
				<div class="form-group">
				  <label>Nomor Surat Kuasa</label>
				  <input type="text" name="no_surat1" class="form-control" id="no_surat1" placeholder="Masukkan No Surat" value="<?php echo $data->no_surat_kuasa_p1 ?>" readonly>
				</div>
				<div class="form-group">
				  <label for="exampleInputFile">Upload Surat Kuasa</label>
				  <p class="help-block">
				  	<a href="files/agreement/<?php echo $data->surat_kuasa_p1 ?>">Lihat</a>
				  </p>
				</div>
			</div>
		</div>

		<div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">Surat Kuasa Pihak Kedua (Jika dikuasakan)</h3>
			</div>
			<div class="box-body">
				<div class="form-group">
				  <label>Nomor Surat Kuasa</label>
				  <input type="text" name="no_surat2" class="form-control" id="no_surat2" placeholder="Masukkan No Surat" value="<?php echo $data->no_surat_kuasa_p2 ?>" readonly>
				</div>
				<div class="form-group">
				  <label for="exampleInputFile">Upload Surat Kuasa</label>
				  <p class="help-block">
				  	<a href="files/agreement/<?php echo $data->surat_kuasa_p2 ?>">Lihat</a>
				  </p>
				</div>
			</div>
		</div>


		

		<div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">Detail Perjanjian</h3>
			</div>
			<div class="box-body">
				<div class="form-group">
				  <label>Jenis Perjanjian</label>
				  <input type="text" name="jenis_perjanjian" class="form-control" id="jenis_perjanjian" placeholder="Jual Beli/Sewa/Pinjam Pakai/BGS/Perjanjian Perdamaian" value="<?php echo $data->jenis_perjanjian ?>" readonly>
				</div>

				<div class="form-group">
				  <label>Obyek Perjanjian</label>
				  <input type="text" name="objek_perjanjian" class="form-control" id="objek_perjanjian" placeholder="" value="<?php echo $data->objek_perjanjian ?>" readonly>
				</div>

				<div class="form-group">
				  <label>Jumlah Obyek Perjanjian</label>
				  <input type="text" name="jumlah_objek_perjanjian" class="form-control" id="jumlah_objek_perjanjian" placeholder="" value="<?php echo $data->jumlah_objek_perjanjian ?>" readonly>
				</div>

				<div class="form-group">
				  <label>Jangka waktu Perjanjian</label>
				  <input type="text" name="jangka_waktu_perjanjian" class="form-control" id="jangka_waktu_perjanjian" placeholder="" value="jangka_waktu_perjanjian" readonly="">
				</div>

				<div class="form-group">
				  <label>Nilai Perjanjian</label>
				  <div class="input-group">
	                <span class="input-group-addon">Rp.</span>
	                <input type="number" class="form-control" name="nilai_perjanjian" value="<?php echo $data->nilai_perjanjian ?>" readonly>
	              </div>
				</div>

				<div class="form-group">
				  <label>Cara Pembayaran</label>
				  <p><?php echo $data->cara_pembayaran ?></p>
				</div>

				<div class="form-group">
				  <label>Term Pembayaran dan Jumlahnya</label>
				  <p><?php echo $data->term_pembayaran ?></p>
				</div>
				
			</div>
		</div>

		<div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">Korespondensi Pihak Pertama</h3>
			</div>
			<div class="box-body">
				<div class="form-group">
				  <label>Alamat</label>
				  <textarea class="form-control" rows="3" name="alamat1" readonly=""><?php echo $data->alamat1 ?></textarea>
				</div>
				<div class="form-group">
				  <label>No Telp</label>
				  <input type="text" name="no_telp1" class="form-control" id="no_telp1" placeholder="Masukkan No Telp" value="<?php echo $data->no_telp1 ?>" readonly>
				</div>
				<div class="form-group">
				  <label>Email</label>
				  <input type="email" name="email1" class="form-control" id="email1" placeholder="Masukkan Email" value="<?php echo $data->email1 ?>" readonly>
				</div>
				<div class="form-group">
				  <label>Faks (Jika Ada)</label>
				  <input type="text" name="faks1" class="form-control" id="faks1" placeholder="Masukkan Faks" value="<?php echo $data->faks1 ?>" readonly>
				</div>
				
			</div>
		</div>

		<div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">Korespondensi Pihak Kedua</h3>
			</div>
			<div class="box-body">
				<div class="form-group">
				  <label>Alamat</label>
				  <textarea class="form-control" rows="3" name="alamat2" readonly=""><?php echo $data->alamat2 ?></textarea>
				</div>
				<div class="form-group">
				  <label>No Telp</label>
				  <input type="text" name="no_telp2" class="form-control" id="no_telp2" placeholder="Masukkan No Telp" value="<?php echo $data->alamat2 ?>" readonly>
				</div>
				<div class="form-group">
				  <label>Email</label>
				  <input type="email" name="email2" class="form-control" id="email2" placeholder="Masukkan Email" value="<?php echo $data->email2 ?>" readonly>
				</div>
				<div class="form-group">
				  <label>Faks (Jika Ada)</label>
				  <input type="text" name="faks2" class="form-control" id="faks2" placeholder="Masukkan Faks" value="<?php echo $data->faks2 ?>" readonly>
				</div>
				
			</div>
		</div>

		

		

		
		</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {

		var no = 0;
		$("#tambah_pihak_lain").click(function(event) {
			event.preventDefault();
			$("#v_pihak_lain").append('<div class="box box-primary"> <div class="box-header with-border"> <h3 class="box-title">Pihak Lainnya</h3> </div> <div class="box-body"> <div class="form-group"> <label>Nama Pihak Lainnya</label> <input type="text" name="nama_p['+no+']" class="form-control" id="nama_p[['+no+']]" placeholder="Masukkan Nama"> </div> <div class="form-group"> <label for="exampleInputFile">Upload KTP/Aggaran Dasar</label> <input type="file" name="ktp_p['+no+']" id="ktp_p['+no+']"><p class="help-block">Maks File 1 Mb.</p> </div> </div> </div>');
		});

		$("#tambah_surat_pihak_lain").click(function(event) {
			event.preventDefault();
			$("#v_surat_kuasa_pihak_lain").append('<div class="box box-primary"> <div class="box-header with-border"> <h3 class="box-title">Surat Kuasa Pihak Lainnya (Jika dikuasakan)</h3> </div> <div class="box-body"> <div class="form-group"> <label>Nomor Surat Kuasa</label> <input type="text" name="no_surat['+no+']" class="form-control" id="no_surat['+no+']" placeholder="Masukkan No Surat"> </div> <div class="form-group"> <label for="exampleInputFile">Upload Surat Kuasa</label> <input type="file" name="surat_kuasa['+no+']" id="surat_kuasa['+no+']"><p class="help-block">Maks File 1 Mb.</p> </div> </div> </div>');
		});

		$("#tambah_korespondensi_lain").click(function(event) {
			event.preventDefault();
			$("#v_korespondensi_pihak_lain").append('<div class="box box-primary"> <div class="box-header with-border"> <h3 class="box-title">Korespondensi Pihak Lainnya</h3> </div> <div class="box-body"> <div class="form-group"> <label>Alamat</label> <textarea class="form-control" rows="3" name="alamat['+no+']"></textarea> </div> <div class="form-group"> <label>No Telp</label> <input type="text" name="no_telp['+no+']" class="form-control" id="no_telp['+no+']" placeholder="Masukkan No Telp"> </div> <div class="form-group"> <label>Email</label> <input type="email" name="email['+no+']" class="form-control" id="email['+no+']" placeholder="Masukkan Email"> </div> <div class="form-group"> <label>Faks (Jika Ada)</label> <input type="text" name="faks['+no+']" class="form-control" id="faks['+no+']" placeholder="Masukkan Faks"> </div> </div> </div>');
		});

	});
</script>