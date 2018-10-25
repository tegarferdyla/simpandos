 <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Daftar Paket <?php echo $get_jenis['main_jenis'] ?></h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('admin') ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Daftar Paket <?php echo $get_jenis['main_jenis'] ?></a>
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right col-md-6 col-12">
          <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <?php date_default_timezone_set('Asia/Jakarta'); date_default_timezone_set("Asia/Jakarta"); $jam  =  date("H:i:s");  ?>
            <h4 class="text-success"><i class="ft-calendar"> <?php echo date('d-m-Y') ?> </i></h4>&nbsp; &nbsp; &nbsp;
            <i class="ft-clock text-info  "></i>&nbsp; &nbsp;<h4 class="text-info" id="txt"></h4>         
          </div>
        </div>
      </div>
      <div class="content-body">
        <!-- Zero configuration table -->
        <section id="configuration">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Daftar Paket <?php echo $get_jenis['main_jenis'] ?> <br> <span class="text-muted">Sub Jenis : <?php echo $get_jenis['sub_jenis'] ?></span></h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <?php if ($this->session->flashdata('berhasil')):?>
                    <div class="alert alert-success alert-dismissible mb-2" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="false">&times;</span>
                      </button>
                      <strong> PPK Baru Berhasil Ditambahkan !</strong>
                    </div>
                    <?php elseif ($this->session->flashdata('updateberhasil')): ?>
                    <div class="alert alert-info alert-dismissible mb-2" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="false">&times;</span>
                      </button>
                      <strong> Paket Berhasil di Perbaharui !</strong>
                    </div>
                    <?php elseif ($this->session->flashdata('deleteberhasil')): ?>
                    <div class="alert alert-primary alert-dismissible mb-2" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="false">&times;</span>
                      </button>
                      <strong> Paket Berhasil di Hapus !</strong>
                    </div>
                    <?php endif ?>
                    <table class="table table-striped table-bordered zero-configuration">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Tahun</th>
                          <th>Nama Paket</th>
                          <th>Jenis</th>
                          <?php if ($get_jenis['sub_jenis'] != 'Swakelola'): ?>
                          <th>Sub Jenis</th>                            
                          <?php endif ?>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($daftarpaket as $u) { ?>
                        <tr>
                          <td class="center"><?php echo ($no++); ?></td>
                          <td><?php echo $u['nama_tahun']; ?></td>
                          <td><?php echo $u['nama_paket']; ?></td>
                          <td><?php echo $u['main_jenis']; ?></td>
                          <?php if ($u['sub_jenis'] != 'Swakelola' ):?>
                          <td><?php echo $u['sub_jenis']; ?></td>
                          <?php endif ?>
                          <td class="right">
                            <?php if ($get_jenis['sub_jenis'] != 'Swakelola'):?>
                            <a href ="<?php echo base_url()."ppk/updatepaketkontraktual/".$u['id_paket']; ?>" onclick="return confirm('Apa anda yakin ingin mengubah Paket ini?')"><button type="button" class="btn btn-outline-success mr-1"><i class="fa fa-edit"></i> Edit</button></a>
                            <a href ="<?php echo base_url()."ppk/deletepaketkontraktual/".$u['id_paket']; ?>" onclick="return confirm('Apa anda yakin ingin menghapus Paket ini?')"><button type="button" class="btn btn-outline-danger mr-1"><i class="fa fa-trash"></i> Hapus</button></a>
                            <?php elseif ($get_jenis['sub_jenis']):?>
                            <a href ="<?php echo base_url()."ppk/updatepaketswakelola/".$u['id_paket']; ?>" onclick="return confirm('Apa anda yakin ingin mengubah Paket ini?')"><button type="button" class="btn btn-outline-success mr-1"><i class="fa fa-edit"></i> Edit</button></a>
                            <a href ="<?php echo base_url()."ppk/deletepaketswakelola/".$u['id_paket']; ?>" onclick="return confirm('Apa anda yakin ingin menghapus Paket ini?')"><button type="button" class="btn btn-outline-danger mr-1"><i class="fa fa-trash"></i> Hapus</button></a>
                            <?php endif ?>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>No</th>
                          <th>Tahun</th>
                          <th>Nama Paket</th>
                          <th>Jenis</th>
                          <?php if ($get_jenis['sub_jenis'] !='Swakelola'): ?>
                          <th>Sub Jenis</th>                            
                          <?php endif ?>
                          <th>Action</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!--/ Zero configuration table -->
      </div>
    </div>
  </div>