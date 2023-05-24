<style>
    @media print {
        @page {
            size: 8.267in 11.69in;
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

    .bordered {
        border: 1px solid grey;
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

    .m10 {
        margin: 10px;
    }

    .mt10 {
        margin-top: 10px;
    }

    .mb10 {
        margin-bottom: 10px;
    }

    .ml10 {
        margin-left: 10px;
    }

    .mr10 {
        margin-right: 10px;
    }

    .m5 {
        margin: 5px;
    }

    .mt5 {
        margin-top: 5px;
    }

    .mb5 {
        margin-bottom: 5px;
    }

    .ml5 {
        margin-left: 5px;
    }

    .mr5 {
        margin-right: 5px;
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

<div class="content-wrapper print resi" style="margin: 30px 20px;">

    <table style="width: 100%;">
        <tr width="100%" style="display: flex; justify-content: center; align-items: center;">
            <td width="15%">
                <img src="<?php echo base_url('assets/images/logo_kota.png') ?>" width="125px" alt="">
            </td>
            <td style="padding-bottom: 20px;" width='70%' align="center" valign='top'>
                <!-- <img class="img-logo" src="<?php echo base_url("assets/images") . "/logo.jpg"; ?>" width="100" height="90" /> -->
                <div class='header-pt'>PEMERINTAH KOTA BANDAR LAMPUNG</div>
                <div class='header-pt' style="font-size: 1.2em;">PERUSAHAAN UMUM DAERAH AIR MINUM WAY RILAU</div>
                <div class='header-address'>Jl. P. Emir Moh. Noer No.11a, Sumur Putri</div>
                <div class='header-address'>Teluk Betung Utara, Telp: 9721-483855, Fax: 0721-48461</div>
            </td>
            <td width="15%">
                <img src="<?php echo base_url('assets/images/logo_way_rilau.png') ?>" width="100px" alt="">
            </td>
        </tr>
        <tr>
            <td colspan="3" style="border-bottom: 1px solid grey;"></td>
        </tr>
        <tr>
            <td class="header-pt" width='100%' style="font-size: 1.3em; padding-top: 20px;" align="center"
                valign='bottom'>
                <u>SURAT PERINTAH KERJA</u>
            </td>
        </tr>
    </table>
    <table style="width:100%;">
        <tr>
            <td style="padding-bottom: 1rem;" width="25%" valign="top">Kepada</td>
            <td valign="top">:</td>
            <td valign="top">
                <?php echo $data->kurir ?>
            </td>
        </tr>

        <tr>
            <td valign="top" style="padding-bottom: 1rem;">Untuk</td>
            <td valign="top">:</td>
            <td valign="top">Segera melakukan pengiriman air tangki kepada nama dan alamat sebagaimana tersebut di bawah
                ini:</td>
        </tr>
        <br>
        <tr>
            <td valign="top" style="padding-bottom: 1rem;">Lokasi</td>
            <td valign="top">:</td>
            <td valign="top">
                <?php echo $data->alamat ?>
            </td>
        </tr>
        <tr>
            <td valign="top">Nama Pelanggan</td>
            <td valign="top">:</td>
            <td valign="top">
                <?php echo $data->pelanggan ?>
            </td>
        </tr>
        <tr>
            <td valign="top">Nomor Handphone</td>
            <td valign="top">:</td>
            <td valign="top">
                <?php echo $data->telepon ?>
            </td>
        </tr>
        <tr>
            <td valign="top">Alamat</td>
            <td valign="top">:</td>
            <td valign="top">
                <?php echo $data->alamat ?>
            </td>
        </tr>
        <tr>
            <td valign="top" style="padding-bottom: 2rem;">Golongan</td>
            <td valign="top">:</td>
            <td valign="top">
                <?php echo $data->radius ?>
            </td>
        </tr>
        <tr>
            <td colspan="3" valign="top" style="padding-bottom: 1rem;">Selanjutnya atas enyelesain pelaksanaan tugas
                diatas, harap segera menyampaikan
                laporan
                hasil pengiriman air tangki berupa Berita Acara Penjualan Air Tangki (BAPAT).</td>
        </tr>
        <tr>
            <td colspan="3" valign="top" style="padding-bottom: 5rem;">Demikian untuk menjadi perhatian dan dilaksanakan
                dengan penuh tanggung jawab.</td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="55%"></td>
            <td colspan="3" align="center" valign="top">Bandar Lampung,
                <?php echo $date ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3" align="center" valign="top">An. Direksi Perumda Air Minum Way Rilau</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3" align="center" valign="top">Kabag Humas dan Langganan</td>
        </tr>
        <tr>
            <td colspan="3" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3" align="center" valign="top"><strong><u>Hikmarwadi BMY,SE</u></strong></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3" align="center" valign="top">NIK.960179</td>
        </tr>

    </table>
    <!-- <table>
        <tr>
            <td width='450' align="center" valign='top'>
                <div class="table-wrapper">
                    <table width="100%" class="tbl-resi">
                        <tr>
                            <td width="30%" class="border-bottom border-left">No. Resi</td>
                            <td width="70%" class="border-bottom border-left">:
                                <?php //echo $data->no_resi; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="30%" class="border-bottom border-left">No. SPK</td>
                            <td width="70%" class="border-bottom border-left">:
                                <?php //echo $data->no_spk; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="30%" class="border-bottom border-left">No. PO</td>
                            <td width="70%" class="border-bottom border-left">:
                                <?php //echo $data->no_po; ?>
                            </td>
                        </tr>
                </div>
            </td>
        </tr>
    </table> -->
</div>
<script>
    $(function () {
        window.print();
    });
</script>