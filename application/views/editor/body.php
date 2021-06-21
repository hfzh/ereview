<body>
	<section id="featured" class="bg">

	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="text-center">
					<h1> Editor Home </h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="aligncenter">
					<img src="<?php echo base_url() . 'photos/' . $profile[0]['photo'] ;?>" class="img-responsive">
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<h5> Your Profile </h5>
						<p> Nama: <?php echo $profile[0]['nama']?></p>
						<p> Email: <?php echo $profile[0]['email']?></p>
						<p> Username: <?php echo $profile[0]['username']?></p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="solidline">
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="aligncenter">
						<a href="<?php echo base_url() . 'index.php/managemytask/add_new_task' ?>" class="btn btn-primary btn-large btn-rounded">First time logged in? Make your first task!</a>
					</div>
				</div>
			</div>
		</div>
	</div>	

</body>
</section>
    
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>

<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>