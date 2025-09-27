 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Edit User</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">Edit User</div>
            </div>
          </div>
          <div class="section-body">
            <h2 class="section-title">Edit User</h2>
            <p class="section-lead">
                On this page you can edit the user.
            </p>

            <div class="row mt-sm-4 justify-content-center">
              <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                  <form method="post" action="<?=base_url('/data/user/edit/'.$user->id_user.'')?>" class="needs-validation" novalidate="">
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
                            <input type="text" class="form-control" value="<?=$user->username?>" name="username" required>
                            <div class="invalid-feedback">
                              Username required!
                            </div>
                          </div>
                        </div>
                        <div class="row">                               
                          <div class="form-group col-md-12 col-12">
                            <label>Name</label>
                            <input type="text" name="name" value="<?=$user->nama?>" class="form-control" required="">
                            <div class="invalid-feedback">
                              Name required!
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-12 col-12">
                            <label>Email</label>
                            <input type="email" name="email"  value="<?=$user->email?>" class="form-control" required="">
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
                            <label>Role</label>
                            <select name="role" class="form-control" required>
                                <option value="">--Select Role--</option>
                                <option value="admin" <?=($user->role == 'admin' ? 'selected' : '')?>>Admin</option>
                                <option value="user" <?=($user->role == 'user' ? 'selected' : '')?>>User</option>
                            </select>
                            <div class="invalid-feedback">
                              Role required!
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-12">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="">--Select Status--</option>
                                <option value="1" <?=($user->status == 1 ? 'selected' : '')?>>Active</option>
                                <option value="0" <?=($user->status == 0 ? 'selected' : '')?>>Not Active</option>
                            </select>
                            <div class="invalid-feedback">
                              Status required!
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                      <a href="<?=base_url('/data/user')?>" class="btn btn-danger">Back</a>
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





<?php
}
?>