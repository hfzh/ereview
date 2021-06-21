<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Makelar</title>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url()?>assets/logo/logo.png"/>
    <link rel="stylesheet" href="css/normalize.css">
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/main.css'?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Bootstrap 3 template for corporate business" />
    <meta name="author" content="http://iweb-studio.com" />
    <!-- css -->

    <link href="<?php echo base_url() . 'assets/css/bootstrap.min.css'?>" rel="stylesheet" />
    <link href="<?php echo base_url() . 'assets/plugins/flexslider/flexslider.css'?>" rel="stylesheet" media="screen" />	
    <link href="<?php echo base_url() . 'assets/css/cubeportfolio.min.css'?>" rel="stylesheet" />
    <link href="<?php echo base_url() . 'assets/css/style.css'?>" rel="stylesheet" />

    <!-- Theme skin -->
    <link id="t-colors" href="<?php echo base_url() . 'asset/skins/default.css'?>" rel="stylesheet" />

        <!-- boxed bg -->
        <link id="bodybg" href="<?php echo base_url() . 'asset/bodybg/bg1.css'?>" rel="stylesheet" type="<?php echo base_url() . 'assets/text/css'?>" />

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

</head>
<body>

<div id="wrapper">
	<!-- start header -->
	<header>		
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url() . 'index.php/manageassignedtask' ?>"><img src="<?php echo base_url() . 'assets/img/logo.png'?>" alt="" width="199" height="52" /></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class="dropdown active">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false"> Manage All Task <i class="fa fa-angle-down"></i> </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url() . 'index.php/managealltask/monitor_tasks' ?>">Monitor Tasks</a></li>
                                <li><a href="<?php echo base_url() . 'index.php/managealltask/monitor_payments' ?>">Monitor Payments</a></li>
                                <li><a href="<?php echo base_url() . 'index.php/managealltask/dump_editors' ?>">Dump Editors</a></li>
                                <li><a href="<?php echo base_url() . 'index.php/managealltask/dump_reviewers' ?>">Dump Reviewers</a></li>
                                <li><a href="<?php echo base_url() . 'index.php/managealltask/dump_tasks' ?>">Dump Tasks</a></li>
                            </ul>
						</li>
                        <li><a href="<?php echo base_url() . 'index.php/manageassignedtask' ?>">Home</a></li>
                        <li><a href="<?php echo base_url() . 'index.php/welcome/logout' ?>">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
	</header>