 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Setting Web</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">Setting Web</div>
            </div>
          </div>
          <div class="section-body">
            <h2 class="section-title">Setting Web</h2>
            <p class="section-lead">
                On this page you can set up your website.
            </p>

            <div class="row mt-sm-4 justify-content-center">
              <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                  <form method="post" action="<?=base_url('/setting/web')?>" class="needs-validation" novalidate="">
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
                            <label>Title Web</label>
                            <input type="text" class="form-control" value="<?=$data->title_web?>" name="title_web" required>
                            <div class="invalid-feedback">
                              Title web required!
                            </div>
                          </div>
                        </div>
                        <div class="row">                               
                          <div class="form-group col-md-12 col-12">
                            <label>Copyright Web</label>
                            <input type="text" name="copyright_web" value=<?=$data->copyright_web?> class="form-control" required="">
                            <div class="invalid-feedback">
                              Copyright web required!
                            </div>
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





<?php
}
?>