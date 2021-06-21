<html>
    <head>
        <title>Login</title>
        <link rel="shortcut icon" type="image/png" href="<?php echo base_url()?>assets/logo/logo.png"/>
	    <meta charset="utf-8">
    <head>
    <body>
        <div align="center">
            <h2> Login Now </h2>
            <?php if($this->session->flashdata('success_signup')):?>
                <?php echo $this->session->flashdata('success_signup')?>
            <?php endif; ?>
            <?php if($this->session->flashdata('fail_login')):?>
                <?php echo $this->session->flashdata('fail_login')?>
            <?php endif; ?>
            <?php if($this->session->flashdata('not_logged_in')):?>
                <?php echo $this->session->flashdata('not_logged_in')?>
            <?php endif; ?>
            <?php echo form_open_multipart(base_url() . 'index.php/welcome/checking_login')?>
                <table>
                    <tr>
                        <td><label for="username"> Username: </label></td>
                        <td><input type="text" id="username" name="username" minlength="2" maxlength="50"></td>
                    </tr>
                    <tr>
                        <td><label for="password"> Password: </label></td>
                        <td><input type="password" id="password" name="password" minlength="2" maxlength="50"></td>
                    </tr>
                    <tr>
                        <td><label for="roles">Roles: </label>
                        <td>
                            <select id="roles" name="roles">
                                <option value="" disabled selected>Login as:</option>
                                <option value="1">Editor</option>
                                <option value="2">Reviewer</option>
                                <option value="3">Makelar</option>
                            
                        </td>
                    </tr>
                </table> <br>
            <input type="submit" value="Login">
            </form>
            <p> Don't have an account? <a href="<?php echo base_url() . 'index.php/welcome/sign_up'?>">Register!</a></p>
        </div>
    </body>
</html>