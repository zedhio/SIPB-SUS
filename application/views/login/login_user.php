<!DOCTYPE html>
<html>
<head>
    <title><?php echo $pengaturan['nama_sipb']; ?></title>

    <!-- Styling -->
    <link rel="icon" href="<?php echo base_url("assets/images/logo/".$pengaturan['logo']); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("themelogin/css/site-default.min.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("themelogin/plugins/pace/pace.css"); ?>">
</head>

<!-- body -->
<body background="<?php echo base_url("themelogin/images/backgrounds/symphony.png"); ?>">
    <div class="docs-header">

        <!--nav-->
        <nav class="navbar navbar-default navbar-custom" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img src="<?php echo base_url("assets/images/logo/".$pengaturan['logo']); ?>" height="40">
                    </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                </ul>
            </div>
        </div>
    </nav>

    <!--header-->
    <div class="topic">
        <div class="container">
            <div id="jGrowl-container" class="jGrowl top-right"></div>

            <div class="col-md-7">
                <h3><?php echo $pengaturan['nama_sipb']; ?></h3>
                <h4><?php echo $pengaturan['slogan_sipb']; ?></h4>
            </div>

            <div class="col-md-5">
                <div class="advertisement">
                    <form class="form-signin" method="post">
                        <div class="form-group">
                            <label for="username"><i class="glyphicon glyphicon-user"></i> &nbsp; NIK</label>
                            <input type="text" id="inputUser" class="form-control" name="nik" placeholder="NIK" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="glyphicon glyphicon-lock"></i> &nbsp; Password</label>
                            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="action" value="sign_in">
                            <button type="submit" class="btn btn-primary">
                                <i class="glyphicon glyphicon-log-in"></i> Sign In
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container document">
    <div class="row">
        <div class="col-md-12 well">
            <div style="margin-top: 30px;"></div>
            <div class="col-md-6" align="justify">
                <h4>Tentang</h4>
                <p><?php echo $pengaturan['deskripsi']; ?></p>
            </div>
            <div class="col-md-6" align="justify">
                <h4>Lokasi</h4>
                <p><?php echo $pengaturan['lokasi_gudang']; ?></p><br>
                <p>
                    <i class="glyphicon glyphicon-phone-alt"></i> &nbsp; 
                    No.Telp &nbsp;&nbsp;: <?php echo $pengaturan['no_telp']; ?>
                </p>
                <p>
                    <i class="glyphicon glyphicon-print"></i> &nbsp; 
                    No.Fax &nbsp;&nbsp;: <?php echo $pengaturan['no_fax']; ?>
                </p>
                <p>
                    <i class="glyphicon glyphicon-envelope"></i> &nbsp; 
                    Email &nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $pengaturan['email']; ?>
                </p>
                <p>
                    <i class="glyphicon glyphicon-globe"></i> &nbsp; 
                    Website : <?php echo $pengaturan['website']; ?>
                </p>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<!-- Aditional Script -->
<script type="text/javascript" src="<?php echo base_url("themelogin/js/jquery-1.11.3.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("themelogin/js/bootstrap.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("themelogin/plugins/pace/pace.js"); ?>"></script>