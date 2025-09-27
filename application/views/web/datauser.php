 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data User</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">Data User</div>
            </div>
          </div>
          <div class="section-body">
          <h2 class="section-title">Data User</h2>
            <p class="section-lead">
                You can see all users on this page.
            </p>
            <div class="row mt-sm-4 justify-content-center">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                      <a href="<?=base_url('/data/user/add')?>" class="btn btn-primary"><i class="fas fa-plus"></i> Add User</a>
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
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>                                 
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                         <?php
                          $i = 1;
                          foreach($users as $u){
                         ?>
                          <tr>
                            <td><?=$i++?></td>
                            <td><?=$u->nama?></td>
                            <td><?=$u->email?></td>
                            <td><?=$u->username?></td>
                            <td><?=$u->role?></td>
                            <td>
                                <?php
                                 if($u->status == 1){
                                ?>
                                 <span class="badge badge-success status_user" data-id="<?=$u->id_user?>">Active</span>
                                <?php
                                 }else{
                                 ?>
                                 <span class="badge badge-danger status_user" data-id="<?=$u->id_user?>">Not Active</span>
                                 <?php
                                 }
                                 ?>
                            </td>
                            <td>
                                <?php
                                 if($u->username !== 'admin'){
                                ?>
                                <a href="<?=base_url('/data/user/delete/'.$u->id_user.'')?>" onclick="return confirm('Are you sure you want to delete this user?')" class="btn btn-danger">Delete</a>
                                <a href="<?=base_url('/data/user/edit/'.$u->id_user.'')?>" class="btn btn-secondary">Edit</a>
                                <?php
                                 }
                                 ?>
                            </td>
                          </tr>
                          <?php
                          }
                          ?>
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

<script>
    $(function(){
        $('.status_user').click(function(){
            const msg = confirm('Are you sure you want to change the user status?');
            const id = $(this).attr('data-id');
            if(msg){
                $.ajax({
                    url: "<?=base_url('/data/user/status')?>",
                    method: "POST",
                    data: {id:id},
                    success:function(res){
                        location.reload();
                    }
                })
            }
        })
    })
</script>

<?php
}
?>