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
 
  <?php echo form_open_multipart("admin/home/save_file", ["class"=>"my_form", "id"=> 'my_form', "autocomplete" =>'off']); ?>
  <input type="hidden" value="<?= $iId ?>" name="iId">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" id="vEmail" placeholder="Enter email" value="<?= $vEmail ?>" name="vEmail">
    <?php echo form_error('vEmail'); ?>
  </div>
  <div class="form-group">
    <label for="pwd">Upload Image:</label>
    <input type="file" class="form-control" id="vProfilePicture" placeholder="Enter password" name="vProfilePicture" value="<?= $vProfilePicture ?>">
    <img id="user_image_tag" src="<?= base_url('assets/images/admin_image/') ?><?= $vProfilePicture ?>" alt="User Image" width="300px" height="300">
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