<?php if ($this->session->flashdata('pesan')!=null) {?>
	<div class="alert alert-danger"><?= $this->session->flashdata('pesan');?></div>
<?php }?>
<table class="table">
	<tr>
		<th>No.</th><th>Kode Buku</th><th>Gambar</th><th>Judul</th><th>Kategori</th><th>Penulis</th><th>Penerbit</th><th>Stok</th><th>Harga</th><th>Aksi</th>
	</tr>
	<tr>
		<?php if($buku->num_rows()>0){
			$x=1;
			foreach($buku->result() as $b){?>
			<tr>
				<td><?= $x;?></td><td><?= $b->kode_buku?></td><td><img src="<?= base_url()?>assets/img/buku/<?= $b->foto_cover?>" style="width:10%;"></td><td><?= $b->judul ?></td><td><?= $b->nama_kategori?></td><td><?= $b->penulis?></td><td><?= $b->penerbit?></td><td><?= $b->stok?></td><td><?php if ($b->diskon>0) {?><p style="text-decoration: line-through;"><?= $b->harga?></p>Diskon <?=$b->diskon?>% : <?= $b->harga-($b->harga*$b->diskon/100)?>
				<?php }else{ ?><?= $b->harga?><?php }?></td><td><?php if ($this->session->userdata('level')=='kasir') {?>
					Banyak Beli : <br>
					<form method="POST" action="<?= base_url()?>index.php/Transaksi/TambahTransaksi/<?= $b->kode_buku?>">
						<input type="number" name="totalbeli" required="" style="float:left;width:50%;" class="form-control"> 
						 <button type="submit" style="margin-left: 5%;float: left;" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart" style="color:white;"></span></button>
					</form></td></tr>
				<?php }else {?> 
					<button class="btn btn-primary" onclick="tampilEdit('<?= $b->kode_buku?>')"><span class="glyphicon glyphicon-pencil"></span></button>
					<a href="<?= base_url()?>index.php/Admin/HapusBuku/<?=$b->kode_buku?>"><button class="btn btn-danger" onclick="return confirm('Yakin mau hapus?')"><span class="glyphicon glyphicon-remove"></span></button></a></td></tr>
					<tr>
			<td style="border: none;" colspan="10">
			<center><form style="visibility: hidden;position: absolute;width: 50%; " action="<?= base_url()?>index.php/Admin/ProsesEditBuku/<?=$b->kode_buku?>" method="POST" id="formedit<?= $b->kode_buku?>" enctype="multipart/form-data">
				<h3>Edit Buku</h3>
				<div class="form-group">
									<input type="text" name="kode_buku" value="<?= $b->kode_buku?>" class="form-control" placeholder="Kode Buku" required="">
								</div>
			<div class="form-group">
									<input type="text" name="judul" value="<?= $b->judul?>" class="form-control" placeholder="Judul Buku" required="">
								</div>
								<div class="form-group">
									<input type="text" name="penulis" value="<?= $b->penulis?>" class="form-control" placeholder="Penulis" required="">
								</div>
								<div class="form-group">
									<input type="text" name="penerbit" value="<?= $b->penerbit?>" class="form-control" placeholder="Penerbit" required="">
								</div>
								<div class="form-group">
									<input type="number" name="tahunterbit" value="<?= $b->tahun?>" class="form-control" placeholder="Tahun" required="">
								</div>
								<div class="form-group">
									<input type="number" name="harga" value="<?= $b->harga?>" class="form-control" placeholder="Harga" required="">
								</div>
								<div class="form-group">
									<input type="number" name="stok" value="<?= $b->stok?>" class="form-control" placeholder="Stok" required="">
								</div>
								<div class="form-group">
									<input type="number" name="diskon" value="<?= $b->diskon?>" class="form-control" placeholder="Diskon" required="">
								</div>
								<div class="form-group">
									Kategori : <br>
									<select name="kategori" class="form-control">
										<?php foreach ($kategori->result() as $k) {?>
											<option value="<?= $k->kode_kategori?>" <?php if($k->kode_kategori==$b->kode_kategori){ echo "selected";}?>><?= $k->nama_kategori?></option>
										<?php }?>
									</select>
								</div>
								<div class="form-group">
									Gambar Buku : <br><input type="file" name="gambarbuku">
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
			
			</form>
		</center>
		</td>
		</tr>
				<?php }?>
			
		<?php $x++;}
		} else{?>
			<td colspan="10"><center>Tidak ada data</center></td>
		<?php }?>
	</tr>
</table>