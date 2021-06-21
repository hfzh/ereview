<body>
	<section id="featured" class="bg">

	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="text-center">
					<h1> Makelar Home </h1>
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
						<a href="<?php echo base_url() . 'index.php/managealltask/monitor_tasks' ?>" class="btn btn-primary btn-large btn-rounded">Monitor Tasks</a>
					</div>
				</div>
			</div>
		</div>
	</div>	

</body>
</section>
    
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>


</body>
</html>