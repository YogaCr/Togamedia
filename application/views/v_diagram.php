					<div class="row">
						<div class="col-md-6">
							
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Penjualan Buku</h3>
								</div>
								<div class="panel-body">
									<div id="bukulaku-chart" class="ct-chart"></div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Stok Buku</h3>
								</div>
								<div class="panel-body">
									<div id="stokbuku-chart" class="ct-chart"></div>
								</div>
							</div>
							
						</div>
					</div>
				<script type="text/javascript">
					$(function () {
						
					data = {
						labels: [<?php 
							$x=$bukuterjual->num_rows();
							$y=1;
							foreach ($bukuterjual->result() as $t) {?>
							'<?=$t->judul?>'<?php if($y!=$x){?>, 
						<?php }}?>],
						series: [
						[<?php 
							$x=$bukuterjual->num_rows();
							$y=1;
							foreach ($bukuterjual->result() as $t) {?>
							'<?=$t->terjual?>'<?php if($y!=$x){?>, 
						<?php }}?>]
						]
						};

						options = {
							height: 300,
							axisX: {
							showGrid: false
							},
						};
						new Chartist.Bar('#bukulaku-chart', data, options);

						data = {
						labels: [<?php 
							$x=$bukuterjual->num_rows();
							$y=1;
							foreach ($bukuterjual->result() as $t) {?>
							'<?=$t->judul?>'<?php if($y!=$x){?>, 
						<?php }}?>],
						series: [
						[<?php 
							$x=$bukuterjual->num_rows();
							$y=1;
							foreach ($bukuterjual->result() as $t) {?>
							'<?=$t->stok?>'<?php if($y!=$x){?>, 
						<?php }}?>]
						]
						};

						options = {
							height: 300,
							axisX: {
							showGrid: false
							},
						};
						new Chartist.Bar('#stokbuku-chart', data, options);
					});
				</script>