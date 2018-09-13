  <?php 
     $warna[1]  = '#00A5A8';
     $warna[2]  =  '#626E82';
     $warna[3]   =  '#FF7D4D';
     $warna[4]   =  '#FF4558';
     $warna[5]   =  '#16D39A';
   ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <!--stats-->
        <div class="row">
          <div class="col-xl-3 col-lg-6 col-12">
          <a href="<?php echo site_url('admin/daftaruser') ?>">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body text-left w-100">
                      <h3 class="primary"><?php echo $jmluser; ?></h3>
                      <span>Total User Aktif</span>
                    </div>
                    <div class="media-right media-middle">
                      <i class="ft-users primary font-large-2 float-right"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
            <a href="<?php echo site_url('admin/daftarppk') ?>">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body text-left w-100">
                      <h3 class="danger"><?php echo $jmlppk; ?></h3>
                      <span>Total PPK</span>
                    </div>
                    <div class="media-right media-middle">
                      <i class="ft-bookmark danger font-large-2 float-right"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body text-left w-100">
                      <h3 class="success">67</h3>
                      <span>Kepala Folder</span>
                    </div>
                    <div class="media-right media-middle">
                      <i class="icon-layers success font-large-2 float-right"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body text-left w-100">
                      <h3 class="warning">170</h3>
                      <span>Total Paket</span>
                    </div>
                    <div class="media-right media-middle">
                      <i class="icon-globe warning font-large-2 float-right"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/stats-->
       <section id="chartjs-pie-charts">
          <div class="row">
            <!-- Simple Pie Chart -->
            <div class="col-md-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Paket Per PPK</h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class=row>
                    <div class="col-md-8">
                      <div class="card-body">
                        <canvas id="simple-pie-chart" height="400"></canvas>
                      </div>
                    </div>
                    <div class ="col-md-4">
                      <h4 class="card-title">Daftar PPK</h4>
                      <ul class="pl-0 list-unstyled">
                          <li class="mb-1">
                            <?php $i=0; foreach ($data_ppk as $u) {$i++ ?>
                            <div class="row">
                              <div class="col-sm-2 right">
                                <small class="color-box sm" style="background-color: <?php echo $warna[$i]; ?>; color: <?php echo $warna[$i]; ?>; " > > ></small>
                              </div>
                              <div class="col-sm-10">
                                <h6 class="block" style ="margin-top: 4px"><?php echo $u['nama_ppk'] ?></h6>
                              </div>
                            </div>
                          <?php } ?>
                          </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- // Pie charts section end -->
      </div>
    </div>
  </div>