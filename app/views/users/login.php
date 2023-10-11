<?php
   require APPROOT . '/views/includes/head.php';
?>

<body class="bgrd">
	<div class="container">
		<div class="row" style="margin-top: 50px;">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="container" style="height: 500px;">
					<div class="row">
						<!-- <div class="col-md-1"></div> -->
						<div class="col-md-6 text-center" style="height: 500px;">
							<img src="/public/img/avatar3.png" class="rounded animated flash" alt="image" style="width: auto; height: 100%;">
						</div>
						<div class="col-md-6">
                            <?php if(!empty($data['p_error'])): ?>
                                <div class="alert <?=(($data['t_error'] == 'error')?'alert-danger':'alert-success')?>" role="alert"> 
                                <i class="ti-bell"></i> 
                                    <b><?=$data['p_error'] ?></b>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                                    <span aria-hidden="true">&times;</span> </button>
                                </div>
                            <?php endif; ?>
							<div class="card img-fluid animated fadeInDown rounded" style="margin-top: 50px;">
							<div class="card-body">
								<h2 class="text-center text-danger animated bounce">Login Page
                                    <?php //echo password_hash('123456', PASSWORD_DEFAULT);?>
                                </h2><br>
								<form action="/users/login.php" method="post">
									<div class="field">
										<label for="username" class="text-danger"><i class="fa fa-user"></i> Username</label>
										<input type="text" name="username" class="form-control rounded" id="username">
									</div>
									<div class="field">
										<label for="password" class="text-danger"><i class="fa fa-lock"></i> Password</label>
										<input type="password" name="password" class="form-control rounded" id="password">
									</div>
									<div class="field">
										<label for="remember" class="text-danger">
											<input type="checkbox" name="remember" id="remember"> Remember me
										</label>
									</div><br><br>
									<button type="submit" class="btn btn-outline-danger rounded waves-effect" style="width: 100%;" >Log In</button>
								</form>
							</div>
						</div>
						<!-- <div class="col-md-1"></div> -->
					</div>
				</div>		
			</div>
			</div>
			<div class="col-md-2"></div>
			
	</div>
	

</body>
