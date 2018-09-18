<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" navigation-header">
          <span>General</span><i class=" ft-minus" data-toggle="tooltip" data-placement="right"
          data-original-title="General"></i>
        </li>
        <li class="nav-item <?php if($this->uri->segment(2)==""){echo 'active';}?>"><a href="<?php echo site_url('admin') ?>"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
        </li>
        <hr>
        <!-- Kategori Barang -->
        <li class=" navigation-header">
          <span>PPK</span><i class=" ft-minus" data-toggle="tooltip" data-placement="right"
          data-original-title="Apps"></i>
        </li>
        <li class="nav-item <?php if ( $this->uri->segment(2)=="daftarppk" OR $this->uri->segment(2)=="editppk"){
          echo 'active';} ?>"><a href="<?php  echo site_url('admin/daftarppk') ?>"><i class="ft-bookmark"></i><span class="menu-title" data-i18n="">Daftar PPK</span></a>
        </li>
        <li class="nav-item <?php if ( $this->uri->segment(2)=="inputppk"){
          echo 'active';} ?>"><a href="<?php echo base_url('admin/inputppk') ?>"><i class="ft-plus-circle"></i><span class="menu-title" data-i18n="">Input PPK </span></a>
        </li>
        <!-- Dokumen -->
        <li class=" navigation-header">
          <span>Dokumen</span><i class=" ft-minus" data-toggle="tooltip" data-placement="right"
          data-original-title="Apps"></i>
        </li>
         <li class="nav-item <?php if ( $this->uri->segment(2)=="daftardokumen" OR $this->uri->segment(2)=="editdokumen"){
          echo 'active';} ?>"><a href=""><i class="ft-file-text"></i><span class="menu-title" data-i18n="">Daftar Dokumen</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="<?php echo site_url('admin/daftarkepaladokumen') ?>">Kepala Dokumen</a></li>
            <li><a class="menu-item" href="<?php echo site_url('admin/daftarsubkepaladokumen') ?>">Sub Kepala Dokumen</a></li>
          </ul>
        </li>
       <li class="nav-item <?php if ( $this->uri->segment(2)=="inputdokumen"){
          echo 'active';} ?>"><a href="<?php  echo site_url('admin/inputdokumen') ?>"><i class="ft-plus-circle"></i><span class="menu-title" data-i18n="">Input Dokumen</span></a>
        </li>
        <li class="nav-item <?php if ( $this->uri->segment(2)=="inputsubdokumen"){
          echo 'active';} ?>"><a href="<?php  echo site_url('admin/inputsubdokumen') ?>"><i class="ft-plus-circle"></i><span class="menu-title" data-i18n="">Input Sub Dokumen</span></a>
        </li>
        <!-- Jenis Paket  -->
        <li class=" navigation-header">
          <span>Jenis Paket</span><i class=" ft-minus" data-toggle="tooltip" data-placement="right"
          data-original-title="Apps"></i>
        </li>
        <li class="nav-item <?php if ( $this->uri->segment(2)=="daftarjenis" OR $this->uri->segment(2)=="editjenis"){
          echo 'active';} ?>"><a href="<?php  echo site_url('admin/daftarjenis') ?>"><i class="ft-folder"></i><span class="menu-title" data-i18n="">Daftar Jenis</span></a>
        </li>
        <li class="nav-item <?php if ( $this->uri->segment(2)=="inputjenis"){
          echo 'active';} ?>"><a href="<?php echo base_url('admin/inputjenis') ?>"><i class="ft-plus-circle"></i><span class="menu-title" data-i18n="">Input Jenis </span></a>
        </li>
        <!-- Barang -->
        <li class=" navigation-header">
          <span>User</span><i class=" ft-minus" data-toggle="tooltip" data-placement="right"
          data-original-title="Apps"></i>
        </li>
        <li class="nav-item <?php if ( $this->uri->segment(2)=="daftaruser" OR $this->uri->segment(2)=="edituser"){
          echo 'active';} ?>"><a href="<?php echo base_url('admin/daftaruser') ?>"><i class="ft-users"></i><span class="menu-title" data-i18n="">Daftar User</span></a>
        </li>
        <li class="nav-item <?php if ( $this->uri->segment(2)=="inputuser"){
          echo 'active';} ?>"><a href="<?php echo base_url('admin/inputuser') ?>"><i class="ft-plus-circle"></i><span class="menu-title" data-i18n="">Input User</span></a>
        </li>
        <hr>
        <!-- Profile -->
        <li class=" navigation-header">
          <span>Profile</span><i class=" ft-minus" data-toggle="tooltip" data-placement="right"
          data-original-title="Apps"></i>
        </li>
        <li class=" nav-item"><a href="<?php echo base_url('admin/editprofile') ?>"><i class="ft-user"></i><span class="menu-title" data-i18n="">Edit Profile</span></a>
        </li>
        <li class=" nav-item <?php if ( $this->uri->segment(2)=="gantipassword"){
          echo 'active';} ?>"><a href="<?php echo base_url('admin/gantipassword') ?>"><i class="ft-lock"></i><span class="menu-title" data-i18n="">Ganti Password</span></a>
        </li>
      </ul>
    </div>
  </div>