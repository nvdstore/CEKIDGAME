 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Api Documentation</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">Api Documentation</div>
            </div>
          </div>
          <div class="section-body">
          <h2 class="section-title">Api Documentation</h2>
            <p class="section-lead">
                On this page you can see api documentation.
            </p>
            <div class="row mt-sm-4 justify-content-center">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        [ <code>POST</code> ] <?=base_url('/api/v1/check-game')?>
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
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Description</th>
                          </tr>
                        </thead>
                        <tbody>
                         <tr>
                            <td>api_key</td>
                            <td><code>string</code></td>
                            <td>your api key</td>
                         </tr>
                         <tr>
                            <td>game</td>
                            <td><code>string</code></td>
                            <td>the name of the game you want to check, you can see it in the game list menu </td>
                         </tr>
                         <tr>
                            <td>user_id</td>
                            <td><code>string</code></td>
                            <td>game user id </td>
                         </tr>
                         <tr>
                            <td>zone_id</td>
                            <td><code>string</code></td>
                            <td>depending on the selected game, if it is not needed then you do not need to enter the zone_id parameter </td>
                         </tr>
                        </tbody>
                      </table>
                    </div>

                     <h5 class="mt-3">Example Request</h5>
                     <pre><code class="language-php">
$api_key      = 'your api key';
$game         = 'Mobile Legends';
$user_id      = '1032209560';
$zone_id      = '13130';

$params = [
    'api_key' => $api_key,
    'game'    => $game,
    'user_id' => $user_id,
    'zone_id' => $zone_id
];

$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,'<?=base_url("/api/v1/check-game")?>');
curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type: application/x-www-form-urlencoded']);
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($params));
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);

$response = curl_exec($ch);

curl_close($ch);

$data = json_decode($response);


                     </code></pre>

                     <h5 class="mt-3">Example Response</h5>
                     <pre><code class="language-json">
{
    "code": 200,
    "status": "success",
    "result": {
                "game": "Mobile Legends",
                "user_id": "1032209560",
                "zone_id": "13130",
                "username": "Dooooo"
    }
}


                     </code></pre>

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





<?php
}
?>