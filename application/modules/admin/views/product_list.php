<div class="container">
<br><br><br>
<div class="row" style="margin-bottom: 30px;">
  <div class="col-lg-12"  >  
  <a href="<?= base_url('admin/home/logout'); ?>" class="btn btn-danger" style="float: right;">Logout</a>
  </div>
</div>
<div class="row">
<div class="col-md-4">
<figure class="card card-product">
<div class="img-wrap"><img src="//www.tutsmake.com/wp-content/uploads/2019/03/c05917807.png" width="200px" height="200px"></div>
<figcaption class="info-wrap">
<h4 class="title">Mouse</h4>
<p class="desc">Some small description goes here</p>
<div class="rating-wrap">
<div class="label-rating">132 reviews</div>
<div class="label-rating">154 orders </div>
</div> <!-- rating-wrap.// -->
</figcaption>
<div class="bottom-wrap">
<a href="javascript:void(0)" class="btn btn-sm btn-primary float-right buy_now" data-amount="1000" data-id="1">Order Now</a> 
<div class="price-wrap h5">
<span class="price-new">₹1000</span> <del class="price-old">₹1200</del>
</div> <!-- price-wrap.// -->
</div> <!-- bottom-wrap.// -->
</figure>
</div> <!-- col // -->
<div class="col-md-4">
<figure class="card card-product">
<div class="img-wrap"><img src="//www.tutsmake.com/wp-content/uploads/2019/03/vvjghg.png" width="200px" height="200px" > </div>
<figcaption class="info-wrap">
<h4 class="title">Sony Watch</h4>
<p class="desc">Some small description goes here</p>
<div class="rating-wrap">
<div class="label-rating">132 reviews</div>
<div class="label-rating">154 orders </div>
</div> <!-- rating-wrap.// -->
</figcaption>
<div class="bottom-wrap">
<a href="javascript:void(0)" class="btn btn-sm btn-primary float-right buy_now" data-amount="1280" data-id="2">Order Now</a> 
<div class="price-wrap h5">
<span class="price-new">₹1280</span> <del class="price-old">₹1400</del>
</div> <!-- price-wrap.// -->
</div> <!-- bottom-wrap.// -->
</figure>
</div> <!-- col // -->
<div class="col-md-4">
<figure class="card card-product">
<div class="img-wrap"><img src="//www.tutsmake.com/wp-content/uploads/2019/03/jhgjhgjg.jpg" width="200px" height="200px"></div>
<figcaption class="info-wrap">
<h4 class="title">Mobile</h4>
<p class="desc">Some small description goes here</p>
<div class="rating-wrap">
<div class="label-rating">132 reviews</div>
<div class="label-rating">154 orders </div>
</div> <!-- rating-wrap.// -->
</figcaption>
<div class="bottom-wrap">
<a href="javascript:void(0)" class="btn btn-sm btn-primary float-right buy_now" data-amount="1280" data-id="3">Order Now</a> 
<div class="price-wrap h5">
<span class="price-new">₹1500</span> <del class="price-old">₹1980</del>
</div> <!-- price-wrap.// -->
</div> <!-- bottom-wrap.// -->
</figure>
</div> <!-- col // -->
</div> <!-- row.// -->
</div> 
	
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var SITEURL = "<?php echo base_url() ?>";
$('body').on('click', '.buy_now', function(e){
var totalAmount = $(this).attr("data-amount");
var product_id =  $(this).attr("data-id");
var options = {
"key": "rzp_test_5eJu4eP0EYBioU",
"amount": (totalAmount*100), // 2000 paise = INR 20
"name": "Tutsmake",
"description": "Payment",
"image": "//www.tutsmake.com/wp-content/uploads/2018/12/cropped-favicon-1024-1-180x180.png",
"handler": function (response){
$.ajax({
url: '<?php echo base_url() ?>' + 'admin/payment/razor_payment_success',
type: 'post',
dataType: 'json',
data: {
razorpay_payment_id: response.razorpay_payment_id , totalAmount : totalAmount ,product_id : product_id,
}, 
success: function (msg) {
window.location.href = '<?php echo base_url() ?>' + 'admin/payment/razor_payment_thankyou';
}
});
},
"theme": {
"color": "#528FF0"
}
};
var rzp1 = new Razorpay(options);
rzp1.open();
e.preventDefault();
 
});
</script>