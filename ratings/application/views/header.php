<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Rating Stars</title>
   <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
  <style>

</style>
</head>
<body>
  <nav class="top-bar">
      <div class="container">
        <div class="row">
        <div class="col-sm-4 hidden-xs">
            <span class="nav-text">
                <i class="fa fa-phone" aria-hidden="true"></i>  +000 0000 0000 
                <i class="fa fa-envelope" aria-hidden="true"></i> xxxxxx@xxxxx.com</span>
            </div>
        <div class="col-sm-4 text-center">
            <a href="#" class="social"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            
            </div>
        <div class="col-sm-4 text-right hidden-xs">
                <ul class="tools">                    
                <li class="dropdown">
                 <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-globe" aria-hidden="true"></i> Language<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Russian</a></li>
                      <li><a href="#">French</a></li>
                      <li><a href="#">Mandarin</a></li>
                      <li><a href="#">Italian</a></li>
                      <li><a href="#">Gorgean</a></li>
                  </ul>
                </li>
                    
                <li class="dropdown">
                 <a class="" href="#"><i class="fa fa-user" aria-hidden="true"></i> My Account</a>                  
                </li>
                    
                                 
                </ul>
              </div>
        </div>
      </div>
    </nav>   <!--TOP-NAVBAR-END-->
    
    
<!--====================== NAVBAR MENU START===================-->
    
  
<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"><img src="http://www.minhasondas.com//images/logo.png"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-left">
        <li class=""><a href="#">Home</a></li>
		<li><a href="#">blog</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">gallery <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Page 1-1</a></li>
            <li><a href="#">Page 1-2</a></li>
            <li><a href="#">Page 1-3</a></li>
          </ul>
        </li>
        
        <li><a href="" data-toggle="modal" data-target="#myModal">Login</a></li>
		<li><a href="" data-toggle="modal" data-target="#regmodal">Register</a></li>
      </ul>
      <form class="navbar-form navbar-right">
      <div class="input-group">        
        <div class="input-group-btn">
          <button class="btn btn-default-1" type="submit">
            <i class="glyphicon glyphicon-search"></i>
          </button>
        </div>
		<input type="text" class="form-control" placeholder="Search">
      </div>
          
   
    </form>
        
    </div>
  </div>
</nav>



<div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <?php if (validation_errors()) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= validation_errors() ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if (isset($error)) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= $error ?>
				</div>
			</div>
		<?php endif; ?>
		
			
			<?= form_open() ?>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" id="username" name="username" placeholder="Your username">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Your password">
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-default" value="Login">
				</div>
			</form>
		
        </div>
        <div class="modal-footer">
          
          <p>Not a member? <a href="#">Sign Up</a></p>
          <p>Forgot <a href="#">Password?</a></p>
        </div>
     
        </div>
    </div>
  </div> 
  <!--Register modal-->
  
  <div class="modal fade" id="regmodal" role="dialog">
   <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Register</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <?php if (validation_errors()) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= validation_errors() ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if (isset($error)) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= $error ?>
				</div>
			</div>
		<?php endif; ?>
		
			
			<?//echo form_open( site_uri( $this->uri->uri_string() ) ) ;?>
			<form id="regform">
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" id="username" name="username" placeholder="Enter a username minimum  4 characters">
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
					
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Enter a password">
					
				</div>
				<div class="form-group">
					<label for="password_confirm">Confirm password</label>
					<input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirm your password">
					
				</div>
				<div class="form-group">
					<input type="submit" id="regbtn" class="btn btn-default" value="Register">
				</div>
			</form>
		
        </div>
        <div class="modal-footer">
          
          <p>Not a member? <a href="#">Sign Up</a></p>
          <p>Forgot <a href="#">Password?</a></p>
        </div>
     
        </div>
    </div>
  </div> 