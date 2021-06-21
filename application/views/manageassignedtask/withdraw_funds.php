
<html>
    <body>
        <section id="featured" class="bg">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                        <?php echo form_open_multipart(base_url() . 'index.php/manageassignedtask/withdrawing_funds')?>
                          <div class="text-center">
                            <h2>Withdraw Funds</h2>
                          </div>
                            <?php if($this->session->flashdata('fail_max_withdraw')):?>
                                <div class="alert alert-danger"><?php echo $this->session->flashdata('fail_max_withdraw')?></div>
                            <?php endif;?>
                            <?php if($this->session->flashdata('fail_min_withdraw')):?>
                                <div class="alert alert-danger"><?php echo $this->session->flashdata('fail_min_withdraw')?></div>
                            <?php endif;?>
                            <?php if($this->session->flashdata('success_withdraw')):?>
                                <div class="alert alert-success"><?php echo $this->session->flashdata('success_withdraw')?></div>
                            <?php endif;?>
                            <hr class="colorgraph">
                            <p>Your Balance : Rp<?php echo $reviewer[0]['balance']; ?> </p>
                            <p>Bank Account Number : <?php echo $reviewer[0]['no_rek']; ?> </p>
                            <p>Bank Name : <?php echo $reviewer[0]['nama_bank']; ?> </p>
                            <label for="withdraw">Input amount that you want to withdraw: </label>
                            <input type="number" id="withdraw" name="withdraw" placeholder="Minimum amout to withdraw Rp10000"><br>
                            <hr class="colorgraph">
                            <div class="form-group">
                                <div class="aligncenter">
                                    <input type="submit" value="Withdraw Funds" class="btn btn-primary btn-block btn-lg">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>