<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="<?PHP echo base_url() ?>assets/images/favicon.png" type="image/png">
  <title>SENTRAL GROUP</title>
  <link href="<?PHP echo base_url() ?>assets/css/style.default.css" rel="stylesheet">
</head>
<body class="signin">
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>
<section>  
    <div class="signinpanel">       
        <div class="row">           
            <div class="col-md-7">
                <div class="signin-info">
                    <div class="logopanel">
                        <h1><span>[</span> SENTRAL GROUP <span>]</span></h1>
                    </div>
                    <div class="mb20"></div>
                    <h5><strong>JUAL BELI MOBIL, CASH - KREDIT</strong></h5>
					Jln. Sultan Agung KM. 28, No. 267, Bekasi Barat <br>
					Telp. (021) 885 4325 <br>
					Fax. (021) 8895 4224 <br>
					chandra.yoe@gmail.com
                    <div class="mb20"></div>
                </div>
            </div>
            <div class="col-md-5">
                <form method="post" action="<?php echo base_url(); ?>login/user_login">
                    <h4 class="nomargin">Sign In</h4>
                    <p class="mt5 mb20">Login to access your account.</p>
                    <input type="text" class="form-control uname" name="username" autocomplete="off" placeholder="Username" />
                    <input type="password" class="form-control pword" name="password" autocomplete="off" placeholder="Password" />
                    <button class="btn btn-success btn-block">Sign In</button>
                </form>
            </div>
        </div>
        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2015. All Rights Reserved.
            </div>
            <div class="pull-right">
                Created By: <a href="https://www.facebook.com/profile.php?id=1251528321" target="_blank">Ranadi Aji Bismo</a>
            </div>
        </div>
    </div>
</section>
<script src="<?PHP echo base_url() ?>assets/js/jquery-1.10.2.min.js"></script>
<script src="<?PHP echo base_url() ?>assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?PHP echo base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?PHP echo base_url() ?>assets/js/modernizr.min.js"></script>
<script src="<?PHP echo base_url() ?>assets/js/retina.min.js"></script>
<script src="<?PHP echo base_url() ?>assets/js/custom.js"></script>
</body>
</html>