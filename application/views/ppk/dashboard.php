  <?php 
     $warna[1]  = '#00A5A8';
     $warna[2]  =  '#FF7D4D';
     $warna[3]   =  '#626E82';
     $warna[4]   =  '#FF4558';
     $warna[5]   =  '#16D39A';
   ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <!--stats-->
        <!-- <section id="chartjs-bar-charts">
           <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Column Chart</h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                    <canvas id="column-chart" height="400"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section> -->
        <!--/stats-->
       <!-- <section> -->
        <section id="chartjs-pie-charts">
          <div class="row">
            <!-- Simple Pie Chart -->
            <div class="col-md-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Jumlah Paket Per Jenis</h4>
                  <h6> Periode : <?php echo date('Y') ?></h6>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class=row>
                    <?php if(!empty($chart)) : ?>
                    <div class="col-md-8">
                      <div class="card-body">
                        <canvas id="simple-pie-chart" height="400"></canvas>
                      </div>
                    </div>
                    <?php else : ?>
                    <div class="col-md-8">
                      <div class="card-body">
                        <h3>Tidak ada data paket yang tersedia pada periode : <?php echo date ('Y') ?> !</h3>
                        <small class="text-danger">Harap masukan data paket ppk anda terlebih dahulu </small>
                      </div>
                    </div>
                    <?php endif ?>
                    <div class ="col-md-4">
                      <h4 class="card-title">Daftar Jenis Paket</h4>
                      <ul class="pl-0 list-unstyled">
                          <li class="mb-1">
                            <?php if(!empty($chart)) : ?>
                            <?php $i=0; foreach ($chart as $r) {$i++?>
                            <div class="row">
                              <div class="col-sm-2 right">
                                 <small class="color-box sm" style="background-color: <?php echo $warna[$i]; ?>; color: <?php echo $warna[$i]; ?>; " > > ></small>
                              </div>
                              <div class="col-sm-10">
                                <h6 class="block" style ="margin-top: 4px"><?php echo $r->sub_jenis ?></h6>
                              </div>
                            </div>
                             <?php } ?>
                             <?php else : ?>
                             <h5>Tidak ada daftar jenis yang tersedia !</h5>
                             <small class="text-danger">Harap masukan data paket ppk anda terlebih dahulu </small>
                            <?php endif ?>
                          </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
          <div class="row">
            <h4 class="card-title" style="margin-left: 25px;">Daftar Tahun</h4>
          </div>
          <div class="row">

            <?php foreach ($data_tahun as $u) { ?>
            <div class="col-xl-3 col-lg-6 col-12">
                <a href="<?php echo site_url('ppk/jenispaket/'.$u['id_tahun']) ?>">
                  <div class="card">
                    <div class="card-content">
                      <div class="card-body">
                        <div class="media">
                          <div class="media media-middle">
                            <i class="ft-bookmark primary float-left"></i>
                          </div>
                          <div class="media-body text-center w-100">
                            <h3 class="primary font-large-1"><?php echo $u['nama_tahun']; ?></h3>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
            </div>
            <?php } ?>

          </div>

        </section>
        <!-- // Pie charts section end -->
      </div>
    </div>
  </div>
  