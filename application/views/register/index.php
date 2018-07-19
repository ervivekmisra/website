<div class="container">

    <div class="row">

    <div class="col-md-8 center-block-e">





      <div class="login-form register_form_outer">

      	<div class="login-form-inner">

 		<p class="login-form-intro"><img src="<?php echo base_url() ?>images/ava2.png" width="100"></p>





		<?php if(!empty($fail)) : ?>

			<div class="alert alert-danger"><?php echo $fail ?></div>

		<?php endif; ?>



    		<?php echo form_open(site_url("register"), array("id" => "register_form")) ?>
    			<div class="row">
    				<div class="col-md-6">
						<div class="form-group login-form-area has-feedback">

							<input type="text" class="form-control" name="email" placeholder="<?php echo lang("ctn_214") ?>" id="email" value="<?php if(isset($email)) echo $email; ?>">

				            <i class="glyphicon glyphicon-envelope form-control-feedback login-icon-color" id="login-icon-email"></i>

				        </div>
			    	</div>
			    	<div class="col-md-6">
				        <div class="form-group login-form-area has-feedback">

							<input type="text" class="form-control" name="username" id="username" placeholder="<?php echo lang("ctn_215") ?>" value="<?php if(isset($username)) echo $username; ?>">

				            <i class="glyphicon glyphicon-user form-control-feedback login-icon-color" id="login-icon-username"></i>

				        </div>
				    </div>
				    <div class="col-md-6">
				        <div class="form-group login-form-area has-feedback">

							<input type="password" class="form-control" name="password" placeholder="<?php echo lang("ctn_216") ?>">

				            <i class="glyphicon glyphicon-lock form-control-feedback login-icon-color"></i>

				        </div>
				    </div>
				    <div class="col-md-6">
				        <div class="form-group login-form-area has-feedback">

							<input type="password" class="form-control" name="password2" placeholder="<?php echo lang("ctn_217") ?>">

				            <i class="glyphicon glyphicon-lock form-control-feedback login-icon-color"></i>

				        </div>
				    </div>
				    <div class="col-md-6">
				        <div class="form-group login-form-area has-feedback">

							<input type="text" class="form-control" name="first_name" placeholder="<?php echo lang("ctn_29") ?>">

				            <i class="glyphicon glyphicon-user form-control-feedback login-icon-color"></i>

				        </div>
				    </div>
				    <div class="col-md-6">
				        <div class="form-group login-form-area has-feedback">

							<input type="text" class="form-control" name="last_name" placeholder="<?php echo lang("ctn_30") ?>">

				            <i class="glyphicon glyphicon-user form-control-feedback login-icon-color"></i>

				        </div>
				    </div>

                    <div class="col-md-6">
                        <div class="form-group login-form-area has-feedback clearfix">
                                <select name="user_role" id= "user_role" class="form-control" required
                                        oninvalid="this.setCustomValidity('Please select the User role')"
                                        oninput="setCustomValidity('')">
                                    <option value="" disabled selected>Select Role...</option>
                                    <?php foreach($fields->result() as $r) : ?>
                                        <option value="<?php echo $r->ID ?>" <?php if ($user_role == $r->ID ) echo 'selected' ?> >
                                            <?php echo $r->name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                        </div>
                    </div>


					<div class="col-md-6">
					  	<?php if(!$this->settings->info->disable_captcha) : ?>

				  		<div class="form-group login-form-area">

						    	<p><?php echo $cap['image'] ?></p>

								<input type="text" class="form-control" id="captcha-in" name="captcha" placeholder="<?php echo lang("ctn_306") ?>" value="">

						</div>

				  		<?php endif; ?>
			  		</div>

			  		<div class="col-md-6">
				  		<?php if($this->settings->info->google_recaptcha) : ?>

				  			<div class="form-group login-form-area">

						    <div class="g-recaptcha" data-sitekey="<?php echo $this->settings->info->google_recaptcha_key ?>"></div>

				  		</div>

		  				<?php endif ?>
		  			</div>
		  			<div class="col-md-12">
		  				<div class="form-group login-form-area has-feedback term_con">

				            <div class="checkbox">
				              <label><input type="checkbox" required id="agree_check"
                                            oninvalid="this.setCustomValidity('Please check the Terms and Conditions')"
                                            oninput="setCustomValidity('')"> <a href="https://surfcloud.com/terms.php">I Agree with Terms and Conditions</a></label>
				            </div>

				        </div>
		  			</div>
		  		</div>




		  		<input type="submit" name="s" id="btn_submit" class="btn btn-flat-login form-control" value="<?php echo lang("ctn_221") ?>" />



		  		<hr>



		  			<p><?php echo lang("ctn_222") ?></p>

		  		</div>





		  		<div class="login-form-bottom">







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



		  		<p class="decent-margin align-center"><a href="<?php echo site_url("login") ?>">Back To Login</a></p>



		  	<?php echo form_close() ?>

		  </div>

