 <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Edit Sub Kepala Dokumen </h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('admin') ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Edit Sub Kepala Dokumen</a>
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
                <div class="card-content collpase show">
                  <div class="card-body">

                    <form class="form form-horizontal" action="<?php echo base_url('admin/updatesubdok') ?>" method="post">
                      <div class="form-body">
                        <h4 class="form-section"><i class="ft-bookmark"></i>Edit Sub Kepala Dokumen </h4>
                          <?php if ($this->session->flashdata('namatersedia')):?>
                            <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="false">&times;</span>
                                </button>
                                <strong> Nama PPK yang anda daftarkan sudah tersedia</strong>
                            </div>
                          <?php endif ?>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput1">ID Sub Kepala Dokumen</label>
                          <div class="col-md-9">
                            <input type="text" id="projectinput1" class="form-control" placeholder="Sub Kepala Dokumen"
                            name="id_subdok" value="<?php echo $subdok['id_subdok']; ?>" readonly>
                          </div>
                        </div>  
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput1">Sub Kepala Dokumen</label>
                          <div class="col-md-9">
                            <input type="text" id="projectinput1" class="form-control" placeholder="Sub Kepala Dokumen"
                            name="sub_dokumen" value="<?php echo $subdok['sub_dokumen']; ?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput1">Kepala Dokumen</label>
                          <div class="col-md-9">
                           <select name="id_kepaladok" id="" class="form-control" required>
                           	<option value="<?php echo $subdok['id_kepaladok']?>"><?php echo $subdok['nama_kepala'] ?></option>
                           	 <optgroup label="Dokumen Utama">
                                <?php foreach ($kepaladokumen as $u ) { ?>
                                <option value="<?php echo $u['id_kepaladok'] ?>"><?php echo $u['nama_kepala']; ?></option>
                              <?php } ?>
							               </optgroup>
                           	 <optgroup label="Dokumen Pendukung">
	                           		<?php foreach ($daftarkepaladokpend as $u ) { ?>
                                <option value="<?php echo $u['id_kepaladok'] ?>"><?php echo $u['nama_kepala']; ?></option>
                              <?php } ?>
							               </optgroup>
                           </select>
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
