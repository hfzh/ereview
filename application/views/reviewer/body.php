<body>
	<section id="featured" class="bg">

	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="text-center">
					<h1> Reviewer Home </h1>
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
						<p> Balance : Rp<?php echo $profile[0]['balance']?></p>
						<hr class="colorgraph">
						<h5> Additional Profile Information </h5>
						<?php if($this->session->flashdata('success_edit')):?>
							<div class="alert alert-success"><?php echo $this->session->flashdata('success_edit');?></div>
						<?php endif;?>
						<p> Proffesionality : <?php echo $profile[0]['bidang_ahli']?></p>
						<p> Bank Account Number: <?php echo $profile[0]['no_rek']?></p>
						<p> Bank Name: <?php echo $profile[0]['nama_bank']?></p>
						<div class="aligncenter">
							<a href="<?php echo base_url() . 'index.php/manageassignedtask/edit_additional' ?>" class="btn btn-primary btn-large btn-rounded">Edit your additional data!</a>
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
							<a href="<?php echo base_url() . 'index.php/manageassignedtask/confirm_task' ?>" class="btn btn-primary btn-large btn-rounded">See if there's task for you!</a>
						</div>
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