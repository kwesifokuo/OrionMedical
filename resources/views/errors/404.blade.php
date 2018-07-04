<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8" />
  <title>OrionMD | Page Not Found</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
@include('includes.head')
  <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body>
    <section id="content">
    <div class="row m-n">
      <div class="col-sm-4 col-sm-offset-4">
        <div class="text-center m-b-lg">
          <h1 class="h text-white animated fadeInDownBig">404</h1>
        </div>
        <div class="list-group m-b-sm bg-white m-b-lg">
          <a href="{{ route('dashboard') }}" class="list-group-item">
            <i class="fa fa-chevron-right icon-muted"></i>
            <i class="fa fa-fw fa-home icon-muted"></i> Goto homepage
          </a>
          <a href="#" class="list-group-item">
            <i class="fa fa-chevron-right icon-muted"></i>
            <i class="fa fa-fw fa-question icon-muted"></i> Send us a tip
          </a>
          <a href="tel:+233541448708" class="list-group-item">
            <i class="fa fa-chevron-right icon-muted"></i>
            <span class="badge">Talk With a Guide</span>
            <i class="fa fa-fw fa-phone icon-muted"></i> Call us
          </a>
        </div>
        <img src="/images/broken.png"> 
      </div>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder clearfix">
      <p>
        <small>@include('includes.appversion')</small>
      </p>
    </div>
  </footer>
  <!-- / footer -->
@include('includes.scripts')
  
</body>
</html>