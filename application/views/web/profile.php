 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">Profile</div>
            </div>
          </div>
          <div class="section-body">
            <h2 class="section-title">Hi, <?=$this->session->userdata('nama')?>!</h2>
            <p class="section-lead">
              Change information about yourself on this page.
            </p>

            <div class="row mt-sm-4 justify-content-center">
              <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                  <form method="post" action="<?=base_url('/profile')?>" class="needs-validation" novalidate="">
                    <div class="card-header">
                      <h4>Edit Profile</h4>
                    </div>
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
                     <?php
                    if($this->session->flashdata('success')){ ?>
                    <div class="alert alert-success">
                        <li><?=$this->session->flashdata('success')?></li>
                    </div>
                    <?php
                    }
                    ?>
                        <div class="row">                               
                          <div class="form-group col-md-12 col-12">
                            <label>Username</label>
                            <input type="text" class="form-control" value="<?=$this->session->userdata('username')?>" disabled>
                          </div>
                        </div>
                        <div class="row">                               
                          <div class="form-group col-md-12 col-12">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?=$this->session->userdata('nama')?>" required="">
                            <div class="invalid-feedback">
                              Name required!
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-12 col-12">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?=$this->session->userdata('email')?>" required="">
                            <div class="invalid-feedback">
                              Email required!
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-12">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                            <small class="text-danger">Leave it blank if you don't want to change the password</small>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-12">
                            <label>API Key</label>
                            <div class="input-group">
                              <input type="text" id="api_key" value="<?=$api->api_key?>" name="api_key" class="form-control" disabled>
                              <div class="input-group-append">
                                <div class="input-group-text" onclick="copyApi()" title="Copy">
                                  <i class="fas fa-copy"></i>
                                </div>
                                <div class="input-group-text" id="update_api" title="Update API Key">
                                  <i class="fas fa-sync-alt"></i>
                                </div>
                              </div>
                            </div>
                            <small class="text-success info_copy d-none">API Key Copied!</small>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-12">
                            <label>Whitelist IP</label>
                            <input type="text" name="whitelist_api" value="<?=$api->whitelist_ip?>" class="form-control">
                            <small class="text-danger">Leave it blank if you want all ip allowed, if more than 2 ip separate with a sign ":"</small>
                          </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-primary" type="submit">Save Changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

<?php
$this->RenderScript[] = function() {
?>

<script>
  function copyApi() {
  
  let copyText = document.getElementById("api_key");
  const info = document.querySelector(".info_copy");

  
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

 
  navigator.clipboard.writeText(copyText.value);
  
  info.classList.remove("d-none");
  
}
</script>

<script>
  $(function(){
    $('#update_api').click(function(){
       $.ajax({
          url: "<?=base_url('/profile/update/api')?>",
          method: "POST",
          success:function(res){
            location.reload();
          }
       });
    });
  });
</script>


<?php
}
?>