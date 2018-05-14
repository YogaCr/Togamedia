<table class="table">
	<tr>
		<th>No.</th><th>Kode Transaksi</th><th>Nama Kasir</th><th>Nama Pembeli</th><th>Tanggal Beli</th><th>Total</th><th>Nota</th>
	</tr>
	<?php 
	if($transaksi->num_rows()>0){
		$x=1;
	foreach ($transaksi->result() as $t) {?>
	<tr>
		<td><?= $x;?></td><td><?= $t->kode_transaksi?></td><td><?= $t->nama_user?></td><td><?= $t->nama_pembeli?></td><td><?= $t->tgl_beli?></td><td><?= $t->total?></td><td><a href="<?= base_url()?>index.php/Transaksi/CetakNota/<?= $t->kode_transaksi?>">Nota</a></td>
	</tr>
	<?php $x++;}}
	else{?>
		<tr>
			<td colspan="7">
				<center>Tidak ada data</center>
			</td>
		</tr>
	<?php }?>
</table>