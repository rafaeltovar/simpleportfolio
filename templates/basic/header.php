<!DOCTYPE html>
<html>
  <head>
  	<title><?php echo get_title_head(); ?></title>
    <meta name="description" content="<?php echo get_title_head(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo get_template_url(); ?>/bootstrap3/css/bootstrap.min.css" rel="stylesheet" media="screen">
    
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
    <link href="<?php echo get_template_url(); ?>/css/main.css" rel="stylesheet" media="screen">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo get_template_url(); ?>/bootstrap3/assets/js/html5shiv.js"></script>
      <script src="<?php echo get_template_url(); ?>/bootstrap3/assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
  <?php get_menu(); ?>