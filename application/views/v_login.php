
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<p class="lead">Login to your account</p>
							</div>
							<form class="form-auth-small" action="<?= base_url();?>index.php/User/ProsesLogin" method="POST">
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Username</label>
									<input type="username" name="username" class="form-control" id="signin-email" placeholder="Username" required="">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" name="password" class="form-control" id="signin-password" placeholder="Password" required="">
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
							</form>
							<br>
							<?php if($this->session->flashdata('pesan')!=null){?><p style="color:rgb(220,0,0);"><?= $this->session->flashdata('pesan');?></p><?php }?>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading" style="font-size:50px;">Togamedia</h1>
							<p>Beli Buku? Togamedia Aja</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	