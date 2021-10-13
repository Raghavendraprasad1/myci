<div class="container">
    <div class="row">
   
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
            <?php if($error=$this->session->flashdata("error")): ?>
            <p style="color:red; font-size: 12px;" ><?php echo $error ?></p>
            <?php endif; ?>
            <?php echo form_open_multipart("admin/home/verify_otp",["class" => 'my_form', "id"=>'my_form'],["name"=>"raghav"]); ?>
            <!-- <form class="form-signin"> -->
              <div class="form-label-group">
                <input type="text" id="vOtp" name="vOtp" class="form-control" placeholder="Enter Otp" required autofocus>
                <label for="vOtp">Enter Otp</label>
              </div>

              <!-- <div class="form-label-group">
                <input type="text" id="vPassword" name="vPassword" class="form-control" placeholder="Password" required>
                <label for="vPassword">Password</label>
              </div> -->

              <!-- <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember" value="1">
                <label class="custom-control-label" for="customCheck1">Remember password</label>
              </div> -->
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Next</button>
              <hr class="my-4">
              <!-- <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button> -->
         <?= form_close() ?>
          </div>
        </div>
      </div>
    </div>
  </div>