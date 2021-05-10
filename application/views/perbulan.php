<!DOCTYPE html>
<html>
<head>
	<title></title>
	<base href="<?php echo base_url() ?>">
	 <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body onload="print()">

<center>
	<h3>Cetak Perbulan</h3>
</center>

<table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        <th>Kode Transaksi</th>
        <th>Tanggal</th>
        <th>Pelanggan</th>
        <th>Alamat</th>
        <th>Nama Paket</th>
        <th>Harga</th>
        <th>Dp</th>
        <th>Pilihan Pembayaran</th>
        <th>Angsuran Ke</th>
        <th>Total</th>
        <th>Diskon</th>
        <th>Total Bayar</th>
        <th>Uang Kembali</th>
            </tr><?php
            $start = 0;
            $pembayaran_data = $this->db->query($query)->result();
            foreach ($pembayaran_data as $pembayaran)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $pembayaran->kode_transaksi ?></td>
            <td><?php echo $pembayaran->tanggal ?></td>
            <td><?php echo $pembayaran->pelanggan ?></td>
            <td><?php echo $pembayaran->alamat ?></td>
            <td><?php echo $pembayaran->nama_paket ?></td>
            <td><?php echo $pembayaran->harga ?></td>
            <td><?php echo $pembayaran->dp ?></td>
            <td><?php echo $pembayaran->pilihan_pembayaran ?></td>
            <td><?php echo $pembayaran->angsuran_ke ?></td>
            <td><?php echo $pembayaran->total ?></td>
            <td><?php echo $pembayaran->diskon ?></td>
            <td>
                <?php echo $pembayaran->dibayar ?>        
            </td>
            <td><?php echo $pembayaran->uang_kembali ?></td>
            
        </tr>
                <?php
            }
            ?>
        </table>


</body>