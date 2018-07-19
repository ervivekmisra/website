    <div class="gallery_kenburns">

        <canvas id="kenburns">

            <p>Your browser doesn't support canvas!</p>

        </canvas>

    </div>

	

<div class="container">

    <div class="row">

    <div class="col-md-5 center-block-e">



      



      <div class="login-form">



        <div class="login-form-inner">

        <?php $gl = $this->session->flashdata('globalmsg'); ?>

        <?php if(!empty($gl)) :?>

          <div class="alert alert-success"><b><span class="glyphicon glyphicon-ok"></span></b> <?php echo $this->session->flashdata('globalmsg') ?></div> 

        <?php endif; ?>

        <p class="login-form-intro"><img src="<?php echo base_url() ?>images/ava2.png" width="100"></p>

        <?php if(isset($_GET['redirect'])) : ?>

        <?php echo form_open(site_url("login/pro/" . urlencode($_GET['redirect'])), array("id" => "login_form")) ?>

        <?php else : ?>

        <?php echo form_open(site_url("login/pro"), array("id" => "login_form")) ?>

        <?php endif; ?>

        <div class="form-group login-form-area has-feedback">

          <input type="text" class="form-control" name="email" placeholder="<?php echo lang("ctn_303") ?>">

          <i class="glyphicon glyphicon-user form-control-feedback login-icon-color"></i>

        </div>



        <div class="form-group login-form-area has-feedback">

          <input type="password" name="pass" class="form-control" placeholder="*********">

          <i class="glyphicon glyphicon-lock form-control-feedback login-icon-color"></i>

        </div>
        <div class="form-group login-form-area has-feedback term_con">

            <div class="checkbox">
              <label><input type="checkbox" checked required oninvalid="this.setCustomValidity('Please check the Terms and Conditions')"
                            oninput="setCustomValidity('')"> <a href="https://surfcloud.com/terms.php">I agree with Terms and Conditions</a></label>
            </div>

        </div>



        <p><input type="submit" class="btn btn-flat-login form-control" value="<?php echo lang("ctn_184") ?>"></p>

        <p class="decent-margin small-text"><a href="<?php echo site_url("login/forgotpw") ?>"><?php echo lang("ctn_181") ?></a> <span class="pull-right"><a href="<?php echo site_url("register") ?>"><?php echo lang("ctn_151") ?></a></span></p>

      </div>

     <? /* <div class="login-form-bottom clearfix">

          <?php if(!$this->settings->info->disable_social_login) : ?>

          <div class="text-center decent-margin-top">

          <?php if(!empty($this->settings->info->twitter_consumer_key) && !empty($this->settings->info->twitter_consumer_secret)) : ?>

          <div class="btn-group">

            <a href="<?php echo site_url("login/twitter_login") ?>" class="btn btn-flat-social-twitter" >

              <img src="<?php echo base_url() ?>images/social/twitter.png" height="20" class='social-icon' />

             Twitter</a>

          </div>

          <?php endif; ?>

          <?php if(!empty($this->settings->info->facebook_app_id) && !empty($this->settings->info->facebook_app_secret)) : ?>

          <div class="btn-group">

            <a href="<?php echo site_url("login/facebook_login") ?>" class="btn btn-flat-social-facebook" >

              <img src="<?php echo base_url() ?>images/social/facebook.png" height="20" class='social-icon' />

             Facebook</a>

          </div>

          <?php endif; ?>



          <?php if(!empty($this->settings->info->google_client_id) && !empty($this->settings->info->google_client_secret)) : ?>

          <div class="btn-group">

            <a href="<?php echo site_url("login/google_login") ?>" class="btn btn-flat-social-google" >

              <img src="<?php echo base_url() ?>images/social/google.png" height="20" class='social-icon' />

             Google</a>

          </div>

          <?php endif; ?>

          </div>

          <?php endif; ?>

          <hr> 

          <?php echo form_close() ?>

      </div>

	  */ ?>





      </div>





</div>

</div>

</div>



<div class="login-footer">



</div>



<script type="text/javascript">

  $(document).ready(function() {

    var form = "login_form";

    $('#'+form + ' input').on("focus", function(e) {

      clearerrors();

    });

    $('#'+form).on("submit", function(e) {



      e.preventDefault();

      // Ajax check

      var data = $(this).serialize();

      $.ajax({

        url : global_base_url + "login/ajax_check_login",

        type : 'POST',

        data : {

          formData : data,

          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash() ?>'

        },

        dataType: 'JSON',

        success: function(data) {

          if(data.error) {

            $('#'+form).prepend('<div class="form-error">'+data.error_msg+'</div>');

          }

          if(data.success) {

            // allow form submit

            $('#'+form+ ' input[type="submit"]').val("<?php echo lang("ctn_744") ?> ...");

            $('#'+form).unbind('submit').submit();

          }

          if(data.field_errors) {

            var errors = data.fieldErrors;

            console.log(errors);

            for (var property in errors) {

                if (errors.hasOwnProperty(property)) {

                    // Find form name

                    var field_name = '#' + form + ' input[name="'+property+'"]';

                    $(field_name).addClass("errorField");

                    // Get input group of field

                    $('#'+form).prepend('<div class="form-error">'+errors[property]+'</div>');

                    



                }

            }

          }

        }

      });



      return false;





    });

  });



  function clearerrors() 

  {

    console.log("Called");

    $('.form-error').remove();

    $('.errorField').removeClass('errorField');

  }

</script>



 



    <script type="text/javascript" src="/scripts/libraries/kenburns.js"></script>

    <script type="text/javascript" src="/scripts/custom/theme.js"></script>

    

    <script>

        "use strict";

        

        var gallery_set = [

            "/images/kenburns/1.jpg",

            "/images/kenburns/2.jpg",

            "/images/kenburns/3.jpg",

            "/images/kenburns/4.jpg",

            "/images/kenburns/5.jpg",

        ]

        

		jQuery(document).ready(function(){

			jQuery('.custom_bg').remove();

			jQuery('#kenburns').attr('width', myWindow.width());

			jQuery('#kenburns').attr('height', myWindow.height());

			jQuery('#kenburns').css('top', '0px');

			jQuery('#kenburns').remove();

			setTimeout('kenburns_resize()',150);

		});

	

		function kenburns_resize() {

			jQuery('.gallery_kenburns').append('<canvas id="kenburns"><p>Your browser does not support canvas!</p></canvas>');

			jQuery('#kenburns').attr('width', myWindow.width());

			jQuery('#kenburns').attr('height', myWindow.height());

				jQuery('#kenburns').kenburns({

					images: gallery_set,

					frames_per_second: 30,

					display_time: 5000,

					fade_time: 1000,

					zoom: 1.2,

					background_color:'#000000'

				});				

				jQuery('#kenburns').css('top', '0px');

		}

		jQuery(window).resize(function(){ 

			jQuery('#kenburns').remove();

			setTimeout('kenburns_resize()',300);

		});							

    </script>