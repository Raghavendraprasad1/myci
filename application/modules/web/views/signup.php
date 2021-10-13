
<script>
  //  alert("this email id already exist");
</script>
<div class="container">
<?php if($error=$this->session->flashdata("error")): ?>
<p><?php echo $error ?></p>
<?php endif; ?>


  <h2>Login form</h2>
  <a  class="btn btn-info" href="<?=base_url('admin/home/delete_user/').base64_encode("4");?>">Add User</a>
  <!-- <form method="post" action="<?=base_url("admin/home/save")?>"> -->
  <?php echo form_open("web/home/save","class='my_form' id='my_form' enctype='multipart/form-data'"); ?>
  <div class="form-group">
      <label for="vUserName">UserName:</label>
      <input type="text" class="form-control" id="vUserName" placeholder="Enter password" name="vUserName">
      <?php echo form_error('vUserName'); ?>
    </div> 
  <div class="form-group">
      <label for="vEmail">Email</label>
      <input type="email" class="form-control" id="vEmail" placeholder="Enter email" name="vEmail">
       <?php echo form_error('vEmail'); ?>
    </div>
    <div class="form-group">
      <label for="vPassword">Password:</label>
      <input type="password" class="form-control" id="vPassword" placeholder="Enter password" name="vPassword">
      <?php echo form_error('vPassword'); ?>
    </div>
    <div class="form-group">
      <label for="vDepartment">Department:</label>
      <input type="text" class="form-control" id="vDepartment" placeholder="Enter department" name="vDepartment">
      <?php echo form_error('vUserName'); ?>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="remember" value="1" > Remember me</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  <?php echo form_close(); ?>
</div>

<script>
    
</script>


