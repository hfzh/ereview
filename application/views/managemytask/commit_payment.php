<html>
	<body>
        <section id="featured" class="bg">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                        <?php echo form_open_multipart(base_url() . 'index.php/managemytask/commiting_payment')?>
                          <div class="text-center">
                            <h2> Commit Payment </h2>
                          </div>
                            <?php if($this->session->flashdata('fail_upload')):?>
                                <div class="alert alert-danger"><?php echo $this->session->flashdata('fail_upload'); ?></div>
                            <?php endif;?>
                            <?php if($this->session->flashdata('success_payment')):?>
                                <div class="alert alert-success"><?php echo $this->session->flashdata('success_payment');?></div>
                            <?php endif;?>
                            <hr class="colorgraph">
                            <div class="form-group">
                                <label for="artikel">Select article you want to pay:
                            </div>
                            <div class="form-group">
                                <select id="artikel" name="artikel">
                                    <option value="" disabled selected>Select your option</option>
                                        <?php if (!empty($judul_artikel)) : ?>
                                            <?php foreach ($judul_artikel as $item): ?>
                                                <option value="<?php echo $item['id_artikel']?>"><?php echo $item['judul']?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                </select>
                            </div>
                            <hr class="colorgraph">
                            <div class="form-group">
                                <div class="aligncenter">
                                    <input type="submit" value="Commit Payment" class="btn btn-primary btn-block btn-lg">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
         </section>
    </body>
</html>