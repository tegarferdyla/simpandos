 <div class="app-content content">
    <div class="content-wrapper">
       <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Edit Paket Kontraktual</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('admin') ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Edit Paket Kontraktual</a>
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
        <section id="horizontal-form-layouts">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title" id="horz-layout-basic">Edit Paket</h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collpase show">
                  <div class="card-body">

                    <form class="form form-horizontal" action="<?php echo base_url('ppk/editpaketkontraktual') ?>" method="post">
                      <div class="form-body">
                        <h4 class="form-section"><i class="ft-file"></i><?php echo $wherepaket[0]['nama_paket']; ?></h4>
                          <?php if ($this->session->flashdata('tahuntersedia')):?>
                            <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="false">&times;</span>
                                </button>
                                <strong> Tahun yang anda daftarkan sudah tersedia</strong>
                            </div>
                          <?php endif ?>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput1">ID Paket</label>
                          <div class="col-md-9">
                            <input type="hidden" id="projectinput1" class="form-control" value="<?php echo $wherepaket[0]['id_paket']; ?>" 
                            name="id_paket" required readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput1">Nama Paket</label>
                          <div class="col-md-9">
                            <input type="text" id="projectinput1" class="form-control" value="<?php echo $wherepaket[0]['nama_paket']; ?>" 
                            name="namapaket_baru" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput1">Jenis Paket</label>
                          <div class="col-md-9">
                            <input type="text" id="projectinput1" class="form-control" name="jenispaket" readonly="" value="Kontraktual"> 
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput1">Sub Jenis</label>
                          <div class="col-md-9">
                            <select name="id_jenis_baru" class="form-control" required>
                              <option value="<?php echo $wherepaket[0]['id_jenis'] ?>"><?php echo $wherepaket[0]['sub_jenis']; ?></option>
                              <option value="">-- Ubah Sub Jenis Kontraktual --</option>
                              <?php foreach ($data_jenis as $u) { ?>
                                <option value="<?php echo $u['id_jenis'] ?>"><?php echo $u['sub_jenis']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput1">Tahun</label>
                          <div class="col-md-9">
                            <select name="id_tahun_baru" class="form-control" required>
                              <option value="<?php echo $wherepaket[0]['id_tahun'] ?>">Tahun <?php echo $wherepaket[0]['nama_tahun']; ?></option>
                              <option value="">-- Update Tahun Paket --</option>
                              <?php foreach ($data_tahun as $u) { ?>
                                <option value="<?php echo $u['id_tahun'] ?>"> Tahun <?php echo $u['nama_tahun']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput2">Deskripsi</label>
                          <div class="col-md-9">
                            <textarea id="projectinput9" rows="5" class="form-control" name="deskripsi_baru" placeholder="Keterangan Tahun"><?php echo $wherepaket[0]['deskripsi'] ?></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="form-actions right">
                        <button type="button" class="btn btn-warning mr-1">
                          <i class="ft-x"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                          <i class="fa fa-check-square-o"></i> Save
                        </button>
                      </div>
                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>