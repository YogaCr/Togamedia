<table class="table">
	<tr>
		<th>No.</th><th>Kode Buku</th><th>Gambar</th><th>Judul</th><th>Kategori</th><th>Harga</th><th>Aksi</th>
	</tr>
	<tr>
		<?php if($this->cart->total_items()>0){
			$x=1;
			foreach($this->cart->contents() as $b){?>
			<tr>
				<td><?= $x;?></td><td><?= $b['id']?></td><td><img src="<?= base_url()?>assets/img/buku/<?= $b['options']['gambarbuku']?>" style="width:50%;"></td><td><?= $b['name'] ?></td><td><?= $b['options']['kategori']?></td><td>Harga Satuan : <br><?= $b['price']?><br><br>Harga Total : <br><?= $b['qty']?> x <?= $b['price']?> = <?= $b['qty']*$b['price']?></td><td>
					Update Banyak Beli : <br>
					<form method="POST" action="<?= base_url()?>index.php/Transaksi/UpdateTotalBeli/<?= $b['rowid']?>">
						<input type="number" name="totalbeli" required="" style="float:left;width:40%;" class="form-control"> 
						 <button type="submit" style="margin-left: 5%;float: left;" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart" style="color:white;"></span></button>
					</form>
				</td>
			</tr>
		<?php $x++;}?>
		<tr><td colspan="7" align="right"><h4>Total : <?= $this->cart->total()?></h4></td></tr>
		<?php } else{?>
			<td colspan="7"><center>Tidak ada data</center></td>
		<?php }?>
	</tr>
</table>