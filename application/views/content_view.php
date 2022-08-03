
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        API 串接
        <small>串接測試</small>
      </h1>
    </section>

    <!-- Main content -->
                <ul>
                  <li>
                    <a href="http://f.dg99.info/home/doc/cn/api.html" target="blank">
                      <div class="pull-left">
                      </div>
                      <h4>
                      DG 真人 api 中文解說
                      </h4>
                    </a>
                  </li>

                  </ul>
<pre>
DG视讯游戏_DGTE010137(测试账户)    

申请接入平台信息      
申请接入平台名称  candy娛樂城    
市场区域  台湾    
币别  TWD   
接口      
接口类型  额度转换    
接口地址  "中文:http://f.dg99.info/home/doc/cn/api.html
英文:http://f.dg99.info/home/doc/en/api.html"   
账户信息      
代理入口  http://ag.dg66.info/ag/login.html   
代理账号  DGTE010137    
账号密码  abcd1234    
key 8d0eee33c7fb4f37bae96665b23cb34d    
手机APP登入后缀 137   
</pre>
<button onclick='location.href="<?php echo base_url("Admin/newmember"); ?>"'>建立新帳號</button>

<form  action="" id="dgform" method="post">

  <select   id="accounts"  name="accounts" >
<?php
foreach($memberlist as $values) {
 echo "<option value='".$values->account."'>".$values->name."</option>";

}

?>

  </select>
  <button onclick="$('#dgform').attr('action', '<?php echo base_url('Admin/login'); ?>');$('#dgform').submit();">會員登入</button>
  <button onclick="$('#dgform').attr('action', '<?php echo base_url('Admin/freelogin'); ?>');$('#dgform').submit();">會員試玩登入</button>
</form>


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