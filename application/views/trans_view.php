
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        API 串接
        <small$>串接測試</small>
      </h1>
    </section>

    <!-- Main content -->
<p></p>
<script>
$( document ).ready(function() {
  document.getElementById('accounts').value = '<?php echo $account ; ?>';



});
</script>


<form method="POST" action="<?php echo base_url('Admin/deposit'); ?>">
<div class="container">
  <div class="row col-lg-8">
  <div class="form-group">
    <label for="accounts">轉賬會員</label>
        <small  class="form-text text-muted">餘額：<?php echo $balance ;?></small>
    <select class="form-control" id="accounts" name="accounts">
<?php



foreach($memberlist as $values) {

// echo "<option value='".$values->account."'>".$values->name."</option>";
    echo "<option value='".$values->account."'>".$values->name."</option>";

}
?>
    </select>
  </div>
  <div class="form-group">
    <label for="amount">轉賬金額</label>
    <input type="text" class="form-control" id="amount" name="amount" placeholder="輸入金額">
    <small  class="form-text text-muted">請輸入轉賬金額.</small>
  </div>

  <button type="submit" class="btn btn-primary">確定</button>
</form>
</div>
</div>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="#">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->