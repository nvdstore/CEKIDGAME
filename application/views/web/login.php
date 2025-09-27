
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?=$this->Main_model->getSetting()->title_web?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?=base_url()?>assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?=base_url()?>assets/modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/components.css">

</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <?=$this->Main_model->getSetting()->title_web?>
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>
              <div class="card-body">
                <?php
                if(validation_errors()){ ?>
                <div class="alert alert-danger">
                    <?=validation_errors('<li>','</li>')?>
                </div>
                <?php
                }
                ?>
                <?php
                if($this->session->flashdata('error')){ ?>
                <div class="alert alert-danger">
                    <li><?=$this->session->flashdata('error')?></li>
                </div>
                <?php
                }
                ?>
                <form method="POST" action="<?=base_url('/auth')?>" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Username required!
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      Password required!
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
    
              </div>
            </div>
            <div class="simple-footer">
            <?=$this->Main_model->getSetting()->copyright_web?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="<?=base_url()?>assets/modules/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/modules/popper.js"></script>
  <script src="<?=base_url()?>assets/modules/tooltip.js"></script>
  <script src="<?=base_url()?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?=base_url()?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?=base_url()?>assets/modules/moment.min.js"></script>
  <script src="<?=base_url()?>assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="<?=base_url()?>assets/js/scripts.js"></script>
  <script src="<?=base_url()?>assets/js/custom.js"></script>
</body>
</html>