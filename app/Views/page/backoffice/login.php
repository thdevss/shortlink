
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Sign In | Short a link.</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://unpkg.com/@adminkit/core@latest/dist/css/app.css">

	<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: Kanit !important;
        }
    </style>
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Short a link, backoffice</h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form method="post" action="?p">
                                        <?php if(session()->getFlashdata('msg')) : ?>
                                            <div class="mb-3">
                                                <div class="alert alert-warning"><?php echo session()->getFlashdata('msg'); ?></div>
                                            </div>
                                        <?php ;endif ?>
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" value="demo@14devlab.co" placeholder="Enter your email" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" value="Passw0rd" placeholder="Enter your password" />
										</div>
										
										<div class="text-center mt-3">
											<!-- <a href="index.html" class="btn btn-lg btn-primary">Sign in</a> -->
											<button type="submit" class="btn btn-lg btn-primary">Sign in</button>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="https://unpkg.com/@adminkit/core@latest/dist/js/app.js"></script>


</body>

</html>