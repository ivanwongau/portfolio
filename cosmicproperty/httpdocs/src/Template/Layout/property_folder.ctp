<?php $cakeDescription = 'Cosmic Property LTD'; ?>
<!DOCTYPE html>
<html>

<head>
  <?= $this->Html->charset() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?= $cakeDescription ?>

  </title>
  <?= $this->Html->meta('icon') ?>
  <?= $this->fetch('meta') ?>


  <!-- boost trap  CSS-->
  <?= $this->Html->css('bootstrap.min.css'); ?>

  <!-- boost trap  JS-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>


  <!-- boost trap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

  <!-- boost trap  JS-->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

  <!-- Material Design Lite -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>



  <!-- webroort/css -->

  <?= $this->Html->css('mdb.min.css'); ?>
  <?= $this->Html->css('nav_bar'); ?>
  <?= $this->Html->css('delete_modal') ?>
  <?= $this->Html->css('sorting_table.css'); ?>




  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">



</head>

<body>
  <!-- Navigation bar start -->
  <input type="checkbox" id="check" checked>
  <!--header area start-->
  <header>
    <div style="position: relative;">
      <div style="display: relative">
        <label for="check">
          <i class="fas fa-bars" id="sidebar_btn" onClick={this.removeItems}></i>
        </label>
      </div>
      <div class="left_area" style="display: inline-block;">
        <h3>Cosmic <span>Property</span></h3>
      </div>
    </div>
  </header>


  <!--mobile navigation bar start-->
  <div class="mobile_nav">
    <div class="nav_bar">
      <i class="fa fa-bars nav_btn"></i>
    </div>
    <div class="mobile_nav_items">
    <?php echo  $this->Html->link('<i class="fas fa-home"></i><span>Buildings</span>', ['controller' => 'properties', 'action' => 'buildinglist'], ['escape' => false]); ?>

    </div>
  </div>
  <!--mobile navigation bar end-->

  <!--sidebar start-->
  <div class="sidebar">
  <?php echo  $this->Html->link('<i class="fas fa-home"></i><span>Buildings</span>', ['controller' => 'properties', 'action' => 'buildinglist'], ['escape' => false]); ?>

  </div>
  <!--sidebar end-->
  <!-- Navigation bar end -->


  <?= $this->Flash->render() ?>
  <?= $this->fetch('content') ?>
  <?= $this->Html->script('jquery-3.5.1.min'); ?>
  <?= $this->Html->script('jquery.datatables.min'); ?>
  <?= $this->Html->script('datatables.bootstrap4.min'); ?>
  <!-- Drag and drop table row -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable({
          "pageLength": 10
        }

      );
    });
  </script>

  <script>
    $('tbody').sortable();
  </script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.nav_btn').click(function() {
            $('.mobile_nav_items').toggleClass('active');
        });
    });
    </script>

</body>

</html>
