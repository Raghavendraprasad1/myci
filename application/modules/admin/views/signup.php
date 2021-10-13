<div class="container">
  <?php if ($error = $this->session->flashdata("error")) : ?>
    <p><?php echo $error ?></p>
  <?php endif;
  $iId = "";
  $vUserName = "";
  $vEmail = "";
  $vPassword = "";
  $vProfilePicture = "";
  if (!empty($userdata)) {
    $iId = $userdata->iId;
    $vPassword = $userdata->vPassword;
    $vEmail = $userdata->vEmail;
    $vUserName = $userdata->vUserName;
    $vProfilePicture = $userdata->vProfilePicture;
  }
  ?>

  <h2>Login form</h2>
  <a class="btn btn-info" href="<?= base_url('admin/home/delete_user/rag==hav/4=5='); ?>">Add User</a>

  <a class="btn btn-info" href="<?= base_url('admin/home/edit_userdata'); ?>">Update User</a>
  <!-- <form method="post" action="<?= base_url("admin/home/save") ?>"> -->
  <?php echo form_open("admin/home/save", "class='my_form' id='my_form' enctype='multipart/form-data' autocomplete='off' "); ?>
  <input type="hidden" value="<?= $iId ?>" name="iId">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" id="vEmail" placeholder="Enter email" value="<?= $vEmail ?>" name="vEmail">
    <?php echo form_error('vEmail'); ?>
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="vPassword" placeholder="Enter password" name="vPassword" value="<?= $vPassword ?>">
    <?php echo form_error('vPassword'); ?>
  </div>

  <div class="form-group">
    <label for="pwd">UserName:</label>
    <input type="text" class="form-control" id="vUserName" placeholder="Enter password" name="vUserName" value="<?= $vUserName ?>">
    <?php echo form_error('vUserName'); ?>
  </div>
  <div class="form-group">
    <label for="pwd">Upload Image:</label>
    <input type="file" class="form-control" id="vProfilePicture" placeholder="Enter password" name="vProfilePicture" value="<?= $vProfilePicture ?>">
    <img id="user_image_tag" src="<?= base_url('assets/images/admin_image/') ?><?= $vProfilePicture ?>" alt="User Image" width="300px" height="300">
  </div>
  <div class="checkbox">
    <label><input type="checkbox" name="remember" value="1"> Remember me</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <?php echo form_close(); ?>
</div>

<script>
   function readURL(input) {
    if (input.files && input.files[0]) {

      var reader = new FileReader();

      reader.onload = function(e) {
        $('#user_image_tag').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  } 

  $(document).on("change", "#vProfilePicture", function(e) {
    imagefilename = e.target.files[0].name;
    readURL(this);
  });

// 
  const myObj = {
  name: 'Skip',
  age: 2,
  favoriteFood: 'Steak'
};

const myObjStr = JSON.stringify(myObj);
const myObjStr2 = JSON.parse(myObjStr);

console.log(myObjStr);
console.log("Name value :"+myObjStr2.name);
console.log(typeof myObjStr);
// "{"name":"Sammy","age":6,"favoriteFood":"Tofu"}"

console.log(JSON.parse(myObjStr));
// Object {name:"Sammy",age:6,favoriteFood:"Tofu"} 

 
</script>