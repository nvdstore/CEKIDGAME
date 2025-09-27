 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Add User</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">Add User</div>
            </div>
          </div>
          <div class="section-body">
            <h2 class="section-title">Add User</h2>
            <p class="section-lead">
                On this page you can add a new user.
            </p>

            <div class="row mt-sm-4 justify-content-center">
              <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                  <form method="post" action="<?=base_url('/data/user/add')?>" class="needs-validation" novalidate="">
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
                            <input type="text" class="form-control" name="username" required>
                            <div class="invalid-feedback">
                              Username required!
                            </div>
                          </div>
                        </div>
                        <div class="row">                               
                          <div class="form-group col-md-12 col-12">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required="">
                            <div class="invalid-feedback">
                              Name required!
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-12 col-12">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required="">
                            <div class="invalid-feedback">
                              Email required!
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-12">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required="">
                            <div class="invalid-feedback">
                              Password required!
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-12">
                            <label>Role</label>
                            <select name="role" class="form-control" required>
                                <option value="">--Select Role--</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
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
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
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