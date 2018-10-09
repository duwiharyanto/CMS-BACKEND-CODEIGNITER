<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= ucwords($global->headline)?> | Administrator</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url();?>asset/plugins/select2/select2.min.css">  
  <link rel="stylesheet" href="<?= base_url();?>asset/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url();?>asset/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url();?>asset/plugins/datatables/dataTables.bootstrap.css"> 
  <link rel="stylesheet" href="<?= base_url();?>asset/plugins/datepicker/datepicker3.css">  
  <link rel="stylesheet" href="<?php  echo base_url();?>asset/plugins/animate-css/animate.css">   
  <link rel="stylesheet" href="<?= base_url();?>asset/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?= base_url();?>asset/dist/css/sweetalert.css">
  <link rel="stylesheet" href="<?= base_url();?>asset/dist/css/skins/_all-skins.min.css">
  
  <!--JAVASCRIPT CORE-->
  <script src="<?= base_url();?>asset/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="<?= base_url();?>asset/bootstrap/js/bootstrap.min.js"></script>  
  <script src="<?= base_url()?>asset/plugins/chartjs/Chart.bundle.js"></script>
  <script src="<?= base_url()?>asset/plugins/chartjs/utils.js"></script>
  <script src="<?= base_url();?>asset/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url();?>asset/plugins/datatables/dataTables.bootstrap.min.js"></script>
  <script src="<?= base_url();?>asset/plugins/select2/select2.full.min.js"></script> 
  <script src="<?= base_url();?>asset/plugins/datepicker/bootstrap-datepicker.js"></script>
  <script src="<?= base_url();?>asset/plugins/ckeditor/ckeditor.js"></script>  
  <script src="<?= base_url();?>asset/dist/js/sweetalert.min.js"></script>
  <script src="<?= base_url();?>asset/dist/js/jquery.priceformat.min.js"></script>  
  <script src="<?= base_url();?>asset/dist/js/jquery.validate.js"></script>
  <script src="<?= base_url();?>asset/plugins/bootstrap-notify/bootstrap-notify.js"></script>
</head>
<body class="hold-transition skin-blue layout-top-nav">
<!-- Site wrapper -->
<div class="wrapper">
  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?= site_url()?>" class="navbar-brand"><b>Admin</b>LTE</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?=site_url('home')?>">Home <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Kontak</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu <?= !$this->session->userdata('login') ? 'hide':'' ?>">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="<?= site_url('login')?>" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?= base_url('./asset/dist/img/user.png')?>" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?= $this->session->userdata('user_nama')?></span>
              </a>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <!--
      <section class="content-header">
        <h1>
          Top Navigation
          <small>Example 2.0</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Layout</a></li>
          <li class="active">Top Navigation</li>
        </ol>
      </section>
      -->
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-sm-12">
              <div class="box box-solid">
                <div class="box-body">
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                      <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                      <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="item active">
                        <img src="http://placehold.it/1200x500/39CCCC/ffffff&text=I+Love+Bootstrap" alt="First slide">

                        <div class="carousel-caption">
                          First Slide
                        </div>
                      </div>
                      <div class="item">
                        <img src="http://placehold.it/1200x500/3c8dbc/ffffff&text=I+Love+Bootstrap" alt="Second slide">

                        <div class="carousel-caption">
                          Second Slide
                        </div>
                      </div>
                      <div class="item">
                        <img src="http://placehold.it/1200x500/f39c12/ffffff&text=I+Love+Bootstrap" alt="Third slide">

                        <div class="carousel-caption">
                          Third Slide
                        </div>
                      </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                      <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                      <span class="fa fa-angle-right"></span>
                    </a>
                  </div>                    
                </div>
              </div>          
          </div>
        </div>
        <div class="row">
          <div class="col-sm-9">
            <div class="box box-solid">
              <div class="box-body">
                <table class="table berita">
                  <thead class="">
                    <tr>
                      <td>
                        <p style="font-size:24px"><span class="fa  fa-newspaper-o"></span> Berita</p>
                      </td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($berita AS $row):?>
                      <tr>
                        <td>
                          <h3 style="border-left:3px solid grey;padding: 5px"><?= ucwords($row->post_judul)?></h3>
                          <p>
                            <span class="fa fa-clock-o"></span> <?=date('d-m-Y',strtotime($row->post_tersimpan))?><br>
                            <?= word_limiter($row->post_post,100)?><br>
                            <a href="#" class="btn btn-flat btn-primary" style="margin-top:10px">Selengkapnya</a>
                          </p>
                        </td>
                      </tr>                      
                    <?php endforeach;?>                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title" style="border-left:3px solid grey; padding-left:10px"><span class="fa fa-calendar"></span> Agenda</h3>
              </div>
              <div class="box-body">
                <p style="font-size:20px;border-left:3px solid grey; padding-left:10px">05-10-2018</p>
                <p style="font-size:24px;margin-bottom:0px">Agenda</p><hr>
                <p>Lorem ipsum dolor sit amet, et viris invenire duo. Paulo viris labores nam id, mel ea quod semper quodsi. Per id postea virtute appellantur, persius tibique theophrastus cu nam. Dictas ponderum cu qui, choro antiopam periculis mel ad, ius cu accumsan appetere. Prodesset dissentiet cu eum, cu has iisque latine dolorum.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <footer class="main-footer">
    <div class="container">
      <strong>Copyright &copy; 2014-2016 <a href="#">haryanto.duwi@gmail.com</a>.</strong> 
    </div>
    <!-- /.container -->
  </footer> 
<!-- ./wrapper -->
<!--=============================FOOTER====================================-->
<!-- SlimScroll -->
<script src="<?= base_url();?>asset/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url();?>asset/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url();?>asset/dist/js/adminlte.min.js"></script>
<script src="<?= base_url();?>asset/dist/js/app.min.js"></script>
<script src="<?= base_url();?>asset/dist/js/demo.js"></script>
</body>
</html>
<script type="text/javascript">
  $('.berita').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : false,
    'ordering'    : false,
    'info'        : true,
    'autoWidth'   : false   
  });
</script>

