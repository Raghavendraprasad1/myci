<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="container">
      <h1 style="text-align: center;" > <u> Dynamic-Form</u></h1>
        <form action="<?= base_url('admin/dynamic_form_jquery/save') ?>" method="post">

            <!-- here the default count value is 2 -->
            <input type="hidden" id="total_count" name="total_count" value="2">

            <!-- first form -->
            <div class="row formulation-div">
                <a href="javascript:void(0)" class="btn btn-danger add_more_btn" title="Add More" style="float: right; margin-right: 150px; margin-top: 20px;">Add More</a>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="vName">Name</label>
                        <input type="text" class="form-control" id="vName" placeholder="Enter name" name="vName_1">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="vEmail" placeholder="Enter city" name="vEmail_1">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="vCity">City</label>
                        <input type="text" class="form-control" id="vCity" placeholder="Enter name" name="vCity_1">
                    </div>
                </div>
            </div>
            <!-- first form end -->

            <!-- script form add by ajax dynamically -->
            <script id="hidden-template" type="text/html">
                <div class="script-form formulation-div" id="second-pharmacy">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="vName">Name</label>
                                <input type="text" class="form-control" id="vName" placeholder="Enter name" name="vName_{0}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="vEmail" placeholder="Enter city" name="vEmail_{0}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="vCity">City</label>
                                <input type="text" class="form-control" id="vCity" placeholder="Enter name" name="vCity_{0}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex justify-content-end">
                                <a href="javascript:void(0)" class="remove-form" title="Delete" style="color:red; font-size:30px;" ><i class="fa fa-trash"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
                
            </script>


            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>

</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">
    var formulation_count = $("#total_count").val();

    // add form on click of add more button
    $(document).on("click", ".add_more_btn", function() {

        var template = jQuery.validator.format(
            $.trim($("#hidden-template").html())
        );

        $(template(formulation_count)).insertAfter($(".formulation-div").last());
        formulation_count++;
        $("#total_count").val(formulation_count);
    });


    // delete the form on click of delete button
    $(document).on("click", ".remove-form", function() {
        $(this).parent().parent().parent().remove();
        formulation_count--;
        $("#total_count").val(formulation_count);
    });
</script>