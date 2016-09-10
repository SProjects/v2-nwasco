<?php $id = $this->uri->segment(5); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= CI_title() ?></title>
    <?= CI_head() ?>
</head>
<body>
  <!-- Modal -->
  <div class="modal fade" id="#" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
  <?= CI_footer() ?>
</body>
</html>
