<body>
<section id="featured" class="bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
					<?php echo form_open_multipart(base_url() . 'index.php/welcome/signing_up')?>
					  <div class="text-center">
						<h2>Sign Up</h2>
					  </div>
						<?php if($this->session->flashdata('fail_signup')):?>
							<div class="alert alert-danger"><?php echo $this->session->flashdata('fail_signup'); ?></div>
						<?php endif;?>
						<?php if($this->session->flashdata('fail_photo')):?>
							<div class="alert alert-danger"><?php echo $this->session->flashdata('fail_photo'); ?></div>
						<?php endif;?>
						<hr class="colorgraph">
						<div class="form-group">
							<input type="text" id="nama" name="nama" width="50" class="form-control input-lg" placeholder="Input your name" required>
						</div>
						<div class="form-group">
							<input type="text" id="username" name="username" minlength="2" maxlength="50" class="form-control input-lg" placeholder="Input your username" required>
						</div>
						<div class="form-group">
							<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" required>
						</div>
						<div class="form-group">
							<input type="password" id="password" name="password" width="50"class="form-control input-lg" placeholder="Password" required>
						</div>
						<div class="form-group">
							<label for="roles">Roles:</p>
								<input type="checkbox" id="editor" name="roles[]" value="1"> Editor
								<input type="checkbox" id="reviewer" name="roles[]" value="2"> Reviewer
						</div>
						<div class="form-group">
							<label for="photo">Photo:</label>
							<input type="file" id="userfile" name="userfile">
						</div>	
						<hr class="colorgraph">
						<div class="form-group">
							<input type="submit" value="Register" class="btn btn-primary btn-block btn-lg">
						</div>
						<div class="form-group">
							<div class="text-center">
								<p>Already have an account? <a href="<?php echo base_url() . 'index.php/welcome/login' ?>">Login</a></p>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

    
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
</body>
</html>