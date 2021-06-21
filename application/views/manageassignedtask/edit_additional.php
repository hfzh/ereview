<html>
	<body>
        <section id="featured" class="bg">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                        <?php echo form_open_multipart(base_url() . 'index.php/manageassignedtask/editing_additional')?>
                          <div class="text-center">
                            <h2> Edit Additional Data </h2>
                          </div>
                            <?php if($this->session->flashdata('fail_upload')):?>
                                <div class="alert alert-danger"><?php echo $this->session->flashdata('fail_upload')?></div>
                            <?php endif; ?>
                            <?php if($this->session->flashdata('success_submit')):?>
                                <div class="alert alert-success"><?php echo $this->session->flashdata('success_submit')?></div>
                            <?php endif; ?>
                            <hr class="colorgraph">
                            <div class="form-group">
                                <label for="bidang_ahli">Proffesionality</label>
                                <input type="text" id="bidang_ahli" name="bidang_ahli" minlength="2" maxlength="50" required class="form-control input-lg" value="<?php echo $profile[0]['bidang_ahli']?>">
                            </div>
                            <div class="form-group">
                                <label for="no_rek">Bank Account Number</label>
                                <input type="number" id="no_rek" name="no_rek" minlength="2" maxlength="50" required class="form-control input-lg"  value="<?php echo $profile[0]['no_rek']?>">
                            </div>
                            <div class="form-group">
                                <label for="no_rek">Bank Name</label>
                                <input type="text" id="nama_bank" name="nama_bank" minlength="2" maxlength="50" required class="form-control input-lg" value="<?php echo $profile[0]['nama_bank']?>">
                            </div>
        
                            <hr class="colorgraph">
                            <div class="form-group">
                                <div class="aligncenter">
                                    <input type="submit" value="Edit Data" class="btn btn-primary btn-block btn-lg">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>