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
                                       <i><?php echo $where_paket['nama_paket']; ?></i>
                                       <p><?php echo $where_paket['nama_tahun']; ?></p>
                                       <p><?php echo $where_paket['main_jenis']; ?></p>
                                       <p><?php echo $where_paket['sub_jenis']; ?></p>
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
                                    I. Laporan Perencanaan
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
                                <td class="p-10">Surat Minat</td>
                                <?php if (!empty($file_sm)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_sm as $u) { ?>
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
                                <td class="p-10">Surat Pernyataan Menerima Hibah</td>
                                <?php if (!empty($file_spmh)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_spmh as $u) { ?>
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
                                <td class="p-10">Penyerahan Kendaraan + STNK</td>
                                <?php if (!empty($file_pk)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_pk as $u) { ?>
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
                                <td class="p-10">BAST Kasatker dengan Dinas Pengelola</td>
                                <?php if (!empty($file_bast)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_bast as $u) { ?>
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
                                <td class="p-10">Status dari Kasatker Ke Kementerian Keuangan</td>
                                <?php if (!empty($file_sk_kemen)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_sk_kemen as $u) { ?>
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
                                <td class="p-10">Rekomtek dari Dirjen Ke Kasatker</td>
                                <?php if (!empty($file_rekomtek)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_rekomtek as $u) { ?>
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
                                <td class="p-10">Pengajuan Hibah Ke Kementerian Keuangan</td>
                                <?php if (!empty($file_hibah_kemen)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_hibah_kemen as $u) { ?>
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
                                <td class="p-10">Persetujuan Hibah ke Satker</td>
                                <?php if (!empty($file_hibah_satker)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_hibah_satker as $u) { ?>
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
                                <td class="p-10 center">9</td>
                                <td class="p-10">Sertifikat Alat Berat</td>
                                <?php if (!empty($file_naskah_hibah)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_naskah_hibah as $u) { ?>
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
                                <td class="p-10 center">10</td>
                                <td class="p-10">Dokumen PHO BAST</td>
                                <?php if (!empty($file_ph)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_ph as $u) { ?>
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
                                <td class="p-10 center">11</td>
                                <td class="p-10">Dokumen Hibah BPKB ke Pemda  </td>
                                <?php if (!empty($file_dh)): ?>
                                    <td class="p-10">
                                        <?php foreach ($file_dh as $u) { ?>
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
                    <br><br>

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
                    <!-- End Kelompok Surat 1 -->
                 <!-- End Bendahara -->
                </td>
            </tr>
        </table>
    </div>
</body>
</html>