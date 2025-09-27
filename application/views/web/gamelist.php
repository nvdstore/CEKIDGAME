<?php // application/views/web/gamelist.php ?>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Game List</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Game List</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">List of Available Games</h2>
      <p class="section-lead">
        Below is a list of all games registered in the system, including their endpoint and zone requirements.
      </p>

      <div class="row mt-sm-4 justify-content-center">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-body">
              <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <li><?= $this->session->flashdata('success') ?></li>
              </div>
              <?php endif; ?>
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                  <thead>
                    <tr>
                      <th>Game Name</th>
                      <th>User ID</th>
                      <th>Zone ID</th>
                      <th>Endpoint</th>
                      <th>Zone Options</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($games as $game): ?>
                    <tr>
                      <td><?= $game->name ?></td>
                      <td>
                        <span class="badge <?= $game->user_id_required ? 'badge-danger' : 'badge-success' ?>">
                          <?= $game->user_id_required ? 'Required' : 'Not Required' ?>
                        </span>
                      </td>
                      <td>
                        <span class="badge <?= $game->zone_required ? 'badge-danger' : 'badge-success' ?>">
                          <?= $game->zone_required ? 'Required' : 'Not Required' ?>
                        </span>
                      </td>
                      <td><?= $game->endpoint ?></td>
                      <td>
                        <?php
                          $zones = json_decode($game->zone_options);
                          if (!empty($zones)) echo '<ul><li>' . implode('</li><li>', $zones) . '</li></ul>';
                          else echo '-';
                        ?>
                      </td>
                    </tr>
                    <?php endforeach; ?>
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

<?php $this->RenderScript[] = function () { ?>
<script>
  $(document).ready(function () {
    $('#table-1').DataTable();
  });
</script>
<?php }; ?>