</div>



</div>

</div>

</div>

<script type="text/javascript">

  $(document).ready(function() {

    var form = "register_form";

    $('#'+form + ' input').on("focus", function(e) {

      clearerrors();

    });



    $('#username').on("change", function() {

    	$.ajax({

	        url : global_base_url + "register/check_username",

	        type : 'GET',

	        data : {

	          username : $(this).val(),

	        },

	        dataType: 'JSON',

	        success: function(data) {

	        	if(data.success) {

	        		$("#login-icon-username").css("color", "green");

	        	} else {

	        		$("#login-icon-username").css("color", "#a0a0a0");

	        		if(data.field_errors) {

			            var errors = data.fieldErrors;

			            for (var property in errors) {

			                if (errors.hasOwnProperty(property)) {

			                    // Find form name

			                    var field_name = '#' + form + ' input[name="'+property+'"]';

			                    $(field_name).addClass("errorField");

			                    if(errors[property]) {

				                    // Get input group of field

				                    $(field_name).parent().closest('.form-group').after('<div class="form-error-no-margin">'+errors[property]+'</div>');

				                }





			                }

			            }

			          }

	        	}

	        }

	    });

    });



    $('#email').on("change", function() {

    	$.ajax({

	        url : global_base_url + "register/check_email",

	        type : 'GET',

	        data : {

	          email : $(this).val(),

	        },

	        dataType: 'JSON',

	        success: function(data) {

	        	if(data.success) {

	        		$("#login-icon-email").css("color", "green");

	        	} else {

	        		$("#login-icon-email").css("color", "#a0a0a0");

	        		if(data.field_errors) {

			            var errors = data.fieldErrors;

			            for (var property in errors) {

			                if (errors.hasOwnProperty(property)) {

			                    // Find form name

			                    var field_name = '#' + form + ' input[name="'+property+'"]';

			                    $(field_name).addClass("errorField");

			                    if(errors[property]) {

				                    // Get input group of field

				                    $(field_name).parent().closest('.form-group').after('<div class="form-error-no-margin">'+errors[property]+'</div>');

				                }





			                }

			            }

			          }

	        	}

	        }

	    });

    });

    // $('#agree_check').click(function() {
    //     if (!$(this).is(':checked')) {
    //         $('#btn_submit').prop('disabled', true);
    //     }
    //     else {
    //         $('#btn_submit').prop('disabled', false);
    //     }
    //
    //   });

      // $('#agree_check').click(function(e){
      //     alert("click");
      //     if ( $('#myCheckbox').attr('checked')) {
      //         $('#myCheckbox').attr('checked', false);
      //         $('#btn_submit').removeAttr("disabled");
      //     } else {
      //         $('#myCheckbox').attr('checked', 'checked');
      //         $('#btn_submit').attr("disabled", "":"disabled");
      //     }
      //
      // });

      $('#'+form).on("submit", function(e) {

// // allow form submit
//           if($("#user_role").val() == null || $("#user_role").val() == 0)
//               alert("Please select user role.")
//           else

          //alert('check');
          e.preventDefault();

          // Ajax check

          var data = $(this).serialize();

          $.ajax({

              url : global_base_url + "register/ajax_check_register",

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


                          $('#'+form).unbind('submit').submit();

                  }

                  if(data.field_errors) {

                      var errors = data.fieldErrors;

                      for (var property in errors) {

                          if (errors.hasOwnProperty(property)) {

                              // Find form name

                              var field_name = '#' + form + ' input[name="'+property+'"]';

                              $(field_name).addClass("errorField");

                              if(errors[property]) {

                                  // Get input group of field

                                  $(field_name).parent().closest('.form-group').after('<div class="form-error-no-margin">'+errors[property]+'</div>');

                              }





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

    $('.form-error-no-margin').remove();

    $('.errorField').removeClass('errorField');

  }

</script>