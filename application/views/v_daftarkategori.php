<table class="table">
	<tr>
		<th>No.</th><th>Nama Kategori</th><th>Aksi</th>
	</tr>
	<tr>
		<?php if($kategori->num_rows()>0){
			$x=1;
			foreach($kategori->result() as $b){?>
			<tr>
				<td><?= $x;?></td><td><?= $b->nama_kategori?></td><td><button class="btn btn-primary" onclick="tampilEdit('<?= $b->kode_kategori?>')"><span class="glyphicon glyphicon-pencil"></span></button>
					<a href="<?= base_url()?>index.php/Admin/HapusKategori/<?=$b->kode_kategori?>"><button class="btn btn-danger" onclick="return confirm('Yakin mau hapus?')"><span class="glyphicon glyphicon-remove"></span></button></a></td>
			</tr>
			<tr>
				<td style="border: none;" colspan="3">
			<center>
				<form style="visibility: hidden;position: absolute;width: 50%; " action="<?= base_url()?>index.php/Admin/ProsesEditKategori/<?=$b->kode_kategori?>" method="POST" id="formedit<?= $b->kode_kategori?>" enctype="multipart/form-data">
					<h3>Edit Kategori</h3>
				<div class="form-group">
									<input type="text" name="name" value="<?= $b->nama_kategori?>" class="form-control" placeholder="Nama kategori" required="">
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
			
			</form>
		</center>
		</td>
			</tr>
		<?php $x++;}
		} else{?>
			<td colspan="3"><center>Tidak ada data</center></td>
		<?php }?>
	</tr>
</table>