<head>
	<style type="text/css">
	table tr th,table tr td{
		border-bottom: 1px solid black;
		padding-left: 20px;
		padding-right: 100px;
	}
</style>
</head>
<center><h1>TOGAMEDIA</h1></center>
<br>
<table>
	<?php 
	$total;
	foreach ($detail_transaksi as $b) {
		$total = $b->total;
		$bayar = $b->bayar;
		$kembali = $bayar-$total;?>
		<tr>
			<td style="border:none;padding: 0">Kode Transaksi</td>
			<td style="border:none;padding: 0"> : <?= $b->kode_transaksi?></td>
		</tr>
		<tr>
			<td style="border:none;padding: 0">Tanggal </td>
			<td style="border:none;padding: 0"> : <?= $b->tgl_beli?></td>
		</tr>
		<tr>
			<td style="border:none;padding: 0">Nama Kasir </td>
			<td style="border:none;padding: 0"> : <?= $b->nama_user?></td>
		</tr>
		<tr>
			<td style="border:none;padding: 0">Nama Pembeli </td>
			<td style="border:none;padding: 0"> : <?= $b->nama_pembeli?></td>
		</tr>
		
		<?php break;}?>
	</table>
	<br>
	<table cellspacing="0">
		<tr>
			<th style="padding-left: 0px;padding-right: 5px;">No.</th><th>Kode Buku</th><th>Judul</th><th>Harga</th>
		</tr>
		<?php 
		$x=1;
		foreach($detail_transaksi as $b){?>
		<tr>
			<td style="padding-left: 0px;padding-right: 5px;"><?= $x;?></td><td><?= $b->kode_buku?></td><td><?= $b->judul ?></td><td>
				Harga Satuan <?php if($b->diskon_detail>0){?> (Diskon <?= $b->diskon_detail?>%)<?php }?> : 
				<?= $b->harga-($b->harga*$b->diskon_detail/100)?>
			<br>
			<br>Harga Total : <?= $b->jumlah?> x <?= $b->harga-($b->harga*$b->diskon_detail/100)?> = <?= $b->jumlah*($b->harga-($b->harga*$b->diskon_detail/100))?></td>
		</tr>
		<?php $x++;}?>
		<tr>
			<td colspan="4" align="right" style="border:none;">Total : <?= $total;?><br>Bayar : <?= $bayar;?><br>Kembali : <?= $kembali;?></td>
		</tr>
	</table>