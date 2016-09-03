

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

 <head>
    
  <meta name="description" content="free website template" />
  <meta name="keywords" content="enter your keywords here" />
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  
  <!--Load style.css file , witch store in css folder -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.css"></link>
  <!--Load jquery.min.js file, which store in js folder.-->
  <script type='text/javascript' src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
  <!--Load image_slide.js file, which store in js folder.-->
  <script type='text/javascript' src="<?php echo base_url(); ?>public/js/image_slide.js"></script>

<!------  dizajn forme  -------------------------------------------->
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/forma/css/style.css"></link>
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/forma/scss/style.scss"></link>
  






 <!--          
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/image_slide.js"></script>
-->
</head>

<body>   
 <div id="main"> 
    <div id="header">
      <div id="welcome">
	    <h1>YOUR <span>BUSINESS</span></h1>
	  </div><!--end welcome-->
      <div id="menubar">
        <ul id="menu">
          <li class="current"><a href="<?=site_url('home/index')?>">Home</a></li>
          <li><a href="<?=site_url('api/yourwork')?>">Your Work</a></li>
          <li><a href="<?=site_url('api/projects')?>">Projects</a></li>
          <li><a href="<?=site_url('home/login')?>">Login</a></li>
          <li><a href="<?=site_url('home/register')?>">Register</a></li>
          <li><a href="<?=site_url('user/logout')?>">Logout</a></li>
        </ul>
      </div><!--end menubar-->
    </div><!--end header-->
    