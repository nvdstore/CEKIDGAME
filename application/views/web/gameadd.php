<?php // application/views/web/gameadd.php ?>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Add Game</h1>
    </div>
    <form action="<?= base_url('admin/saveGame') ?>" method="POST">
      <div class="card">
        <div class="card-body">
          <div class="form-group">
            <label>Game Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Slug (e.g. mobile-legends)</label>
            <input type="text" name="slug" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Endpoint URL</label>
            <input type="text" name="endpoint" class="form-control" required>
          </div>
          <div class="form-group">
            <label>User ID Required</label>
            <input type="checkbox" name="user_id_required" checked>
          </div>
          <div class="form-group">
            <label>Zone ID Required</label>
            <input type="checkbox" name="zone_required">
          </div>
          <div class="form-group">
            <label>Zone Options (pisahkan dengan koma)</label>
            <input type="text" name="zone_options" class="form-control" placeholder="asia,america,europe">
          </div>
          <button type="submit" class="btn btn-primary">Save Game</button>
        </div>
      </div>
    </form>
  </section>
</div>


<?php // application/views/web/gamelist.php ?>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Game List</h1>
      <a href="<?= base_url('admin/gameadd') ?>" class="btn btn-primary ml-auto">+ Add Game</a>
    </div>
    <div class="card">
      <div class="card-body table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Name</th>
              <th>Slug</th>
              <th>Endpoint</th>
              <th>User ID</th>
              <th>Zone ID</th>
              <th>Zone Options</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach (\$games as \$g): ?>
              <tr>
                <td><?= \$g->name ?></td>
                <td><?= \$g->slug ?></td>
                <td><?= \$g->endpoint ?></td>
                <td><?= \$g->user_id_required ? 'Yes' : 'No' ?></td>
                <td><?= \$g->zone_required ? 'Yes' : 'No' ?></td>
                <td>
                  <?php
                    \$zones = json_decode(\$g->zone_options);
                    if (!empty(\$zones)) echo implode(', ', \$zones);
                    else echo '-';
                  ?>
                </td>
                <td>
                  <a href="<?= base_url('admin/deleteGame/' . \$g->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
