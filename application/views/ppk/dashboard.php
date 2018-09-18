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
       <section>
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
  