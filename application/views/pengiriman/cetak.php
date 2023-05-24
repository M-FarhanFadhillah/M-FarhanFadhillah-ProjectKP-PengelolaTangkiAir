<style>
	@media print {
		@page {
			size: 8.267in 5.5in;
			margin: 0;
		}

		.header-pt {
			font-weight: bold;
		}
	}

	.tbl-resi {
		font-size: 11px;
	}

	.table-wrapper {
		border: 1px solid grey;
		border-top: 4px solid grey;
		height: 180px;
		padding-top: 5px;
		display: flex;
		flex-direction: column;
		justify-content: space-between;

	}

	.border-bottom {
		border-bottom: 1px solid grey;
	}

	.border-top {
		border-top: 1px solid grey;
	}

	.border-left {
		border-left: 1px solid grey;
	}

	.img-qrcode {
		position: absolute;
		top: 0;
		right: 0;
	}

	.img-logo {
		position: absolute;
		top: 10px;
		left: 20px;
	}
</style>

<div class="content-wrapper print resi" style="margin-top: 20px;">

	<table>
		<tr>
			<td width='450' align="center" valign='top'>
				<!-- <img class="img-logo" src="<?php echo base_url("assets/images") . "/logo.jpg"; ?>" width="100" height="90" /> -->
				<div class='header-pt'>PDAM WAY RILAU</div>
				<div class='header-address'>Jl. P. Emir Moh. Noer No.11a, Sumur Putri</div>
				<div class='header-address'>Kec. Tlk. Betung Utara, Kota Bandar Lampung</div>
				<div class='header-address'>Lampung 35211, Indonesia</div>
			</td>
			<td valign='top'>
				<img class="img-qrcode" src="<?php echo base_url("export") . "/" . $data->id_pengiriman . ".png" ?>" width="90"
					height="90" />
				<div>
					Lampung,
					<?php echo date('d M Y', strtotime($data->tanggal)); ?>
				</div>
				<div class='mt10'>
					KEPADA Yth.
				</div>
				<div>
					<?php echo $data->pelanggan; ?>
				</div>
				<div class='mt10'>
					<?php echo $data->alamat; ?>
				</div>
			</td>
		</tr>
		<tr>
			<td rowspan="2">
				<div class='header-pt'>SURAT JALAN No.
					<?php echo $data->id_pengiriman; ?>
				</div>
				<div class="mb10">Harap diterima dengan baik barang2 tsb. Dibawah ini</div>
			</td>
		<tr>
	</table>
	<div class='table-wrapper'>
		<table style="width:100%;" class="mt10" cellpadding='5' cellspacing='0'>
			<tr style="max-height: 20px;">
				<th class="border-bottom">No</th>
				<th class="border-bottom">Kode Barang</th>
				<th class="border-bottom">Nama Barang</th>
				<th class="border-bottom">QTY</th>
				<th class="border-bottom">Sat</th>
				<th class="border-bottom">Total</th>
			</tr>
			<tbody>
				<?php if ($barang != null): ?>
					<?php $i = 1;
					$tagihan = 0; ?>
					<?php foreach ($barang as $br): ?>
						<?php $harga = ($br['harga'] * (double) $br['qty']) ?>
						<?php $tagihan += $harga ?>

						<tr class="tbl-resi">
							<td align="center" height="10">
								<?php echo $i; ?>
							</td>
							<td align="center">
								<?php echo $br['id_barang']; ?>
							</td>
							<td align="center">
								<?php echo $br['nama_barang']; ?>
							</td>
							<td align="center">
								<?php echo $br['qty']; ?>
							</td>
							<td align="center">Rp
								<?php echo number_format($br['harga']); ?>
							</td>
							<td align="center">
								<?php echo "Rp " . number_format($harga); ?>
							</td>
						</tr>
						<?php $i++; ?>
					<?php endforeach ?>

				<?php endif ?>
			</tbody>

		</table>
		<table style="width: 100%;" class="mt10" cellpadding='5' cellspacing='0'>
			<tfoot>
				<tr class="tbl-resi baris-total">
					<td style="width: 55%; " class="border-top" align="center" height="10">
						Total
					</td>

					<td style="width: 20%; " class="border-top" align="center">
						<?php echo $total->jumlah_total ?>
					</td>
					<td class="border-top" align="center"></td>
					<td style="width: 15%; " class="border-top" align="center">Rp
						<?php echo number_format($tagihan) ?>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
	<table style="width:100%">
		<tr>
			<td valign='top' style="width:55%">
				<div class='mt10'>
					Kendaraan No.
					<?php echo strtoupper($data->no_kendaraan); ?>
				</div>
			</td>

			<td valign='top' style="width:15%">
				<div class='mt10 mb-10'>
					Hormat Kami,
				</div>
			</td>
		</tr>
		<tr>
			<div class="divider"></div>
		</tr>
		<tr>
			<td></td>
			<td>
				<div class='mt10'>
					PDAM Way Rilau
				</div>
			</td>
		</tr>
	</table>

</div>
<script>
	$(function () {
		window.print();
	});
</script>