
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title><?php echo $head_title;?> - Short a link.</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://unpkg.com/@adminkit/core@latest/dist/css/app.css">

	<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: Kanit !important;
        }
    </style>
    <script src="https://unpkg.com/@adminkit/core@latest/dist/js/app.js"></script>

</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
                    <span class="align-middle">Short a link!</span>
                </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="<?php echo site_url('/backoffice/dashboard');?>">
                            <i class="align-middle" data-feather="box"></i> <span class="align-middle">Dashboard</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="<?php echo site_url('/backoffice/profile');?>">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                        </a>
					</li>

                    <li class="sidebar-header">
						Link
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="<?php echo site_url('/backoffice/link');?>">
                            <i class="align-middle" data-feather="link"></i> <span class="align-middle">All links</span>
                        </a>
					</li>

                    <li class="sidebar-item">
						<a class="sidebar-link" href="<?php echo site_url('/backoffice/link?new');?>">
                            <i class="align-middle" data-feather="plus-square"></i> <span class="align-middle">Create new link</span>
                        </a>
					</li>

                    <li class="sidebar-header">
						Administrator
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="<?php echo site_url('/backoffice/admin/users');?>">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Users</span>
                        </a>
					</li>
					
				</ul>

				
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <!-- <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" />  -->
                                <span class="text-dark"><?php echo $userdata['email_address'];?></span>
                            </a>
                            
							<div class="dropdown-menu dropdown-menu-end">
								<!-- <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a> -->
                                <a class="dropdown-item" href="#">Last Login: <?php echo $userdata['updated_at'];?></a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?php echo site_url('/backoffice/logout');?>">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>



            