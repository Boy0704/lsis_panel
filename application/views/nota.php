<!DOCTYPE html>
<html>
<head>
	<title></title>
	<base href="<?php echo base_url() ?>">
	 <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body onload="print()">

<center>
	<h3>Nota Transaksi</h3>
</center>

<table class="table">
        <tr><td>Kode Transaksi</td><td><?php echo $kode_transaksi; ?></td></tr>
        <tr><td>Tanggal</td><td><?php echo $tanggal; ?></td></tr>
        <tr><td>Pelanggan</td><td><?php echo $pelanggan; ?></td></tr>
        <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
        <tr><td>Nama Paket</td><td><?php echo $nama_paket; ?></td></tr>
        <tr><td>Harga</td><td><?php echo $harga; ?></td></tr>
        <tr><td>Dp</td><td><?php echo $dp; ?></td></tr>
        <tr><td>Pilihan Pembayaran</td><td><?php echo $pilihan_pembayaran; ?></td></tr>
        <tr><td>Angsuran Ke</td><td><?php echo $angsuran_ke; ?></td></tr>
        <tr><td>Total</td><td><?php echo $total; ?></td></tr>
        <tr><td>Diskon</td><td><?php echo $diskon; ?></td></tr>
        <tr><td>Total Bayar</td><td><?php echo $total_bayar; ?></td></tr>
        <tr><td>Uang Kembali</td><td><?php echo $uang_kembali; ?></td></tr>
    </table>


</body>