<style>
  .cookies_outer {
    background-color: black;
    border-radius: 7px;

    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    /* background-color: red; */
    /* color: white; */
    text-align: center;
  }

  p {
    color: white;
  }
</style>
<?php if ($this->session->is_admin == null) : ?>
  <div class="cookies_outer" id="cookies_inner">
    <div class="d-flex flex-wrap justify-content-center align-items-center cookies-inner">
      <p>
        We use cookies to ensure that you get the best experience on our website. By using this site, you agree to our use of cookies.
        <a href="<?= base_url('patient/privacy-policy') ?>" title="Learn More" class="learn-more" target="_blank">Learn More</a>
        <button class="btn accept-cookies-btn btn-primary" id="accept_cookies" title="I Accept">I Accept</button>
      </p>

    </div>
  </div>
<?php endif; ?>
<script src="<?= base_url('assets/admin/dist/js/general.js') ?>"></script>
<script src="<?= base_url('assets/admin/dist/js/jquery.multi-select.js')  ?>" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/js/bootstrap-multiselect.min.js" type="text/javascript"></script>

<script src="<?= base_url('assets/admin/plugin/select2/js/select2.full.min.js') ?>"></script>

<!-- Footer -->
<footer class="page-footer font-small cyan darken-3">

  <!-- Footer Elements -->
  <div class="container">

    <!-- Grid row-->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-12 py-5">
        <div class="mb-5 flex-center">

          <!-- Facebook -->
          <!-- <a class="fb-ic">
            <i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a> -->
          <!-- Twitter -->
          <!-- <a class="tw-ic">
            <i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a> -->
          <!-- Google +-->
          <!-- <a class="gplus-ic">
            <i class="fab fa-google-plus-g fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a> -->
          <!--Linkedin -->
          <!-- <a class="li-ic">
            <i class="fab fa-linkedin-in fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a> -->
          <!--Instagram-->
          <!-- <a class="ins-ic">
            <i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a> -->
          <!--Pinterest-->
          <!-- <a class="pin-ic">
            <i class="fab fa-pinterest fa-lg white-text fa-2x"> </i>
          </a> -->
        </div>
      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row-->

  </div>
  <!-- Footer Elements -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="https://mdbootstrap.com/"> MDBootstrap.com</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
</body>

</html>

<script>

  $("#accept_cookies").click(function() {
    sessionStorage.setItem('acceptCookies', 'yes');
    $('#cookies_inner').hide();
  });

  if (sessionStorage.getItem('acceptCookies') == 'yes') {
    $("#cookies_inner").hide();
  } else {
    $("#cookies_inner").show();
  }
</script>