<table class="table">
	<tr>
		<th>No.</th><th>Nama Kasir</th><th>Username</th><th>Password</th><th>Aksi</th>
	</tr>
	
		<?php if($user->num_rows()>0){
			$x=1;
			foreach($user->result() as $u){?>
			<tr>
				<td><?= $x;?></td><td><?= $u->nama_user?></td><td><?= $u->username?></td><td><?= $u->password?></td><td><button class="btn btn-primary" onclick="tampilEdit('<?= $u->kode_user?>')"><span class="glyphicon glyphicon-pencil" ></span></button><a href="<?= base_url()?>index.php/Admin/HapusKasir/<?= $u->kode_user?>"><button class="btn btn-danger" onclick="return confirm('Yakin Mau Hapus?')"><span class="glyphicon glyphicon-remove"></span></button></a></td>
			</tr>
			<tr>
			<td style="border: none;" colspan="5">
			<center><form style="visibility: hidden;position: absolute;width:50%; " action="<?= base_url()?>index.php/Admin/ProsesEditKasir/<?=$u->kode_user?>" method="POST" id="formedit<?= $u->kode_user?>">
				<h3>Edit Kasir</h3>
				<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Nama</label>
									<input type="text" name="name<?= $u->kode_user?>" value="<?= $u->nama_user?>" class="form-control" placeholder="Nama" required="">
								</div>
			<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Username</label>
									<input type="text" name="username<?= $u->kode_user?>" value="<?= $u->username?>" class="form-control" placeholder="Username" required="">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" name="password<?= $u->kode_user?>" value="<?= $u->password?>" class="form-control" placeholder="Password" required="">
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
			
			</form></center>
		</td>
		</tr>
	
		<?php $x++;}
		} else{?>
			T<tr><td colspan="5"><center>Tidak ada data</center></td></tr>
		<?php }?>
	</tr>
</table>