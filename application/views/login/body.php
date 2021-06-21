<body>
  <section id="featured" class="bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <?php echo form_open_multipart(base_url() . 'index.php/welcome/checking_login')?>
              <div class="text-center">
            <h2>Login</h2>
              </div>
            <?php if($this->session->flashdata('success_signup')):?>
              <div class="alert alert-success"><?php echo $this->session->flashdata('success_signup'); ?></div>
            <?php endif;?>
            <?php if($this->session->flashdata('fail_login')):?>
              <div class="alert alert-danger"><?php echo $this->session->flashdata('fail_login'); ?></div>
            <?php endif;?>
            <?php if($this->session->flashdata('not_logged_in')):?>
              <div class="alert alert-danger"><?php echo $this->session->flashdata('not_logged_in'); ?></div>
            <?php endif;?>
            <hr class="colorgraph">
            <div class="form-group">
              <input type="text" id="username" name="username" minlength="2" maxlength="50" class="form-control input-lg" placeholder="Username" required>
            </div>
            <div class="form-group">
              <input type="password" id="password" name="password" minlength="2" maxlength="50" class="form-control input-lg" placeholder="Password" required>
            </div>
            <div class="form-group">
              <label for="roles">Roles: </label>
              <select id="roles" name="roles">
                  <option value="" disabled selected>Login as:</option>
                  <option value="1">Editor</option>
                  <option value="2">Reviewer</option>
                  <option value="3">Makelar</option>
              </select>
          </div>
            <hr class="colorgraph">
              <div class="form-group">
                <div class="aligncenter">
                  <input type="submit" value="Login" class="btn btn-primary btn-block btn-lg">
                </div>
              </div>
            <div class="form-group">
              <div class="aligncenter">
                <p> Don't have an account? <a href="<?php echo base_url() . 'index.php/welcome/sign_up'?>">Sign Up!</a></p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
</body>
</html>