<!DOCTYPE html>
<html lang="id">
<head>
    <style>
    @media print
    {    
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
    .body{
        line-height: normal;
        font-family: open sans, tahoma, sans-serif;
        margin: 0;
        -webkit-print-color-adjust: exact
    }
    .header {
        background-color: #006666;
        align-items: center;
        display: flex;
        padding: 20px;
    }
    .col-yellow {
        color: #fede00;
    }
    .bg-tosca {
        background-color: #006666;
    }
    .bg-grey {
        background-color: rgba(222, 238, 221, 0.8);
    }
    .col-white {
        color: #FFFFFF;
    }
    .col-tosca {
        color: #006666;
        -webkit-print-color-adjust: exact;
    }
    .col-header {
        background-color: rgba(0, 102, 102, 0.8);;
    }
    .p-5 {
        padding: 5px;
    }
    .p-10 {
        padding: 10px;
    }
    .p-20 {
        padding: 20px;
    }
    .center {
        text-align: center;
    }
    .cetak {
        text-align: right;
        padding-right: 15px;
    }
    .nama-mitra {
        font-size: 13px; font-weight: 600;
    }
    .isi-laporan {
        width: 100%;text-align: center; border: 1px solid rgba(0,0,0,0.1); padding: 8px 15px 8px 15px;
    }
</style>
<title>Laporan Detail Paket</title>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.material.min.css"> -->
</head>
<body>
    <div style="background: url(app-assets/images/laporan/logo-tni-opacity.png) center no-repeat;background-size: contain;width: 790px;">
        <table width="790" cellspacing="0" cellpadding="0" class="container" style="width: 790px; padding: 20px;">
            <tr>
                <td>
                    <table width="100%" cellspacing="0" cellpadding="0" class="p-20">
                        <tbody>
                            <tr>
                                <td colspan="2">
                                   <img src="<?php echo base_url('app-assets/images/laporan/logo1.jpg') ?>" alt="Logo PU" width="40%"">
                                </td>
                                <td class="cetak no-print" colspan="2">
                                    <a style="color: #42B549; font-size: 14px; text-decoration: none;" href="javascript:window.print()">
                                        <span style="vertical-align: middle;">Cetak</span>
                                        <img src="<?php echo base_url('app-assets/images/laporan/print.png')?>" style="vertical-align: middle;height: 20px;width: 20px;">
                                    </a>
                                </td>                                
                            </tr>
                        </tbody>
                    </table>
                        
                    <table width="100%" cellspacing="0" cellpadding="1" style="width: 100%;">
                        <tbody>
                            <tr class="col-header nama-mitra">
                                <td style="padding: 20px;" colspan="3">
                                    <h2 class="col-white"><?php echo $data_ppk['nama_ppk'] ?></h2>
                                    <small class="col-white"><i>PENGEMBANGAN PENYEHATAN LINGKUNGAN PERMUKIMAN STRATEGIS KEMENTRIAN PEKERJAAN UMUM</i></small>
                                </td>
                                <td style="padding: 20px;" colspan="1">
                                    <img style="float: right;" src="<?php cetak(base_url('app-assets/images/laporan/simpandos1.png')) ?>"  alt="Logo Simpandos" width="290" height="85">
                                </td>
                            <tr style="font-size: 13px;">
                                <td style="padding: 10px;" colspan="4">
                                    <h3 style="text-align: center;" class="col-tosca">
                                       <i> <?php echo $where_paket['nama_paket']; ?></i>
                                       <p> <?php echo $where_paket['nama_tahun']; ?></p>
                                       <p> <?php echo $where_paket['main_jenis']; ?></p>
                                       <p> <?php echo $where_paket['sub_jenis']; ?></p>

                                    </h3>
                                </td>
                            </tr>
                            <tr style="font-size: 20px;">
                                <td style="font-weight: 600;" colspan="4" class="col-tosca">
                                    Dokumen Utama
                                </td>
                            </tr>
                            <!-- Start Kelompok Surat 1 -->
                            <tr style="font-size: 13px;">
                                <td style="font-weight: 600;" colspan="4" class="col-tosca">
                                    I. Readiness Criteria
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <hr size="10" noshade style="background-color: #fede00; border: none;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100% isi-laporan">
                        <tbody>
                            <tr>
                                <td class="p-10 col-white bg-tosca">NO</td>
                                <td class="p-10 col-white bg-tosca">NAMA SURAT</td>
                                <td class="p-10 col-white bg-tosca">FILE</td>
                                <td class="p-10 col-white bg-tosca">STATUS</td>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">1</td>
                                <td class="p-10">Surat Minat Daerah</td>
                                <?php if (!empty($file_smd)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_smd as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">2</td>
                                <td class="p-10">Surat Menerima Hibah</td>
                               <?php if (!empty($file_smh)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_smh as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">3</td>
                                <td class="p-10">Surat Kesiapan Lahan</td>
                                <?php if (!empty($file_skl)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_skl as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">4</td>
                                <td class="p-10">Kesepakatan Bersama (KSB)</td>
                                <?php if (!empty($file_ksb)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_ksb as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">5</td>
                                <td class="p-10">Perjanjian Kerjasama (PKS)</td>
                                <?php if (!empty($file_pks)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_pks as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Kelompok Surat 1 -->

                    <!-- Start Kelompok Surat 2 -->
                    <table width="100%" cellspacing="0" cellpadding="1" style="width: 100%; margin-top: 50px">
                        <tbody>
                            <tr style="font-size: 13px;">
                                <td style="font-weight: 600;" colspan="4" class="col-tosca">
                                    II. Kontrak
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <hr size="10" noshade style="background-color: #fede00; border: none;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100% isi-laporan">
                        <tbody>
                             <tr>
                                <td class="p-10 col-white bg-tosca">NO</td>
                                <td class="p-10 col-white bg-tosca">NAMA SURAT</td>
                                <td class="p-10 col-white bg-tosca">FILE</td>
                                <td class="p-10 col-white bg-tosca">STATUS</td>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">1</td>
                                <td class="p-10">SPPBJ</td>
                                <?php if (!empty($file_sppbj)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_sppbj as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">2</td>
                                <td class="p-10">SPMK</td>
                                <?php if (!empty($file_spmk)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_spmk as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">3</td>
                                <td class="p-10">Naskah Kontrak</td>
                                <?php if (!empty($file_naskon)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_naskon as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">4</td>
                                <td class="p-10">Rencana Mutu Kontrak (RMK)</td>
                                <?php if (!empty($file_rmk)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_rmk as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Kelompok Surat 2 -->

                    <!-- Start MC0 -->
                    <table width="100%" cellspacing="0" cellpadding="1" style="width: 100%; margin-top: 50px">
                        <tbody>
                            <tr style="font-size: 13px;">
                                <td style="font-weight: 600;" colspan="4" class="col-tosca">
                                    III. MC0
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <hr size="10" noshade style="background-color: #fede00; border: none;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100% isi-laporan">
                        <tbody>
                             <tr>
                                <td class="p-10 col-white bg-tosca">NO</td>
                                <td class="p-10 col-white bg-tosca">NAMA SURAT</td>
                                <td class="p-10 col-white bg-tosca">FILE</td>
                                <td class="p-10 col-white bg-tosca">STATUS</td>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">1</td>
                                <td class="p-10"><i>Design Drawing</i></td>
                                <?php if (!empty($file_dd)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_dd as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">2</td>
                                <td class="p-10">Berita Acara Lapangan</td>
                                <?php if (!empty($file_bal_mco)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_bal_mco as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">3</td>
                                <td class="p-10">Justifikasi dan Spesifikasi Teknis</td>
                                <?php if (!empty($file_jst_mco)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_jst_mco as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">4</td>
                                <td class="p-10">Berita Acara <i>Pre-Construction Meeting</i>(PCM)</td>
                                <?php if (!empty($file_pcm)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_pcm as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End MC0 -->

                    <!-- Start Hasil Kalrifikasi Pasca MC0 -->
                    <table width="100%" cellspacing="0" cellpadding="1" style="width: 100%; margin-top: 50px">
                        <tbody>
                            <tr style="font-size: 13px;">
                                <td style="font-weight: 600;" colspan="4" class="col-tosca">
                                    IV. Hasil Klarifikasi Pasca MC0
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <hr size="10" noshade style="background-color: #fede00; border: none;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100% isi-laporan">
                        <tbody>
                             <tr>
                                <td class="p-10 col-white bg-tosca">NO</td>
                                <td class="p-10 col-white bg-tosca">NAMA SURAT</td>
                                <td class="p-10 col-white bg-tosca">FILE</td>
                                <td class="p-10 col-white bg-tosca">STATUS</td>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">1</td>
                                <td class="p-10"><i>Bill of Quantity</i></td>
                                <?php if (!empty($file_boq_psc)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_boq_psc as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">2</td>
                                <td class="p-10">Justifikasi dan Spesifikasi Teknis</td>
                               <?php if (!empty($file_jst_psc)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_jst_psc as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">3</td>
                                <td class="p-10">Surat Lampiran Pendukung</td>
                                <?php if (!empty($file_slp_psc)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_slp_psc as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">4</td>
                                <td class="p-10">Kurva S revisi</td>
                               <?php if (!empty($file_kurva_psc)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_kurva_psc as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">5</td>
                                <td class="p-10"><i>Shop Drawing</i></td>
                                <?php if (!empty($file_sd_psc)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_sd_psc as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">6</td>
                                <td class="p-10">Berita Acara Klarifikasi dan Negosiasi</td>
                                <?php if (!empty($file_bakn_psc)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_bakn_psc as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">7</td>
                                <td class="p-10">Naskah Adendum I</td>
                                <?php if (!empty($file_na1)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_na1 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Hasil Klarifikasi MC0 -->

                    <!-- ------------------------------------- -->
                    <!-- ATTTENTION CUP -->
                    <!-- BACA NIH -->
                    <!-- Nah dibawah ini tabel buat view adendum II, III dan IV ditampilin kalo ada datanya aja cup , kalo ga ada jangan di tampilin tabel view nya,pokok nya dia nampilin yang sesuai ada datanya aja misal data nya cuma ada di adendum II yaudah table view adendum II aja yang ditampilin, Oke -->
                    <!-- Semangat Bray-->
                    <!-- -------------------------------------- -->

                    <!-- Start Addendum II -->
                    <?php if(!empty($file_bal_ad2) || !empty($file_boq_ad2) || !empty($file_jst_ad2) || !empty($file_slp_ad2) || !empty($file_kurva_ad2) || !empty($file_sd_ad2) || !empty($file_bakn_ad2) || !empty($file_na2)) :?>
                        <table width="100%" cellspacing="0" cellpadding="1" style="width: 100%; margin-top: 50px">
                            <tbody>
                                <tr style="font-size: 13px;">
                                    <td style="font-weight: 600;" colspan="4" class="col-tosca">
                                        V. Addendum II
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <hr size="10" noshade style="background-color: #fede00; border: none;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table width="100% isi-laporan">
                            <tbody>
                                 <tr>
                                    <td class="p-10 col-white bg-tosca">NO</td>
                                    <td class="p-10 col-white bg-tosca">NAMA SURAT</td>
                                    <td class="p-10 col-white bg-tosca">FILE</td>
                                    <td class="p-10 col-white bg-tosca">STATUS</td>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">1</td>
                                    <td class="p-10">Berita Acara Lapangan</td>
                                    <?php if (!empty($file_bal_ad2)): ?>
                                        <td class="p-10">
                                            <?php foreach ($file_bal_ad2 as $u) { ?>
                                                <?php echo $u['nama_file']?> <hr>
                                            <?php } ?>
                                        </td>
                                        <td class="p-10 center">
                                            <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                        </td>
                                    <?php else : ?>
                                        <td class="p-10">Data Belum di Upload</td>
                                        <td class="p-10 center">
                                            <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                        </td>
                                    <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">2</td>
                                    <td class="p-10"><i>Bill of Quantity</i></td>
                                    <?php if (!empty($file_boq_ad2)): ?>
                                        <td class="p-10">
                                            <?php foreach ($file_boq_ad2 as $u) { ?>
                                                <?php echo $u['nama_file']?> <hr>
                                            <?php } ?>
                                        </td>
                                        <td class="p-10 center">
                                            <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                        </td>
                                    <?php else : ?>
                                        <td class="p-10">Data Belum di Upload</td>
                                        <td class="p-10 center">
                                            <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                        </td>
                                    <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">3</td>
                                    <td class="p-10">Justifikasi dan Spesifikasi Teknis</td>
                                    <?php if (!empty($file_jst_ad2)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_jst_ad2 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">4</td>
                                    <td class="p-10">Surat Lampiran Pendukung</td>
                                   <?php if (!empty($file_slp_ad2)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_slp_ad2 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">5</td>
                                    <td class="p-10">Kurva S revisi</td>
                                    <?php if (!empty($file_kurva_ad2)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_kurva_ad2 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">6</td>
                                    <td class="p-10"><i>Shop Drawing</i></td>
                                    <?php if (!empty($file_sd_ad2)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_sd_ad2 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">7</td>
                                    <td class="p-10">Berita Acara Klarifikasi dan Negosiasi</td>
                                    <?php if (!empty($file_bakn_ad2)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_bakn_ad2 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">8</td>
                                    <td class="p-10">Naskah Adendum II</td>
                                    <?php if (!empty($file_na2)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_na2 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                            </tbody>
                        </table>
                    <?php endif ?>
                    <!-- End Addendum II -->
                        
                    <!-- Start Addendum III -->
                    <?php if(!empty($file_bal_ad3) || !empty($file_boq_ad3) || !empty($file_jst_ad3) || !empty($file_slp_ad3) || !empty($file_kurva_ad3) || !empty($file_sd_ad3) || !empty($file_bakn_ad3) || !empty($file_na3)) :?>
                        <table width="100%" cellspacing="0" cellpadding="1" style="width: 100%; margin-top: 50px">
                            <tbody>
                                <tr style="font-size: 13px;">
                                    <td style="font-weight: 600;" colspan="4" class="col-tosca">
                                        V. Addendum III
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <hr size="10" noshade style="background-color: #fede00; border: none;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table width="100% isi-laporan">
                            <tbody>
                                 <tr>
                                    <td class="p-10 col-white bg-tosca">NO</td>
                                    <td class="p-10 col-white bg-tosca">NAMA SURAT</td>
                                    <td class="p-10 col-white bg-tosca">FILE</td>
                                    <td class="p-10 col-white bg-tosca">STATUS</td>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">1</td>
                                    <td class="p-10"><i>Berita Acara Lapangan</i></td>
                                    <?php if (!empty($file_bal_ad3)): ?>
                                        <td class="p-10">
                                            <?php foreach ($file_bal_ad3 as $u) { ?>
                                                <?php echo $u['nama_file']?> <hr>
                                            <?php } ?>
                                        </td>
                                        <td class="p-10 center">
                                            <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                        </td>
                                    <?php else : ?>
                                        <td class="p-10">Data Belum di Upload</td>
                                        <td class="p-10 center">
                                            <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                        </td>
                                    <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">2</td>
                                    <td class="p-10"><i>Bill of Quantity</i></td>
                                    <?php if (!empty($file_boq_ad3)): ?>
                                        <td class="p-10">
                                            <?php foreach ($file_boq_ad3 as $u) { ?>
                                                <?php echo $u['nama_file']?> <hr>
                                            <?php } ?>
                                        </td>
                                        <td class="p-10 center">
                                            <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                        </td>
                                    <?php else : ?>
                                        <td class="p-10">Data Belum di Upload</td>
                                        <td class="p-10 center">
                                            <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                        </td>
                                    <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">3</td>
                                    <td class="p-10">Justifikasi dan Spesifikasi Teknis</td>
                                    <?php if (!empty($file_jst_ad3)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_jst_ad3 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">4</td>
                                    <td class="p-10">Surat Lampiran Pendukung</td>
                                   <?php if (!empty($file_slp_ad3)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_slp_ad3 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">5</td>
                                    <td class="p-10">Kurva S revisi</td>
                                    <?php if (!empty($file_kurva_ad3)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_kurva_ad3 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">6</td>
                                    <td class="p-10"><i>Shop Drawing</i></td>
                                    <?php if (!empty($file_sd_ad3)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_sd_ad3 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">7</td>
                                    <td class="p-10">Berita Acara Klarifikasi dan Negosiasi</td>
                                    <?php if (!empty($file_bakn_ad3)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_bakn_ad3 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">8</td>
                                    <td class="p-10">Naskah Adendum III</td>
                                    <?php if (!empty($file_na3)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_na3 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                            </tbody>
                        </table>
                    <?php endif ?>
                    <!-- End Addendum III -->
                    
                    <!-- Start Addendum IV -->
                   <?php if(!empty($file_bal_ad4) || !empty($file_boq_ad4) || !empty($file_jst_ad4) || !empty($file_slp_ad4) || !empty($file_kurva_ad4) || !empty($file_sd_ad4) || !empty($file_bakn_ad4) || !empty($file_na4)) :?>
                        <table width="100%" cellspacing="0" cellpadding="1" style="width: 100%; margin-top: 50px">
                            <tbody>
                                <tr style="font-size: 13px;">
                                    <td style="font-weight: 600;" colspan="4" class="col-tosca">
                                        V. Addendum IV
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <hr size="10" noshade style="background-color: #fede00; border: none;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table width="100% isi-laporan">
                            <tbody>
                                 <tr>
                                    <td class="p-10 col-white bg-tosca">NO</td>
                                    <td class="p-10 col-white bg-tosca">NAMA SURAT</td>
                                    <td class="p-10 col-white bg-tosca">FILE</td>
                                    <td class="p-10 col-white bg-tosca">STATUS</td>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">1</td>
                                    <td class="p-10"><i>Berita Acara Lapangan</i></td>
                                    <?php if (!empty($file_bal_ad4)): ?>
                                        <td class="p-10">
                                            <?php foreach ($file_bal_ad4 as $u) { ?>
                                                <?php echo $u['nama_file']?> <hr>
                                            <?php } ?>
                                        </td>
                                        <td class="p-10 center">
                                            <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                        </td>
                                    <?php else : ?>
                                        <td class="p-10">Data Belum di Upload</td>
                                        <td class="p-10 center">
                                            <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                        </td>
                                    <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">2</td>
                                    <td class="p-10"><i>Bill of Quantity</i></td>
                                    <?php if (!empty($file_boq_ad4)): ?>
                                        <td class="p-10">
                                            <?php foreach ($file_boq_ad4 as $u) { ?>
                                                <?php echo $u['nama_file']?> <hr>
                                            <?php } ?>
                                        </td>
                                        <td class="p-10 center">
                                            <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                        </td>
                                    <?php else : ?>
                                        <td class="p-10">Data Belum di Upload</td>
                                        <td class="p-10 center">
                                            <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                        </td>
                                    <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">3</td>
                                    <td class="p-10">Justifikasi dan Spesifikasi Teknis</td>
                                    <?php if (!empty($file_jst_ad4)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_jst_ad4 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">4</td>
                                    <td class="p-10">Surat Lampiran Pendukung</td>
                                   <?php if (!empty($file_slp_ad4)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_slp_ad4 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">5</td>
                                    <td class="p-10">Kurva S revisi</td>
                                    <?php if (!empty($file_kurva_ad4)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_kurva_ad4 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">6</td>
                                    <td class="p-10"><i>Shop Drawing</i></td>
                                    <?php if (!empty($file_sd_ad4)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_sd_ad4 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">7</td>
                                    <td class="p-10">Berita Acara Klarifikasi dan Negosiasi</td>
                                    <?php if (!empty($file_bakn_ad4)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_bakn_ad4 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">8</td>
                                    <td class="p-10">Naskah Adendum IV</td>
                                    <?php if (!empty($file_na4)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_na4 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                            </tbody>
                        </table>
                    <?php endif ?>
                    <!-- End Addendum IV -->

                    <?php if(!empty($file_bal_ad5) || !empty($file_boq_ad5) || !empty($file_jst_ad5) || !empty($file_slp_ad5) || !empty($file_kurva_ad5) || !empty($file_sd_ad5) || !empty($file_bakn_ad5) || !empty($file_na5)) :?>
                        <table width="100%" cellspacing="0" cellpadding="1" style="width: 100%; margin-top: 50px">
                            <tbody>
                                <tr style="font-size: 13px;">
                                    <td style="font-weight: 600;" colspan="4" class="col-tosca">
                                        V. Addendum V
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <hr size="10" noshade style="background-color: #fede00; border: none;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table width="100% isi-laporan">
                            <tbody>
                                 <tr>
                                    <td class="p-10 col-white bg-tosca">NO</td>
                                    <td class="p-10 col-white bg-tosca">NAMA SURAT</td>
                                    <td class="p-10 col-white bg-tosca">FILE</td>
                                    <td class="p-10 col-white bg-tosca">STATUS</td>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">1</td>
                                    <td class="p-10"><i>Berita Acara Lapangan</i></td>
                                    <?php if (!empty($file_bal_ad5)): ?>
                                        <td class="p-10">
                                            <?php foreach ($file_bal_ad5 as $u) { ?>
                                                <?php echo $u['nama_file']?> <hr>
                                            <?php } ?>
                                        </td>
                                        <td class="p-10 center">
                                            <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                        </td>
                                    <?php else : ?>
                                        <td class="p-10">Data Belum di Upload</td>
                                        <td class="p-10 center">
                                            <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                        </td>
                                    <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">2</td>
                                    <td class="p-10"><i>Bill of Quantity</i></td>
                                    <?php if (!empty($file_boq_ad5)): ?>
                                        <td class="p-10">
                                            <?php foreach ($file_boq_ad5 as $u) { ?>
                                                <?php echo $u['nama_file']?> <hr>
                                            <?php } ?>
                                        </td>
                                        <td class="p-10 center">
                                            <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                        </td>
                                    <?php else : ?>
                                        <td class="p-10">Data Belum di Upload</td>
                                        <td class="p-10 center">
                                            <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                        </td>
                                    <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">3</td>
                                    <td class="p-10">Justifikasi dan Spesifikasi Teknis</td>
                                    <?php if (!empty($file_jst_ad5)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_jst_ad5 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">4</td>
                                    <td class="p-10">Surat Lampiran Pendukung</td>
                                   <?php if (!empty($file_slp_ad5)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_slp_ad5 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">5</td>
                                    <td class="p-10">Kurva S revisi</td>
                                    <?php if (!empty($file_kurva_ad5)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_kurva_ad5 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">6</td>
                                    <td class="p-10"><i>Shop Drawing</i></td>
                                    <?php if (!empty($file_sd_ad5)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_sd_ad5 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">7</td>
                                    <td class="p-10">Berita Acara Klarifikasi dan Negosiasi</td>
                                    <?php if (!empty($file_bakn_ad5)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_bakn_ad5 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                                <tr style="font-size: 13px;" class="bg-grey">
                                    <td class="p-10 center">8</td>
                                    <td class="p-10">Naskah Adendum V</td>
                                <?php if (!empty($file_na5)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_na5 as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                                </tr>
                            </tbody>
                        </table>
                    <?php endif ?>
                        
                    <!-- Start Kelompok Surat 3   -->
                    <table width="100%" cellspacing="0" cellpadding="1" style="width: 100%; margin-top: 50px">
                        <tbody>
                            <tr style="font-size: 13px;">
                                <td style="font-weight: 600;" colspan="4" class="col-tosca">
                                    VIII. Kelompok Surat 3
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <hr size="10" noshade style="background-color: #fede00; border: none;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100% isi-laporan">
                        <tbody>
                             <tr>
                                <td class="p-10 col-white bg-tosca">NO</td>
                                <td class="p-10 col-white bg-tosca">NAMA SURAT</td>
                                <td class="p-10 col-white bg-tosca">FILE</td>
                                <td class="p-10 col-white bg-tosca">STATUS</td>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">1</td>
                                <td class="p-10">Laporan Harian</td>
                                <?php if (!empty($file_lh)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_lh as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">2</td>
                                <td class="p-10">Laporan Mingguan</td>
                                <?php if (!empty($file_lm)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_lm as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">3</td>
                                <td class="p-10">Laporan Bulanan</td>
                                <?php if (!empty($file_lb)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_lb as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">4</td>
                                <td class="p-10">Sertifikat Pembayaran</td>
                                <?php if (!empty($file_sp)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_sp as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Kelompok Surat 3 -->

                    <!-- Start Kelompok Surat 4 -->
                    <table width="100%" cellspacing="0" cellpadding="1" style="width: 100%; margin-top: 50px">
                        <tbody>
                            <tr style="font-size: 13px;">
                                <td style="font-weight: 600;" colspan="4" class="col-tosca">
                                    IX. Uji Kualitas Konstruksi
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <hr size="10" noshade style="background-color: #fede00; border: none;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100% isi-laporan">
                        <tbody>
                             <tr>
                                <td class="p-10 col-white bg-tosca">NO</td>
                                <td class="p-10 col-white bg-tosca">NAMA SURAT</td>
                                <td class="p-10 col-white bg-tosca">FILE</td>
                                <td class="p-10 col-white bg-tosca">STATUS</td>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">1</td>
                                <td class="p-10">Berita Acara Pengujian Material</td>
                                <?php if (!empty($file_bapm)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_bapm as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Kelompok Surat 4 -->

                    <!-- Start Kelompok Surat 5 -->
                    <table width="100%" cellspacing="0" cellpadding="1" style="width: 100%; margin-top: 50px">
                        <tbody>
                            <tr style="font-size: 13px;">
                                <td style="font-weight: 600;" colspan="4" class="col-tosca">
                                    X.<i>Show Cause Meeting</i> (SCM)
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <hr size="10" noshade style="background-color: #fede00; border: none;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100% isi-laporan">
                        <tbody>
                             <tr>
                                <td class="p-10 col-white bg-tosca">NO</td>
                                <td class="p-10 col-white bg-tosca">NAMA SURAT</td>
                                <td class="p-10 col-white bg-tosca">FILE</td>
                                <td class="p-10 col-white bg-tosca">STATUS</td>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">1</td>
                                <td class="p-10">Berita Acara <i>Show cause Meeting</i> (SCM)</td>
                                <?php if (!empty($file_scm)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_scm as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Kelompok Surat 5  -->
                    <!-- Start Provisional Hand Over (PHO) -->
                    <table width="100%" cellspacing="0" cellpadding="1" style="width: 100%; margin-top: 50px">
                        <tbody>
                            <tr style="font-size: 13px;">
                                <td style="font-weight: 600;" colspan="4" class="col-tosca">
                                    XI. <i>Provisional Hand Over</i> (PHO)
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <hr size="10" noshade style="background-color: #fede00; border: none;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100% isi-laporan">
                        <tbody>
                             <tr>
                                <td class="p-10 col-white bg-tosca">NO</td>
                                <td class="p-10 col-white bg-tosca">NAMA SURAT</td>
                                <td class="p-10 col-white bg-tosca">FILE</td>
                                <td class="p-10 col-white bg-tosca">STATUS</td>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">1</td>
                                <td class="p-10"><i>Surat Permohonan PHO</i></td>
                                <?php if (!empty($file_sp_pho)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_sp_pho as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">2</td>
                                <td class="p-10">Berita Acara <i>First Visit</i></td>
                                <?php if (!empty($file_ba_pho)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_ba_pho as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">3</td>
                                <td class="p-10">Berita Acara <i>Second Visit</i> </td>
                                <?php if (!empty($file_basv_pho)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_basv_pho as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">4</td>
                                <td class="p-10">Berita Acara Serah Terima Pekerjaan</td>
                                <?php if (!empty($file_bastp_pho)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_bastp_pho as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">5</td>
                                <td class="p-10">As Build Drawing</td>
                                <?php if (!empty($file_abd_pho)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_abd_pho as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Provisional Hand Over (PHO) -->

                    <!-- Start Final Hand Over -->
                    <table width="100%" cellspacing="0" cellpadding="1" style="width: 100%; margin-top: 50px">
                        <tbody>
                            <tr style="font-size: 13px;">
                                <td style="font-weight: 600;" colspan="4" class="col-tosca">
                                    XII. <i>Final Hand Over</i> (PHO)
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <hr size="10" noshade style="background-color: #fede00; border: none;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100% isi-laporan">
                        <tbody>
                             <tr>
                                <td class="p-10 col-white bg-tosca">NO</td>
                                <td class="p-10 col-white bg-tosca">NAMA SURAT</td>
                                <td class="p-10 col-white bg-tosca">FILE</td>
                                <td class="p-10 col-white bg-tosca">STATUS</td>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">1</td>
                                <td class="p-10"><i>Surat Permohonan FHO</i></td>
                                <?php if (!empty($file_sp_fho)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_sp_fho as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">2</td>
                                <td class="p-10">Berita Acara <i>First Visit</i></td>
                                <?php if (!empty($file_ba_fho)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_ba_fho as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">3</td>
                                <td class="p-10">Berita Acara <i>Second Visit</i> </td>
                                <?php if (!empty($file_basv_fho)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_basv_fho as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">4</td>
                                <td class="p-10">Berita Acara Serah Terima Pekerjaan</td>
                                <?php if (!empty($file_bastp_fho)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_bastp_fho as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Final Hand Over -->
                    <!-- Start Kelompok Surat 5 -->
                    <table width="100%" cellspacing="0" cellpadding="1" style="width: 100%; margin-top: 50px">
                        <tbody>
                            <tr style="font-size: 13px;">
                                <td style="font-weight: 600;" colspan="4" class="col-tosca">
                                    XIII. Dokumentasi
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <hr size="10" noshade style="background-color: #fede00; border: none;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100% isi-laporan">
                        <tbody>
                             <tr>
                                <td class="p-10 col-white bg-tosca">NO</td>
                                <td class="p-10 col-white bg-tosca">NAMA SURAT</td>
                                <td class="p-10 col-white bg-tosca">FILE</td>
                                <td class="p-10 col-white bg-tosca">STATUS</td>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">1</td>
                                <td class="p-10">Dokumentasi</td>
                                <?php if (!empty($file_dok)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_dok as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Dokumentasi  -->
                    <!-- ---------------------------------------------------------------------------------------------------- -->
                    <!-- ------------------------------------PENDUKUNG DISINI------------------------------------------------ -->
                    <!-- ---------------------------------------------------------------------------------------------------- -->
                    <table width="100%" cellspacing="0" cellpadding="1" style="width: 100%;">
                        <tbody>
                            <tr style="font-size: 20px;">
                                <td style="font-weight: 600;" colspan="4" class="col-tosca">
                                    Dokumen Pendukung
                                </td>
                            </tr>
                            <!-- Start Kelompok Surat 1 -->
                            <tr style="font-size: 13px;">
                                <td style="font-weight: 600;" colspan="4" class="col-tosca">
                                    I. BMN
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <hr size="10" noshade style="background-color: #fede00; border: none;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                     <table width="100% isi-laporan">
                        <tbody>
                            <tr>
                                <td class="p-10 col-white bg-tosca">NO</td>
                                <td class="p-10 col-white bg-tosca">NAMA SURAT</td>
                                <td class="p-10 col-white bg-tosca">FILE</td>
                                <td class="p-10 col-white bg-tosca">STATUS</td>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">1</td>
                                <td class="p-10">Surat Alih Status</td>
                                <?php if (!empty($file_sas)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_sas as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">2</td>
                                <td class="p-10">Rekomomendasi Teknis</td>
                                <?php if (!empty($file_rt)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_rt as $u) { ?>
                                                <li><?php echo $u['nama_file']?></li>
                                            </ul>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">3</td>
                                <td class="p-10">BAST Pengelolaan</td>
                                <?php if (!empty($file_shkk)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_shkk as $u) { ?>
                                                <li><?php echo $u['nama_file']?></li>
                                            </ul>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">4</td>
                                <td class="p-10">BAST Asset</td>
                                <?php if (!empty($file_bast_bmn)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_bast_bmn as $u) { ?>
                                                <?php echo $u['nama_file']?><hr>    
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                        </tbody>
                    </table>
                     <table width="100% isi-laporan">
                        <tbody>
                            <tr style="font-size: 13px;">
                                <td style="font-weight: 600;" colspan="4" class="col-tosca">
                                    II. KEUANGAN
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <hr size="10" noshade style="background-color: #fede00; border: none;">
                                </td>
                            </tr>
                            <tr>
                                <td class="p-10 col-white bg-tosca">NO</td>
                                <td class="p-10 col-white bg-tosca">NAMA SURAT</td>
                                <td class="p-10 col-white bg-tosca">FILE</td>
                                <td class="p-10 col-white bg-tosca">STATUS</td>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">1</td>
                                <td class="p-10">Permohonan Pembayaran</td>
                                <?php if (!empty($file_pp)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_pp as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">2</td>
                                <td class="p-10">Kuitansi</td>
                                <?php if (!empty($file_kuitansi)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_kuitansi as $u) { ?>
                                                <li><?php echo $u['nama_file']?></li>
                                            </ul>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">3</td>
                                <td class="p-10">Kartu Pengawasan (Karwas)</td>
                                <?php if (!empty($file_karwas)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_karwas as $u) { ?>
                                                <li><?php echo $u['nama_file']?></li>
                                            </ul>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">4</td>
                                <td class="p-10">Faktur Pajak</td>
                                <?php if (!empty($file_fp)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_fp as $u) { ?>
                                                <li><?php echo $u['nama_file']?></li>
                                            </ul>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">5</td>
                                <td class="p-10">PPH dan PPN</td>
                                <?php if (!empty($file_ppn)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_ppn as $u) { ?>
                                                <li><?php echo $u['nama_file']?></li>
                                            </ul>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">6</td>
                                <td class="p-10">SPP</td>
                                <?php if (!empty($file_spp)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_spp as $u) { ?>
                                                <li><?php echo $u['nama_file']?></li>
                                            </ul>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">7</td>
                                <td class="p-10">SPM</td>
                                <?php if (!empty($file_spm)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_spm as $u) { ?>
                                                <li><?php echo $u['nama_file']?></li>
                                            </ul>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                             <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">8</td>
                                <td class="p-10">SP2D</td>
                                <?php if (!empty($file_sp2d)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_sp2d as $u) { ?>
                                                <li><?php echo $u['nama_file']?></li>
                                            </ul>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100% isi-laporan">
                        <tbody>
                            <tr style="font-size: 13px;">
                                <td style="font-weight: 600;" colspan="4" class="col-tosca">
                                    III. BENDAHARA
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <hr size="10" noshade style="background-color: #fede00; border: none;">
                                </td>
                            </tr>
                            <tr>
                                <td class="p-10 col-white bg-tosca">NO</td>
                                <td class="p-10 col-white bg-tosca">NAMA SURAT</td>
                                <td class="p-10 col-white bg-tosca">FILE</td>
                                <td class="p-10 col-white bg-tosca">STATUS</td>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">1</td>
                                <td class="p-10">Jaminan Uang Muka</td>
                                <?php if (!empty($file_lpj)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_lpj as $u) { ?>
                                            <?php echo $u['nama_file']?> <hr>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">2</td>
                                <td class="p-10">Jaminan Pelaksanaan</td>
                                <?php if (!empty($file_rekonsi)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_rekonsi as $u) { ?>
                                                <li><?php echo $u['nama_file']?></li>
                                            </ul>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">3</td>
                                <td class="p-10">Jaminan Pemeliharaan</td>
                                <?php if (!empty($file_rk)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_rk as $u) { ?>
                                                <li><?php echo $u['nama_file']?></li>
                                            </ul>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr style="font-size: 13px;" class="bg-grey">
                                <td class="p-10 center">4</td>
                                <td class="p-10">Laporan Pajak</td>
                                <?php if (!empty($file_bapk)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_bapk as $u) { ?>
                                                <li><?php echo $u['nama_file']?></li>
                                            </ul>
                                        <?php } ?>
                                    </td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/check.png')?>">
                                    </td>
                                <?php else : ?>
                                    <td class="p-10">Data Belum di Upload</td>
                                    <td class="p-10 center">
                                        <img src="<?php echo base_url('app-assets/images/laporan/cancel.png')?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>