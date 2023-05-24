<div class="content-wrapper">
	<section class="content-header mb5">
		<h1>
			<?php echo $title ?>
		</h1>
		<div class="box mt5"></div>
	</section>
	<section class="content">
		<div class="row box-wrap">
			<div class="col-md-4">
				<div class="box dashboard-card box-warning">
					<div class="box-header box-title">
						PESANAN BARU
					</div>
					<div class="box-body box-content">
						<?php echo $diproses == null ? '0' : $diproses->jumlah ?>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="box dashboard-card box-primary">
					<div class="box-header box-title">
						PESANAN DIKIRIM
					</div>
					<div class="box-body box-content">
						<?php echo $dikirim == null ? '0' : $dikirim->jumlah ?>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="box dashboard-card box-success">
					<div class="box-header box-title">
						PESANAN SELESAI
					</div>
					<div class="box-body box-content">
					<?php echo $diterima == null ? '0' : $diterima->jumlah ?>
					</div>
				</div>
			</div>
		</div>
		<section class="content-header">
			<div class="row">
				<div class="col-md-10">
					<h4>
						<strong>PESANAN</strong>
					</h4>
				</div>
				<div class="col-2">
					<a style="margin-left: 50px;" href="<?php echo site_url('pengiriman/manage') ?>"
						class="btn btn-sm btn-primary">Buat
						Pesanan</a>
				</div>
			</div>
			<div class="box"></div>
		</section>
		<section class="content">
			<div class="row">
				<div class="col-md-6">
					<div class="box dashboard-recap">
						<div class="box-header">
							<h4><strong>Pesanan Baru</strong></h4>
							<div class="divider"></div>
						</div>
						<div class="box-body table-responsive">
							<table class="table table-striped table-condensed ">
								<thead>
									<tr>
										<th scope="col" width="30%">ID Pengiriman</th>
										<th scope="col">Nama Pelanggan</th>
										<th scope="col">Alamat</th>
									</tr>
								</thead>

								<tbody>

									<?php if ($data_diproses == null) { ?>
										<tr>
											<td colspan="3" class="text-center">Belum ada pesanan baru</td>
										</tr>

										<?php
									} else {
										foreach ($data_diproses as $p) {
											?>
											<tr>
												<td>
													<?php echo $p['id_pengiriman'] ?>
												</td>
												<td>
													<?php echo $p['pelanggan'] ?>
												</td>
												<td>
													<?php echo $p['alamat'] ?>
												</td>
											</tr>
											<?php
										}
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="box dashboard-recap">
						<div class="box-header">
							<h4><strong>Pesanan Dalam Pengiriman</strong></h4>
							<div class="divider"></div>
						</div>
						<div class="box-body table-responsive">
							<table class="table table-striped table-condensed">
								<thead>
									<tr>
										<th scope="col" width="30%">ID Pengiriman</th>
										<th scope="col">Nama Pelanggan</th>
										<th scope="col">Nama Kurir</th>
									</tr>
								</thead>

								<tbody>
									<?php if ($data_dikirim == null) { ?>
										<tr>
											<td colspan="3" class="text-center">Belum ada pesanan dalam pengiriman</td>
										</tr>

										<?php
									} else {
										foreach ($data_dikirim as $p) {
											?>
											<tr>
												<td>
													<?php echo $p['id_pengiriman'] ?>
												</td>
												<td>
													<?php echo $p['pelanggan'] ?>
												</td>
												<td>
													<?php echo $p['kurir'] ?>
												</td>
											</tr>
											<?php
										}
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
	</section>


</div>