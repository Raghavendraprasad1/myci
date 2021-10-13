<?php
// echo "<pre>";
// print_r($cities); die;
 $ids=$cityvalue->iCityid;
  $cityarray=explode(",",$ids);
//   print_r($cityarray); die;
?>
<?= form_open('admin/multiselect/saveCity') ?>
<div class="col-12 col-sm-6">
    <div class="form-group">
        <label>Multiple (.select2-purple)</label>
        <div class="select2-purple">
            <select class="select2" multiple="multiple" name=iCityid[] data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                <?php foreach ($cities as $city) :  ?>
                    <option value="<?= $city->iCityid ?>" <?= in_array($city->iCityid,$cityarray)? 'selected': '' ?> ><?= $city->vCity ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <!-- /.form-group -->
    
    <button type="submit" class="btn btn-primary" >Save</button>
</div>

<?= form_close(); ?>


<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        // $('.select2bs4').select2({
        //     theme: 'bootstrap4'
        // })


    })
</script>
</body>