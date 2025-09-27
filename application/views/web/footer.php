<footer class="main-footer">
        <div class="footer-left">
          <?=$this->Main_model->getSetting()->copyright_web?>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
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
  <script src="<?=base_url()?>assets/modules/datatables/datatables.min.js"></script>
  <script src="<?=base_url()?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?=base_url()?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/highlight.min.js"></script>
  <!-- and it's easy to individually load additional languages -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/languages/php.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/languages/json.min.js"></script>

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="<?=base_url()?>assets/js/scripts.js"></script>
  <script src="<?=base_url()?>assets/js/custom.js"></script>
  <?php
        if(isset($this->RenderScript))
            foreach($this->RenderScript as $script) {
                $script();
            }
    ?>
</body>
</html>