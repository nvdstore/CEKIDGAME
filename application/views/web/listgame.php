 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>List Game</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">List Game</div>
            </div>
          </div>
          <div class="section-body">
          <h2 class="section-title">List Game</h2>
            <p class="section-lead">
                On this page you can see all available games.
            </p>
            <div class="row mt-sm-4 justify-content-center">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
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
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>                                 
                          <tr>
                            <th>Game Name</th>
                            <th>User ID</th>
                            <th>Zone ID</th>
                            <th>Description</th>
                          </tr>
                        </thead>
                        <tbody>
                         <tr>
                            <td>Mobile Legends</td>
                            <td><span class="badge badge-danger">Required</span></td>
                            <td><span class="badge badge-danger">Required</span></td>
                            <td>-</td>
                         </tr>
                         
                         <tr>
                            <td>Honor of Kings</td>
                            <td><span class="badge badge-danger">Required</span></td>
                            <td><span class="badge badge-success">Not Required</span></td>
                            <td>-</td>
                         </tr>
                         <tr>
                            <td>Free Fire</td>
                            <td><span class="badge badge-danger">Required</span></td>
                            <td><span class="badge badge-success">Not Required</span></td>
                            <td>-</td>
                         </tr>
                         <tr>
                            <td>Arena Of Valor</td>
                            <td><span class="badge badge-danger">Required</span></td>
                            <td><span class="badge badge-success">Not Required</span></td>
                            <td>-</td>
                         </tr>
                         <tr>
                            <td>Point Blank</td>
                            <td><span class="badge badge-danger">Required</span></td>
                            <td><span class="badge badge-success">Not Required</span></td>
                            <td>-</td>
                         </tr>
                         
                        
                         <tr>
                            <td>Genshin Impact</td>
                            <td><span class="badge badge-danger">Required</span></td>
                            <td><span class="badge badge-danger">Required</span></td>
                            <td>
                                List Zone ID : <br>
                                <ul>
                                    <li>america</li>
                                    <li>europe</li>
                                    <li>asia</li>
                                    <li>tw_hk_mo</li>
                                </ul>
                            </td>
                         </tr>
                         <tr>
                            <td>Honkai Star Rail</td>
                            <td><span class="badge badge-danger">Required</span></td>
                            <td><span class="badge badge-danger">Required</span></td>
                            <td>
                                List Zone ID : <br>
                                <ul>
                                    <li>os_asia</li>
                                    <li>os_usa</li>
                                    <li>os_euro</li>
                                    <li>os_cht</li>
                                </ul>
                            </td>
                         </tr>
                         <tr>
                            <td>Zenless Zone Zero</td>
                            <td><span class="badge badge-danger">Required</span></td>
                            <td><span class="badge badge-danger">Required</span></td>
                            <td>
                                List Zone ID : <br>
                                <ul>
                                    <li>america</li>
                                    <li>europe</li>
                                    <li>asia</li>
                                    <li>tw_hk_mo</li>
                                </ul>
                            </td>
                         </tr>
                         <tr>
                            <td>PUBG Mobile</td>
                            <td><span class="badge badge-danger">Required</span></td>
                            <td><span class="badge badge-success">Not Required</span></td>
                            <td>-</td>
                         </tr>
                         <tr>
                            <td>Magic Chess</td>
                            <td><span class="badge badge-danger">Required</span></td>
                            <td><span class="badge badge-danger">Required</span></td>
                            <td>-</td>
                         </tr>
                        </tbody>
                      </table>
                    </div> 
                       
          
                    </div>
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
$("#table-1").dataTable({

});
</script>



<?php
}
?>