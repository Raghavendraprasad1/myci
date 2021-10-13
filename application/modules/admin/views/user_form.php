<div class="container">
  <form class="form-inline" method="post" action="<?= base_url('admin/email/send_mail') ?>">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="" placeholder="Enter email" name="to_mail">
    </div>
    <div class="form-group">
      <label for="pwd">CC</label>
      <input type="email" class="form-control" id="pwd" placeholder="Enter password" name="cc_mail">
    </div>
    <div class="form-group">
      <label for="pwd">Bcc</label>
      <input type="email" class="form-control" id="pwd" placeholder="Enter password" name="bcc_mail">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>