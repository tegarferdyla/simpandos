 <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Ganti Password</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('admin') ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Ganti Password</a>
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
                  <h4 class="card-title" id="horz-layout-basic">Ganti Password</h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collpase show">
                  <div class="card-body">

                    <form class="form form-horizontal" action="<?php echo base_url('admin/updatepassword') ?>" method="post">
                      <div class="form-body">
                        <h4 class="form-section"><i class="ft-lock"></i> Ganti Password</h4>
                          <?php if ($this->session->flashdata('passwordsalah')):?>
                            <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="false">&times;</span>
                                </button>
                                <strong> Password Lama yang anda masukan salah !.</strong>
                            </div>
                            <?php elseif ($this->session->flashdata('passwordtidaksesuai')):?>
                            <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="false">&times;</span>
                                </button>
                                <strong> Penulisan Password Baru Harus Sesuai ! .</strong>
                            </div>
                            <?php elseif ($this->session->flashdata('berhasil')):?>
                            <div class="alert alert-success alert-dismissible mb-2" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="false">&times;</span>
                                </button>
                                <strong> Password Berhasil Diganti ! .</strong>
                            </div>
                          <?php endif ?>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput1">Password Lama</label>
                          <div class="col-md-9">
                            <input type="password" id="projectinput1" class="form-control" placeholder="Password Lama"
                            name="oldpassword" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput1">Password Baru</label>
                          <div class="col-md-9">
                            <input type="password" id="projectinput1" class="form-control" placeholder="Password Baru"
                            name="newpassword" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput1">Re- Type Password Baru</label>
                          <div class="col-md-9">
                            <input type="password" id="projectinput1" class="form-control" placeholder="Re- Type Password Baru"
                            name="renewpassword" required>
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